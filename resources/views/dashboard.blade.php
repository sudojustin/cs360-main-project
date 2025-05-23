<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
            </svg>
            {{ __('BarterDB') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-stone-50 to-emerald-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
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
                                <h1 class="text-3xl font-bold text-white mb-2">Welcome to BarterDB Exchange</h1>
                                <p class="text-emerald-100 text-lg max-w-2xl">Your secure four-party trading platform for anonymous bartering with escrow protection.</p>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-4 text-center shadow-lg transform transition-all duration-300 hover:scale-105">
                                    <div class="text-2xl font-bold text-white">{{ $userInventory->sum('quantity') }}</div>
                                    <div class="text-emerald-100 text-sm font-medium">Items in Inventory</div>
                                </div>
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-4 text-center shadow-lg transform transition-all duration-300 hover:scale-105">
                                    <div class="text-2xl font-bold text-white">{{ $transactions->where('status', 'Pending')->count() }}</div>
                                    <div class="text-emerald-100 text-sm font-medium">Pending Trades</div>
                                </div>
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-4 text-center shadow-lg transform transition-all duration-300 hover:scale-105">
                                    <div class="text-2xl font-bold text-white">{{ $transactions->where('status', 'Completed')->count() }}</div>
                                    <div class="text-emerald-100 text-sm font-medium">Completed Trades</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8 flex flex-wrap gap-4">
                            <a href="{{ route('offers') }}" class="inline-flex items-center px-4 py-2 bg-white text-emerald-700 rounded-lg hover:bg-emerald-50 transition-colors duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                                </svg>
                                Browse Offers
                            </a>
                            <a href="{{ route('profile') }}" class="inline-flex items-center px-4 py-2 bg-stone-700 text-white rounded-lg hover:bg-stone-800 transition-colors duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                Update Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Messages Section -->
            @if(session('success'))
                <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 px-4 py-3 rounded-lg shadow-sm mb-6 relative flex items-center animate-fade-in" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg shadow-sm mb-6 relative flex items-center animate-fade-in" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- User's Inventory Section -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border-t-4 border-emerald-500 transform transition-all hover:shadow-2xl">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl text-gray-900 flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                        </svg>
                        Your Inventory
                    </h3>
                    <div class="overflow-x-auto bg-white rounded-xl shadow-inner">
                        <table class="table-auto w-full">
                            <thead>
                                <tr class="bg-emerald-50 text-emerald-800 uppercase text-xs">
                                    <th class="px-4 py-3 text-left font-medium tracking-wider rounded-tl-lg">Product Name</th>
                                    <th class="px-4 py-3 text-left font-medium tracking-wider">Value</th>
                                    <th class="px-4 py-3 text-left font-medium tracking-wider">Quantity</th>
                                    <th class="px-4 py-3 text-left font-medium tracking-wider">Last Updated</th>
                                    <th class="px-4 py-3 text-left font-medium tracking-wider rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($userInventory as $item)
                                    @if($item->quantity > 0)
                                    <tr class="hover:bg-emerald-50 transition-colors duration-150 ease-in-out">
                                        <td class="border-b border-gray-200 px-4 py-3 font-medium text-gray-700">{{ $item->product->name }}</td>
                                        <td class="border-b border-gray-200 px-4 py-3 text-stone-700 font-medium">${{ number_format($item->product->value, 2) }}</td>
                                        <td class="border-b border-gray-200 px-4 py-3">{{ $item->quantity }}</td>
                                        <td class="border-b border-gray-200 px-4 py-3 text-xs text-gray-500">{{ $item->updated_at->format('M d, Y H:i') }}</td>
                                        <td class="border-b border-gray-200 px-4 py-3">
                                            <div class="flex space-x-2">
                                                <button onclick="openUpdateModal('{{ $item->product->id }}', '{{ $item->product->name }}', {{ $item->quantity }})" class="bg-emerald-500 text-white py-1.5 px-3 rounded-md hover:bg-emerald-600 text-xs flex items-center shadow-sm hover:shadow transition-all duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    </svg>
                                                    Update
                                                </button>
                                                <form action="{{ route('dashboard.inventory.remove', $item->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 text-white py-1.5 px-3 rounded-md hover:bg-red-600 text-xs flex items-center shadow-sm hover:shadow transition-all duration-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                        Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="5" class="border-b border-gray-200 px-4 py-6 text-center text-gray-500 italic">
                                            You don't have any products in your inventory yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Add to Inventory Button -->
                    <button onclick="document.getElementById('addInventoryModal').style.display='block'" 
                        class="mt-6 px-5 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 flex items-center shadow-md hover:shadow-lg transition-all duration-200 ease-in-out transform hover:translate-y-[-2px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add to Inventory
                    </button>
                </div>
            </div>

            <!-- Transactions Section -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border-t-4 border-stone-500 transform transition-all hover:shadow-2xl">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl text-gray-900 flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-stone-600" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                        </svg>
                        Pending Transactions
                    </h3>
                    <div class="overflow-x-auto bg-white rounded-xl shadow-inner">
                        <table class="table-auto w-full">
                            <thead>
                                <tr class="bg-stone-50 text-stone-800 uppercase text-xs">
                                    <th class="px-4 py-3 text-left font-medium tracking-wider rounded-tl-lg">ID</th>
                                    <th class="px-4 py-3 text-left font-medium tracking-wider">Product (X→A)</th>
                                    <th class="px-4 py-3 text-left font-medium tracking-wider">Product (B→Y)</th>
                                    <th class="px-4 py-3 text-left font-medium tracking-wider">Hash Key</th>
                                    <th class="px-4 py-3 text-left font-medium tracking-wider">Fee Total</th>
                                    <th class="px-4 py-3 text-left font-medium tracking-wider">Created At</th>
                                    <th class="px-4 py-3 text-left font-medium tracking-wider rounded-tr-lg">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $pendingTransactions = $transactions->filter(function($transaction) {
                                        return $transaction->status != 'Completed';
                                    });
                                @endphp
                                @forelse ($pendingTransactions as $transaction)
                                    <tr class="hover:bg-stone-50 transition-colors duration-150 ease-in-out">
                                        <td class="border-b border-gray-200 px-4 py-3 font-medium text-gray-700">{{ $transaction->transaction_id }}</td>
                                        <td class="border-b border-gray-200 px-4 py-3">
                                            {{ $transaction->productp ? $transaction->productp->name : 'N/A' }} 
                                            @if($transaction->status == 'Countered' && $transaction->counter_quantity_p)
                                                <div class="mt-1 flex items-center">
                                                    <span class="line-through text-gray-500 text-xs">({{ $transaction->quantity_p }})</span>
                                                    <span class="ml-1 text-purple-700 text-xs font-medium">({{ $transaction->counter_quantity_p }})</span>
                                                </div>
                                            @else
                                                ({{ $transaction->quantity_p }})
                                            @endif
                                        </td>
                                        <td class="border-b border-gray-200 px-4 py-3">
                                            {{ $transaction->producte ? $transaction->producte->name : 'N/A' }} 
                                            @if($transaction->status == 'Countered' && $transaction->counter_quantity_e)
                                                <div class="mt-1 flex items-center">
                                                    <span class="line-through text-gray-500 text-xs">({{ $transaction->quantity_e }})</span>
                                                    <span class="ml-1 text-purple-700 text-xs font-medium">({{ $transaction->counter_quantity_e }})</span>
                                                </div>
                                            @else
                                                ({{ $transaction->quantity_e }})
                                            @endif
                                        </td>
                                        <td class="border-b border-gray-200 px-4 py-3 font-mono text-xs">
                                            @if(Auth::id() == $transaction->initiator_id)
                                                {{ $transaction->hash_first }} <span class="text-gray-400">********</span>
                                            @elseif(Auth::id() == $transaction->counterparty_id)
                                                <span class="text-gray-400">********</span> {{ $transaction->hash_second }}
                                            @else
                                                <span class="text-gray-400 italic">Hidden</span>
                                            @endif
                                        </td>
                                        <td class="border-b border-gray-200 px-4 py-3 font-medium text-stone-700">${{ $transaction->transaction_fee_total }}</td>
                                        <td class="border-b border-gray-200 px-4 py-3 text-xs">{{ $transaction->created_at }}</td>
                                        <td class="border-b border-gray-200 px-4 py-3">
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                                @if($transaction->status == 'Pending') bg-blue-100 text-blue-800
                                                @elseif($transaction->status == 'Accepted') bg-amber-100 text-amber-800
                                                @elseif($transaction->status == 'Countered') bg-purple-100 text-purple-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ $transaction->status }}
                                            </span>
                                            @if($transaction->initiator_confirmed && $transaction->initiator_id != Auth::id())
                                                <span class="px-2 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs block mt-1">Initiator Confirmed</span>
                                            @endif
                                            @if($transaction->counterparty_confirmed && $transaction->counterparty_id != Auth::id())
                                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs block mt-1">Counterparty Confirmed</span>
                                            @endif
                                            @if($transaction->status == 'Countered' && $transaction->counteroffer_by)
                                                <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs block mt-1">Countered</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="border-b border-gray-200 px-4 py-6 text-center text-gray-500 italic">
                                            You don't have any pending transactions.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Completed Transactions Section -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border-t-4 border-emerald-500 transform transition-all hover:shadow-2xl">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl text-gray-900 flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Completed Transactions
                    </h3>
                    <div class="overflow-x-auto bg-white rounded-xl shadow-inner">
                        <table class="table-auto w-full">
                            <thead>
                                <tr class="bg-emerald-50 text-emerald-800 uppercase text-xs">
                                    <th class="px-4 py-3 text-left font-medium tracking-wider rounded-tl-lg">ID</th>
                                    <th class="px-4 py-3 text-left font-medium tracking-wider">Product (X→A)</th>
                                    <th class="px-4 py-3 text-left font-medium tracking-wider">Product (B→Y)</th>
                                    <th class="px-4 py-3 text-left font-medium tracking-wider">Hash Key</th>
                                    <th class="px-4 py-3 text-left font-medium tracking-wider">Fee Total</th>
                                    <th class="px-4 py-3 text-left font-medium tracking-wider">Created At</th>
                                    <th class="px-4 py-3 text-left font-medium tracking-wider">Completed At</th>
                                    <th class="px-4 py-3 text-left font-medium tracking-wider rounded-tr-lg">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $completedTransactions = $transactions->filter(function($transaction) {
                                        return $transaction->status == 'Completed';
                                    });
                                @endphp
                                @forelse ($completedTransactions as $transaction)
                                    <tr class="hover:bg-emerald-50 transition-colors duration-150 ease-in-out">
                                        <td class="border-b border-gray-200 px-4 py-3 font-medium text-gray-700">{{ $transaction->transaction_id }}</td>
                                        <td class="border-b border-gray-200 px-4 py-3">{{ $transaction->productp ? $transaction->productp->name : 'N/A' }} ({{ $transaction->quantity_p }})</td>
                                        <td class="border-b border-gray-200 px-4 py-3">{{ $transaction->producte ? $transaction->producte->name : 'N/A' }} ({{ $transaction->quantity_e }})</td>
                                        <td class="border-b border-gray-200 px-4 py-3 font-mono text-xs">
                                            @if(Auth::id() == $transaction->initiator_id)
                                                {{ $transaction->hash_first }} <span class="text-gray-400">********</span>
                                            @elseif(Auth::id() == $transaction->counterparty_id)
                                                <span class="text-gray-400">********</span> {{ $transaction->hash_second }}
                                            @else
                                                <span class="text-gray-400 italic">Hidden</span>
                                            @endif
                                        </td>
                                        <td class="border-b border-gray-200 px-4 py-3 font-medium text-stone-700">${{ $transaction->transaction_fee_total }}</td>
                                        <td class="border-b border-gray-200 px-4 py-3 text-xs">{{ $transaction->created_at }}</td>
                                        <td class="border-b border-gray-200 px-4 py-3 text-xs">{{ $transaction->completed_at }}</td>
                                        <td class="border-b border-gray-200 px-4 py-3">
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                                {{ $transaction->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="border-b border-gray-200 px-4 py-6 text-center text-gray-500 italic">
                                            You don't have any completed transactions yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add to Inventory Modal -->
    <div id="addInventoryModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-60 z-50 backdrop-blur-sm transition-all duration-300">
        <div class="bg-white p-6 rounded-xl shadow-2xl border-t-4 border-emerald-500 w-[90%] max-w-md transform transition-all duration-300 ease-out animate-appear">
            <h3 class="text-lg font-semibold mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                </svg>
                Add to Inventory
            </h3>
            <form action="{{ route('dashboard.inventory.update') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="product_id" class="block text-sm font-medium text-gray-700 mb-1">Product</label>
                    <select name="product_id" id="product_id" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200">
                        <option value="">-- Select a product --</option>
                        @foreach($allProducts as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} (Value: ${{ number_format($product->value, 2) }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                    <input type="number" name="quantity" id="quantity" min="1" value="1" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('addInventoryModal').style.display='none'" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 shadow-sm hover:shadow transition-all duration-200">Add to Inventory</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Update Inventory Modal -->
    <div id="updateInventoryModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-60 z-50 backdrop-blur-sm transition-all duration-300">
        <div class="bg-white p-6 rounded-xl shadow-2xl border-t-4 border-emerald-500 w-[90%] max-w-md transform transition-all duration-300 ease-out animate-appear">
            <h3 class="text-lg font-semibold mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Update Inventory Quantity
            </h3>
            <form action="{{ route('dashboard.inventory.update') }}" method="POST" id="updateInventoryForm">
                @csrf
                <input type="hidden" name="product_id" id="update_product_id">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Product</label>
                    <div id="update_product_name" class="mt-1 py-2 px-3 border border-gray-300 bg-gray-50 rounded-lg text-gray-700 font-medium"></div>
                </div>
                <div class="mb-5">
                    <label for="update_quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                    <input type="number" name="quantity" id="update_quantity" min="1" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('updateInventoryModal').style.display='none'" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 shadow-sm hover:shadow transition-all duration-200">Update Quantity</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal interactions
        window.addEventListener('click', function(event) {
            const addInventoryModal = document.getElementById('addInventoryModal');
            const updateInventoryModal = document.getElementById('updateInventoryModal');
            
            if (event.target === addInventoryModal) {
                addInventoryModal.style.display = 'none';
            }
            
            if (event.target === updateInventoryModal) {
                updateInventoryModal.style.display = 'none';
            }
        });

        // Function to open the update modal
        function openUpdateModal(productId, productName, quantity) {
            document.getElementById('update_product_id').value = productId;
            document.getElementById('update_product_name').textContent = productName;
            document.getElementById('update_quantity').value = quantity;
            document.getElementById('updateInventoryModal').style.display = 'block';
        }
    </script>

    <style>
        /* Animation for modal */
        .animate-appear {
            animation: appear 0.3s ease-out;
        }
        
        @keyframes appear {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(10px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
        
        /* Fade in animation for alerts */
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Improve focus styles for better accessibility */
        input:focus, button:focus, select:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.3);
        }

        /* Modal centering styles */
        #addInventoryModal, #updateInventoryModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            align-items: center;
            justify-content: center;
            z-index: 50;
        }

        #addInventoryModal > div, #updateInventoryModal > div {
            margin: 0 auto;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }
        
        /* Card hover effects */
        .hover\:shadow-2xl:hover {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
    </style>
</x-app-layout>
