<h1>StockMaster Pro</h1>
<p>Fecha: {{ date('d M, Y') }}</p>

<hr>

<div>
    <p>Productos: {{ $products->count() }}</p>
    <p>Clientes: {{ $clientes->count() }}</p>
    <p>Órdenes Hoy: {{ $orders->count() }}</p>
    <p>Ventas Totales: ${{ number_format($orders->sum('total'), 2) }}</p>
</div>

<hr>

<div>
    <h2>Nueva Venta</h2>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <label>Producto:</label>
        <select name="product_id" required>
            <option value="" disabled selected>Seleccionar...</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }} (${{ $product->price }})</option>
            @endforeach
        </select>
        <br>
        <label>Cliente:</label>
        <select name="cliente_id" required>
            <option value="" disabled selected>Seleccionar...</option>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
            @endforeach
        </select>
        <br>
        <label>Cantidad:</label>
        <input type="number" step="0.01" name="quantity" required>
        <br>
        <button type="submit">Registrar Orden</button>
    </form>

    <h2>Agregar Producto</h2>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nombre del producto" required>
        <input type="number" step="0.01" name="price" placeholder="Precio" required>
        <input type="number" step="0.01" name="amount" placeholder="Stock" required>
        <select name="category_id">
            @foreach ($category as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
        <button type="submit">Guardar</button>
    </form>

    <h3>Nueva Categoría</h3>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Categoría" required>
        <button type="submit">Ok</button>
    </form>

    <h3>Nuevo Cliente</h3>
    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Cliente" required>
        <button type="submit">Ok</button>
    </form>
</div>

<hr>

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
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->cliente->name ?? 'N/A' }}</td>
                <td>{{ $order->product->name ?? 'Eliminado' }}</td>
                <td>{{ $order->quantity }}</td>
                <td>${{ $order->total }}</td>
                <td><a href="/order/{{$order->id}}/edit">Edit</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Inventario de Productos</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name ?? 'General' }}</td>
                <td>{{ $product->amount }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

