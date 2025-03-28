<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">
                <h3 class="font-semibold text-xl">Your Products</h3>
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Product Name</th>
                            <th class="px-4 py-2">Value</th>
                            <th class="px-4 py-2">Quantity</th>
                        </tr>
                    </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="border px-4 py-2">{{ $product->name }}</td>
                            <td class="border px-4 py-2">${{ $product->value }}</td>
                            <td class="border px-4 py-2 flex items-center justify-between">
                                {{ $product->quantity }}
                                <!-- Delete Product -->
                                <form action="{{ route('dashboard.product.delete', $product->id) }}" method="POST" class="ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center bg-red-500 text-white rounded-full hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                </table>

                <!-- Add Product Button -->
                <button onclick="document.getElementById('addProductModal').style.display='block'" 
                    class="mt-4 px-4 py-2 bg-green-500 text-white rounded-md">➕ Add Product</button>

                <!-- Add Product Modal -->
                <div id="addProductModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                    <div class="bg-white p-6 rounded-md shadow-md">
                        <h3 class="text-lg font-semibold mb-4">Add Product</h3>
                        <form action="{{ route('dashboard.product.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                                <input type="text" name="name" id="name" required class="block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div class="mb-4">
                                <label for="value" class="block text-sm font-medium text-gray-700">Value</label>
                                <input type="number" name="value" id="value" required class="block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div class="mb-4">
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                                <input type="number" name="quantity" id="quantity" required class="block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div class="flex justify-end">
                                <button type="button" onclick="document.getElementById('addProductModal').style.display='none'" class="mr-2 px-4 py-2 bg-gray-500 text-white rounded-md">Cancel</button>
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


                <!-- Current Barter Status -->
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl">Current Barter Status</h3>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Product</th>
                                <th class="px-4 py-2">Counterparty</th>
                                <th class="px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td class="border px-4 py-2">
                                        {{ $transaction->productp ? $transaction->productp->name : 'Product Missing' }} →
                                        {{ $transaction->producte ? $transaction->producte->name : 'Product Missing' }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ $transaction->counterparty ? $transaction->counterparty->name : 'Waiting for partner' }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ $transaction->status }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Create New Offer Form Placeholder -->
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl">Create New Offer</h3>
                    <form action="#" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="product_id" class="block text-sm font-medium text-gray-700">Product</label>
                            <select id="product_id" name="product_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                <option value="" disabled selected>Select a product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                            <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" step="0.01">
                        </div>

                        <div>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Create Offer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
