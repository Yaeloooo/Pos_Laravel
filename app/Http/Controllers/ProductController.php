<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // app/Http/Controllers/ProductController.php
    public function index()
    {
        $category = \App\Models\categories::all();
        $products = \App\Models\Product::all();
        $clientes = \App\Models\Clientes::all();
        $orders =  \App\Models\Order::all();

        return view('addProduct', compact('category', 'products', 'clientes','orders'));
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


        Product::create($request->all());
        return redirect()->route('add-product');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $product = Product::find($id);
        return view('add-product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {


        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        
    }
}
