<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-700" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Welcome Card -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-green-700 transform transition-all hover:shadow-xl">
                <div class="p-6 text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-xl font-semibold">{{ __("Welcome to the Admin Dashboard!") }}</span>
                </div>

                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="mx-6 p-4 mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-md shadow-sm flex items-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mx-6 p-4 mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-md shadow-sm flex items-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
            </div>

            <!-- User Table -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-green-700 transform transition-all hover:shadow-xl">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl text-gray-900 flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v1h-3zM4.75 12.094A5.973 5.973 0 004 15v1H1v-1a3 3 0 013.75-2.906z" />
                        </svg>
                        User List
                    </h3>

                    <div class="overflow-x-auto bg-white rounded-lg shadow-inner">
                        <table class="min-w-full table-auto border-collapse">
                            <thead>
                                <tr class="bg-green-50 text-green-800 uppercase text-xs">
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider rounded-tl-lg">ID</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Name</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Email</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Admin</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr class="hover:bg-green-50 transition-colors duration-150 ease-in-out">
                                        <td class="px-4 py-3 border-b border-gray-200 font-medium">{{ $user->id }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200">{{ $user->name }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200">{{ $user->email }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200">
                                            @if($user->is_admin)
                                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Yes</span>
                                            @else
                                                <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-semibold">No</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 border-b border-gray-200">
                                            @if($user->id !== auth()->id())
                                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-white border border-red-500 text-red-600 hover:bg-red-50 font-medium py-2 px-4 rounded-md flex items-center shadow-sm transition-all duration-200 hover:shadow">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                        Delete
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-400 text-sm italic">Cannot delete yourself</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Product Table -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-green-700 transform transition-all hover:shadow-xl">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl text-gray-900 flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                        </svg>
                        Product List
                    </h3>

                    <div class="overflow-x-auto bg-white rounded-lg shadow-inner">
                        <table class="min-w-full table-auto border-collapse">
                            <thead>
                                <tr class="bg-green-50 text-green-800 uppercase text-xs">
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider rounded-tl-lg">ID</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Name</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Owner ID</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Value</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Quantity</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr class="hover:bg-green-50 transition-colors duration-150 ease-in-out">
                                        <td class="px-4 py-3 border-b border-gray-200 font-medium">{{ $product->id }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200">{{ $product->name }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200">{{ $product->owner_id }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200 text-green-700 font-medium">${{ number_format($product->value, 2) }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200">{{ $product->quantity }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200">
                                            <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-white border border-red-500 text-red-600 hover:bg-red-50 font-medium py-2 px-4 rounded-md flex items-center shadow-sm transition-all duration-200 hover:shadow">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
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
                    </div>
                </div>
            </div>

            <!-- Transaction Table -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-green-700 transform transition-all hover:shadow-xl">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl text-gray-900 flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                        </svg>
                        Transaction List
                    </h3>

                    <div class="overflow-x-auto bg-white rounded-lg shadow-inner">
                        <table class="min-w-full table-auto border-collapse">
                            <thead>
                                <tr class="bg-green-50 text-green-800 uppercase text-xs">
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider rounded-tl-lg">ID</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Initiator</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Counterparty</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Product</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Equivalent</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Fee</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Status</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Created</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Completed</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                    <tr class="hover:bg-green-50 transition-colors duration-150 ease-in-out">
                                        <td class="px-4 py-3 border-b border-gray-200 font-medium">{{ $transaction->transaction_id }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200">{{ $transaction->initiator->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200">{{ $transaction->counterparty->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200">{{ $transaction->productp->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200">{{ $transaction->producte->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200 text-green-700 font-medium">${{ number_format($transaction->transaction_fee_total, 2) }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200">
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                                @if($transaction->status == 'COMPLETE') bg-green-100 text-green-800 
                                                @elseif($transaction->status == 'PENDING') bg-blue-100 text-blue-800
                                                @elseif($transaction->status == 'INITIATED') bg-yellow-100 text-yellow-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ $transaction->status }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 border-b border-gray-200 text-xs text-gray-600">{{ $transaction->created_at }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200 text-xs text-gray-600">{{ $transaction->completed_at ?? 'Pending' }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200">
                                            <form action="{{ route('admin.transactions.delete', $transaction->transaction_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-white border border-red-500 text-red-600 hover:bg-red-50 font-medium py-2 px-4 rounded-md flex items-center shadow-sm transition-all duration-200 hover:shadow">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>