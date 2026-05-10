<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">

        <header
            class="flex flex-col md:flex-row justify-between items-center mb-8 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div>
                <h1 class="text-3xl font-extrabold text-indigo-600 tracking-tight">StockMaster Pro</h1>
                <p class="text-gray-500 text-sm">Gestión de inventario y ventas en tiempo real</p>
            </div>
            <div
                class="mt-4 md:mt-0 px-4 py-2 bg-indigo-50 rounded-lg border border-indigo-100 text-indigo-700 font-medium">
                📅 {{ date('d M, Y') }}
            </div>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
                <p class="text-sm font-medium text-gray-500 uppercase">Productos</p>
                <p class="text-2xl font-bold text-gray-800">{{ $products->count() }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-purple-500">
                <p class="text-sm font-medium text-gray-500 uppercase">Clientes</p>
                <p class="text-2xl font-bold text-gray-800">{{ $clientes->count() }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-orange-500">
                <p class="text-sm font-medium text-gray-500 uppercase">Órdenes Hoy</p>
                <p class="text-2xl font-bold text-gray-800">{{ $orders->count() }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500">
                <p class="text-sm font-medium text-gray-500 uppercase">Ventas Totales</p>
                <p class="text-2xl font-bold text-gray-800">${{ number_format($orders->sum('total'), 2) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

            <section class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="mr-2">💰</span> Nueva Venta
                </h2>
                <form action="{{ route('orders.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Producto</label>
                            <select name="product_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="" disabled selected>Seleccionar...</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} (${{ $product->price }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Cliente</label>
                            <select name="cliente_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="" disabled selected>Seleccionar...</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Cantidad</label>
                        <input type="number" step="0.01" name="quantity" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150">
                        Registrar Orden
                    </button>
                </form>
            </section>

            <section class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="mr-2">📦</span> Agregar Producto
                </h2>
                <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="text" name="name" placeholder="Nombre del producto" required
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <div class="grid grid-cols-2 gap-4">
                        <input type="number" step="0.01" name="price" placeholder="Precio ($)" required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <input type="number" step="0.01" name="amount" placeholder="Stock Inicial" required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <select name="category_id"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @foreach ($category as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150">
                        Guardar Producto
                    </button>
                </form>
            </section>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <div class="bg-indigo-50 p-4 rounded-xl border border-indigo-100">
                <h3 class="font-bold text-indigo-800 mb-3">Nueva Categoría</h3>
                <form action="{{ route('categories.store') }}" method="POST" class="flex gap-2">
                    @csrf
                    <input type="text" name="name" placeholder="Ej: Electrónicos" required
                        class="flex-1 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Ok</button>
                </form>
            </div>
            <div class="bg-blue-50 p-4 rounded-xl border border-blue-100">
                <h3 class="font-bold text-blue-800 mb-3">Nuevo Cliente</h3>
                <form action="{{ route('clientes.store') }}" method="POST" class="flex gap-2">
                    @csrf
                    <input type="text" name="name" placeholder="Nombre completo" required
                        class="flex-1 rounded-md border-gray-300 shadow-sm focus:ring-blue-500">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Ok</button>
                </form>
            </div>
        </div>

        <div class="space-y-10">

            <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-800">Órdenes de Venta Recientes</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                            <tr>
                                <th class="px-6 py-3">Cliente</th>
                                <th class="px-6 py-3">Producto</th>
                                <th class="px-6 py-3">Cant.</th>
                                <th class="px-6 py-3">Total</th>
                                <th class="px-6 py-3 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($orders as $order)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $order->cliente->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $order->product->name ?? 'Eliminado' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $order->quantity }}</td>
                                    <td class="px-6 py-4 font-bold text-green-600">
                                        ${{ number_format($order->total, 2) }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="/order/{{ $order->id }}/edit"
                                            class="text-indigo-600 hover:text-indigo-900 font-semibold text-sm">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-800">Inventario de Productos</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                            <tr>
                                <th class="px-6 py-3">Nombre</th>
                                <th class="px-6 py-3">Categoría</th>
                                <th class="px-6 py-3 text-center">Stock</th>
                                <th class="px-6 py-3">Precio</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($products as $product)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $product->name }}</td>
                                    <td class="px-6 py-4 text-gray-600">
                                        <span class="px-2 py-1 bg-gray-100 rounded-full text-xs italic">
                                            {{ $product->category->name ?? 'General' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="font-mono {{ $product->amount < 5 ? 'text-red-500 font-bold' : 'text-gray-600' }}">
                                            {{ $product->amount }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-700">
                                        ${{ number_format($product->price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
