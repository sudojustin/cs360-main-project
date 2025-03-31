<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-700" viewBox="0 0 20 20" fill="currentColor">
                <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
            </svg>
            {{ __('BarterDB Exchange') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-green-700">

                <div class="p-6 text-gray-900">
                <h3 class="font-semibold text-xl text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6.672 1.911a1 1 0 10-1.932.518l.259.966a1 1 0 001.932-.518l-.26-.966zM2.429 4.74a1 1 0 10-.517 1.932l.966.259a1 1 0 00.517-1.932l-.966-.26zm8.814-.569a1 1 0 00-1.415-1.414l-.707.707a1 1 0 101.415 1.415l.707-.708zm-7.071 7.072l.707-.707A1 1 0 003.465 9.12l-.708.707a1 1 0 001.415 1.415zm3.2-5.171a1 1 0 00-1.3 1.3l4 10a1 1 0 001.823.075l1.38-2.759 3.018 3.02a1 1 0 001.414-1.415l-3.019-3.02 2.76-1.379a1 1 0 00-.076-1.822l-10-4z" clip-rule="evenodd" />
                    </svg>
                    Your Products
                </h3>
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-green-800">Product Name</th>
                            <th class="px-4 py-2 text-left text-green-800">Value</th>
                            <th class="px-4 py-2 text-left text-green-800">Quantity</th>
                            <th class="px-4 py-2 text-left text-green-800">Actions</th>
                        </tr>
                    </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="hover:bg-blue-50">
                            <td class="border-b border-gray-200 px-4 py-2">{{ $product->name }}</td>
                            <td class="border-b border-gray-200 px-4 py-2">${{ $product->value }}</td>
                            <td class="border-b border-gray-200 px-4 py-2">{{ $product->quantity }}</td>
                            <td class="border-b border-gray-200 px-4 py-2">
                                <!-- Delete Product -->
                                <form action="{{ route('dashboard.product.delete', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-gray-200 text-green-700 hover:bg-gray-300 font-medium py-1 px-2 rounded text-xs flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1 text-green-700" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                </table>

                <!-- Add Product Button -->
                <button onclick="document.getElementById('addProductModal').style.display='block'" 
                    class="mt-4 px-4 py-2 bg-green-700 text-white rounded-md hover:bg-green-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add Product
                </button>

                <!-- Add Product Modal -->
                <div id="addProductModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                    <div class="bg-white p-6 rounded-md shadow-md border-l-4 border-green-700 max-w-md w-full">
                        <h3 class="text-lg font-semibold mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Add Product
                        </h3>
                        <form action="{{ route('dashboard.product.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                                <input type="text" name="name" id="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                            </div>
                            <div class="mb-4">
                                <label for="value" class="block text-sm font-medium text-gray-700">Value</label>
                                <input type="number" name="value" id="value" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                            </div>
                            <div class="mb-4">
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                                <input type="number" name="quantity" id="quantity" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                            </div>
                            <div class="flex justify-end">
                                <button type="button" onclick="document.getElementById('addProductModal').style.display='none'" class="mr-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Cancel</button>
                                <button type="submit" class="px-4 py-2 bg-green-700 text-white rounded-md hover:bg-green-800">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


                <!-- Current Barter Status -->
                <div class="p-6 text-gray-900 border-t border-gray-200">
                    <h3 class="font-semibold text-xl text-gray-900 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-700" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                        </svg>
                        Your Transactions
                    </h3>
                    <div class="overflow-x-auto mt-3">
                        <table class="table-auto w-full text-sm">
                            <thead>
                                <tr class="bg-blue-50 text-left">
                                    <th class="px-2 py-2 text-green-800">ID</th>
                                    <th class="px-2 py-2 text-green-800">Initiator</th>
                                    <th class="px-2 py-2 text-green-800">Counterparty</th>
                                    <th class="px-2 py-2 text-green-800">Partner Initiator</th>
                                    <th class="px-2 py-2 text-green-800">Partner Counterparty</th>
                                    <th class="px-2 py-2 text-green-800">Product Provided</th>
                                    <th class="px-2 py-2 text-green-800">Product Exchanged</th>
                                    <th class="px-2 py-2 text-green-800">Hash Key</th>
                                    <th class="px-2 py-2 text-green-800">Fee Total</th>
                                    <th class="px-2 py-2 text-green-800">Created At</th>
                                    <th class="px-2 py-2 text-green-800">Completed At</th>
                                    <th class="px-2 py-2 text-green-800">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr class="hover:bg-blue-50">
                                        <td class="border-b border-gray-200 px-2 py-2">{{ $transaction->transaction_id }}</td>
                                        <td class="border-b border-gray-200 px-2 py-2">{{ $transaction->initiator ? $transaction->initiator->name : 'N/A' }}</td>
                                        <td class="border-b border-gray-200 px-2 py-2">{{ $transaction->counterparty ? $transaction->counterparty->name : 'Waiting' }}</td>
                                        <td class="border-b border-gray-200 px-2 py-2">{{ $transaction->partnerInitiator ? $transaction->partnerInitiator->name : 'N/A' }}</td>
                                        <td class="border-b border-gray-200 px-2 py-2">{{ $transaction->partnerCounterparty ? $transaction->partnerCounterparty->name : 'N/A' }}</td>
                                        <td class="border-b border-gray-200 px-2 py-2">{{ $transaction->productp ? $transaction->productp->name : 'N/A' }}</td>
                                        <td class="border-b border-gray-200 px-2 py-2">{{ $transaction->producte ? $transaction->producte->name : 'N/A' }}</td>
                                        <td class="border-b border-gray-200 px-2 py-2 font-mono text-xs">{{ $transaction->hashkey }}</td>
                                        <td class="border-b border-gray-200 px-2 py-2">${{ $transaction->transaction_fee_total }}</td>
                                        <td class="border-b border-gray-200 px-2 py-2 text-xs">{{ $transaction->created_at }}</td>
                                        <td class="border-b border-gray-200 px-2 py-2 text-xs">{{ $transaction->completed_at ?: 'Pending' }}</td>
                                        <td class="border-b border-gray-200 px-2 py-2">
                                            <span class="px-2 py-1 rounded-full text-xs 
                                                @if($transaction->status == 'COMPLETE') bg-green-100 text-green-800 
                                                @elseif($transaction->status == 'PENDING') bg-blue-100 text-blue-800
                                                @elseif($transaction->status == 'INITIATED') bg-green-100 text-green-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ $transaction->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
