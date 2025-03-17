<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Offers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Welcome to the offers page!") }}
                </div>

                <!-- Product Table -->
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl">Product List</h3>

                    <table class="min-w-full table-auto mt-4 border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border-b">ID</th>
                                <th class="px-4 py-2 border-b">Name</th>
                                <th class="px-4 py-2 border-b">Owner ID</th>
                                <th class="px-4 py-2 border-b">Value</th>
                                <th class="px-4 py-2 border-b">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="px-4 py-2 border-b">{{ $product->id }}</td>
                                    <td class="px-4 py-2 border-b">{{ $product->name }}</td>
                                    <td class="px-4 py-2 border-b">{{ $product->owner_id }}</td>
                                    <td class="px-4 py-2 border-b">${{ number_format($product->value, 2) }}</td>
                                    <td class="px-4 py-2 border-b">{{ $product->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
