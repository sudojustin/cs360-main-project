<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-stone-50 to-emerald-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Hero Banner -->
            <div class="bg-gradient-to-r from-emerald-700 via-emerald-600 to-stone-700 rounded-2xl shadow-xl overflow-hidden">
                <div class="relative">
                    <!-- Decorative elements -->
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-stone-200 rounded-full opacity-20"></div>
                    <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-32 h-32 bg-emerald-200 rounded-full opacity-20"></div>
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-stone-100 rounded-full opacity-10"></div>
                    
                    <div class="relative px-6 py-8 sm:px-8 sm:py-10">
                        <div class="flex flex-col md:flex-row items-center justify-between">
                            <div class="mb-6 md:mb-0 md:mr-8">
                                <h1 class="text-3xl font-bold text-white mb-2">Admin Control Panel</h1>
                                <p class="text-emerald-100 text-lg max-w-2xl">Manage users, products, and transactions across the BarterDB platform.</p>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-4 text-center shadow-lg transform transition-all duration-300 hover:scale-105">
                                    <div class="text-2xl font-bold text-white">{{ $users->count() }}</div>
                                    <div class="text-emerald-100 text-sm font-medium">Total Users</div>
                                </div>
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-4 text-center shadow-lg transform transition-all duration-300 hover:scale-105">
                                    <div class="text-2xl font-bold text-white">{{ $products->count() }}</div>
                                    <div class="text-emerald-100 text-sm font-medium">Total Products</div>
                                </div>
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-4 text-center shadow-lg transform transition-all duration-300 hover:scale-105">
                                    <div class="text-2xl font-bold text-white">{{ $transactions->count() }}</div>
                                    <div class="text-emerald-100 text-sm font-medium">Total Transactions</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8 flex flex-wrap gap-4">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white text-emerald-700 rounded-lg hover:bg-emerald-50 transition-colors duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                                Back to Dashboard
                            </a>
                            <a href="{{ route('profile') }}" class="inline-flex items-center px-4 py-2 bg-stone-700 text-white rounded-lg hover:bg-stone-800 transition-colors duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Flash Messages -->
            @if (session('success'))
                <div class="mx-6 p-4 mb-4 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 rounded-md shadow-sm flex items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
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

            <!-- Transaction Summary Card -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-emerald-700 transform transition-all hover:shadow-xl">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl text-gray-900 flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                        </svg>
                        Transaction Fee Summary
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-emerald-50 p-4 rounded-lg shadow-sm">
                            <div class="text-sm text-emerald-600 font-medium">Total Fees Collected</div>
                            <div class="text-2xl font-bold text-emerald-800">${{ number_format($transactions->sum('transaction_fee_total'), 2) }}</div>
                        </div>
                        <div class="bg-blue-50 p-4 rounded-lg shadow-sm">
                            <div class="text-sm text-blue-600 font-medium">Completed Transactions</div>
                            <div class="text-2xl font-bold text-blue-800">{{ $transactions->where('status', 'Completed')->count() }}</div>
                        </div>
                        <div class="bg-stone-50 p-4 rounded-lg shadow-sm">
                            <div class="text-sm text-stone-600 font-medium">Average Fee per Transaction</div>
                            <div class="text-2xl font-bold text-stone-800">${{ number_format($transactions->avg('transaction_fee_total'), 2) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction Table -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-emerald-700 transform transition-all hover:shadow-xl">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl text-gray-900 flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                        </svg>
                        Transaction List
                    </h3>

                    <div class="overflow-x-auto bg-white rounded-lg shadow-inner">
                        <table class="min-w-full table-auto border-collapse" id="transactions-table">
                            <thead>
                                <tr class="bg-emerald-50 text-emerald-800 uppercase text-xs">
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider rounded-tl-lg cursor-pointer hover:bg-emerald-100 transition-colors duration-150" data-sort="transaction_id">
                                        ID
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline-block ml-1 sort-icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider cursor-pointer hover:bg-emerald-100 transition-colors duration-150" data-sort="initiator">
                                        Initiator
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline-block ml-1 sort-icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider cursor-pointer hover:bg-emerald-100 transition-colors duration-150" data-sort="counterparty">
                                        Counterparty
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline-block ml-1 sort-icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider cursor-pointer hover:bg-emerald-100 transition-colors duration-150" data-sort="productp">
                                        Product
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline-block ml-1 sort-icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider cursor-pointer hover:bg-emerald-100 transition-colors duration-150" data-sort="producte">
                                        Equivalent
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline-block ml-1 sort-icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider cursor-pointer hover:bg-emerald-100 transition-colors duration-150" data-sort="transaction_fee_total">
                                        Fee
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline-block ml-1 sort-icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider cursor-pointer hover:bg-emerald-100 transition-colors duration-150" data-sort="status">
                                        Status
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline-block ml-1 sort-icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider cursor-pointer hover:bg-emerald-100 transition-colors duration-150" data-sort="created_at">
                                        Created
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline-block ml-1 sort-icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider cursor-pointer hover:bg-emerald-100 transition-colors duration-150" data-sort="completed_at">
                                        Completed
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline-block ml-1 sort-icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                    <tr class="hover:bg-emerald-50 transition-colors duration-150 ease-in-out">
                                        <td class="px-3 py-2 border-b border-gray-200 font-medium text-sm">{{ $transaction->transaction_id }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200 text-sm">{{ $transaction->initiator->name ?? 'N/A' }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200 text-sm">{{ $transaction->counterparty->name ?? 'N/A' }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200 text-sm">{{ $transaction->productp->name ?? 'N/A' }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200 text-sm">{{ $transaction->producte->name ?? 'N/A' }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200 text-stone-700 font-medium text-sm">${{ number_format($transaction->transaction_fee_total, 2) }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200">
                                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold 
                                                @if($transaction->status == 'Completed') bg-emerald-100 text-emerald-800 
                                                @elseif($transaction->status == 'PENDING') bg-blue-100 text-blue-800
                                                @elseif($transaction->status == 'INITIATED') bg-stone-100 text-stone-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ $transaction->status }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-2 border-b border-gray-200 text-xs text-gray-600">{{ $transaction->created_at }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200 text-xs text-gray-600">{{ $transaction->completed_at ?? 'Pending' }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200">
                                            <form action="{{ route('admin.transactions.delete', $transaction->transaction_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-white border border-red-500 text-red-600 hover:bg-red-50 font-medium py-1 px-2 rounded-md flex items-center shadow-sm transition-all duration-200 hover:shadow text-xs">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
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

            <!-- User Management Section -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-emerald-700 transform transition-all hover:shadow-xl">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl text-gray-900 flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                        User Management
                    </h3>

                    <div class="overflow-x-auto bg-white rounded-lg shadow-inner">
                        <table class="min-w-full table-auto border-collapse">
                            <thead>
                                <tr class="bg-emerald-50 text-emerald-800 uppercase text-xs">
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider rounded-tl-lg">ID</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Name</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Email</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Admin</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Status</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr class="hover:bg-emerald-50 transition-colors duration-150 ease-in-out">
                                        <td class="px-3 py-2 border-b border-gray-200 font-medium text-sm">{{ $user->id }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200 text-sm">{{ $user->name }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200 text-sm">{{ $user->email }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200">
                                            @if($user->is_admin)
                                                <span class="px-2 py-0.5 bg-emerald-100 text-emerald-800 rounded-full text-xs font-semibold">Yes</span>
                                            @else
                                                <span class="px-2 py-0.5 bg-gray-100 text-gray-800 rounded-full text-xs font-semibold">No</span>
                                            @endif
                                        </td>
                                        <td class="px-3 py-2 border-b border-gray-200">
                                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $user->is_approved ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $user->is_approved ? 'Approved' : 'Pending' }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-2 border-b border-gray-200">
                                            <div class="flex space-x-2">
                                                @if(!$user->is_admin && !$user->is_approved)
                                                    <form action="{{ route('admin.users.toggle-approval', $user) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="bg-white border border-green-500 text-green-600 hover:bg-green-50 font-medium py-1 px-2 rounded-md flex items-center shadow-sm transition-all duration-200 hover:shadow text-xs">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                            </svg>
                                                            Approve
                                                        </button>
                                                    </form>
                                                @endif
                                                @if($user->id !== auth()->id())
                                                    <form action="{{ route('admin.users.delete', $user) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-white border border-red-500 text-red-600 hover:bg-red-50 font-medium py-1 px-2 rounded-md flex items-center shadow-sm transition-all duration-200 hover:shadow text-xs">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Product Table -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-emerald-700 transform transition-all hover:shadow-xl">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl text-gray-900 flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                        </svg>
                        Product List
                    </h3>

                    <div class="overflow-x-auto bg-white rounded-lg shadow-inner">
                        <table class="min-w-full table-auto border-collapse">
                            <thead>
                                <tr class="bg-emerald-50 text-emerald-800 uppercase text-xs">
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider rounded-tl-lg">ID</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Name</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Owner ID</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Value</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Quantity</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr class="hover:bg-emerald-50 transition-colors duration-150 ease-in-out">
                                        <td class="px-3 py-2 border-b border-gray-200 font-medium text-sm">{{ $product->id }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200 text-sm">{{ $product->name }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200 text-sm">{{ $product->owner_id }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200 text-stone-700 font-medium text-sm">${{ number_format($product->value, 2) }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200 text-sm">{{ $product->quantity }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200">
                                            <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-white border border-red-500 text-red-600 hover:bg-red-50 font-medium py-1 px-2 rounded-md flex items-center shadow-sm transition-all duration-200 hover:shadow text-xs">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
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

    <!-- Sorting Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('transactions-table');
            const headers = table.querySelectorAll('th[data-sort]');
            let currentSort = {
                column: null,
                direction: 'asc'
            };

            headers.forEach(header => {
                header.addEventListener('click', () => {
                    const column = header.getAttribute('data-sort');
                    const direction = currentSort.column === column && currentSort.direction === 'asc' ? 'desc' : 'asc';
                    
                    // Update sort direction
                    currentSort = { column, direction };
                    
                    // Update sort icons
                    headers.forEach(h => {
                        const icon = h.querySelector('.sort-icon');
                        if (h === header) {
                            icon.style.transform = direction === 'asc' ? 'rotate(0deg)' : 'rotate(180deg)';
                        } else {
                            icon.style.transform = 'rotate(0deg)';
                        }
                    });
                    
                    // Sort the table
                    sortTable(column, direction);
                });
            });

            function sortTable(column, direction) {
                const tbody = table.querySelector('tbody');
                const rows = Array.from(tbody.querySelectorAll('tr'));
                
                rows.sort((a, b) => {
                    let aValue = a.querySelector(`td:nth-child(${getColumnIndex(column)})`).textContent.trim();
                    let bValue = b.querySelector(`td:nth-child(${getColumnIndex(column)})`).textContent.trim();
                    
                    // Handle special cases
                    if (column === 'transaction_fee_total') {
                        aValue = parseFloat(aValue.replace('$', '').replace(',', ''));
                        bValue = parseFloat(bValue.replace('$', '').replace(',', ''));
                    } else if (column === 'created_at' || column === 'completed_at') {
                        // For dates, convert to timestamps for comparison
                        aValue = aValue === 'Pending' ? 0 : new Date(aValue).getTime();
                        bValue = bValue === 'Pending' ? 0 : new Date(bValue).getTime();
                    }
                    
                    // Compare values
                    if (aValue < bValue) return direction === 'asc' ? -1 : 1;
                    if (aValue > bValue) return direction === 'asc' ? 1 : -1;
                    return 0;
                });
                
                // Reorder rows in the DOM
                rows.forEach(row => tbody.appendChild(row));
            }

            function getColumnIndex(column) {
                const headers = table.querySelectorAll('th');
                for (let i = 0; i < headers.length; i++) {
                    if (headers[i].getAttribute('data-sort') === column) {
                        return i + 1; // +1 because nth-child is 1-indexed
                    }
                }
                return 1;
            }
        });
    </script>
</x-app-layout>