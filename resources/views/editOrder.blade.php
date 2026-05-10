<div>
    <h2>Órdenes de Venta</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Producto</th>
                <th>Cant.</th>
                <th>Total</th>
            </tr>
        </thead>
        <form action="/order/{{ $order->id }}" method="POST">
            @csrf
            @method('PUT')


            <tbody>
                <tr>
                    <td><input type="text" name="name" value="{{ $order->cliente->name ?? 'N/A' }}"></td>


                        <td>

                            <select name="product_id" required>
                                @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} (${{ $product->price }})</option>
                                   @endforeach
                            </select>

                        </td>


                    <td><input type="text" name="quantity" value="{{ $order->quantity }}"></td>
                    <td>${{ $order->total }}</td>
                    <td><button type="submit">Actualizar</button></td>

                    </form>

                    <form action="/order/{{$order->id}}/delete" method="post">
                        @csrf
                        @method('DELETE')
                         <td><button type="submit">Eliminar</button></td>
                    </form>

                </tr>

            </tbody>
    </table>

