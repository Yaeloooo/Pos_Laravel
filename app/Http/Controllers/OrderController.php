<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return view('addProduct',compact('orders'));

    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'product_id' => 'required|exists:products,id', //valida que haya producto
            'cliente_id' => 'required|exists:clientes,id', // valida que haya cliente
            'quantity'   => 'required|numeric|min:1' //valida que haya cantidad
        ]);

        try {
            DB::transaction(function () use ($request) {
                $product = Product::findOrFail($request->product_id);

                if ($product->amount < $request->quantity) {
                    throw new \Exception("No hay stock suficiente para: " . $product->name);
                }


               $totalCalculado = $product->price * $request->quantity;
                // 1. Restamos el stock
                $product->decrement('amount', $request->quantity);


                // 2. CREAMOS LA ORDEN (Esto te faltaba)
                Order::create([
                    'product_id' => $request->product_id,
                    'cliente_id' => $request->cliente_id,
                    'quantity' => $request->quantity,
                    'total' => $totalCalculado,


                ]);
            });

            return redirect()->back()->with('success', 'Venta realizada con éxito.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

         $order = Order::find($id);
         $products = Product::all();



         return view('editOrder',compact('order','products'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $product = Product::findOrFail($request->product_id);
        $order = Order::find($id);

        if($request->quantity < $order->quantity ) {

            $newStock = $order->quantity - $request->quantity;
            $product->amount = $newStock + $product->amount;
            $product->save();

        }else{

            $newStock = $request->quantity - $order->quantity;
            $product->amount = $product->amount - $newStock;
            $product->save();

        }



        $totalCalculado = $product->price * $request->quantity;

        $order->total = $totalCalculado;
        $order->cliente->save();
        $order->product->save();
        $order->quantity = $request->quantity;
        $order->update();


        return redirect('/add-product');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
