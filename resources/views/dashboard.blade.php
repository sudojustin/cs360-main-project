<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Product List -->
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
                                    <td class="border px-4 py-2">{{ $product->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Current Barter Status -->
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl">Current Barter Status</h3>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Product</th>
                                <th class="px-4 py-2">Counterpart</th>
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
