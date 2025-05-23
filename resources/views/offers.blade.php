<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
            </svg>
            {{ __('Barter System') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-stone-50 to-emerald-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Banner -->
            <div class="bg-gradient-to-r from-emerald-700 to-emerald-900 rounded-xl shadow-xl overflow-hidden mb-6">
                <div class="relative">
                    <!-- Decorative elements -->
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-emerald-500 rounded-full opacity-20"></div>
                    <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-32 h-32 bg-emerald-400 rounded-full opacity-20"></div>
                    
                    <div class="relative px-6 py-5 sm:px-8 sm:py-6">
                        <div class="flex flex-col md:flex-row items-center justify-between">
                            <div class="mb-4 md:mb-0 md:mr-8">
                                <h1 class="text-2xl font-bold text-white mb-1">Barter Marketplace</h1>
                                <p class="text-emerald-100 text-base max-w-2xl">Browse available products and initiate secure four-party trades with escrow protection.</p>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                                <div class="bg-white bg-opacity-20 rounded-lg p-3 text-center">
                                    <div class="text-xl font-bold text-white">{{ $otherUserProducts->count() }}</div>
                                    <div class="text-emerald-100 text-xs">Available Products</div>
                                </div>
                                <div class="bg-white bg-opacity-20 rounded-lg p-3 text-center">
                                    <div class="text-xl font-bold text-white">{{ isset($pendingTrades) ? $pendingTrades->count() : 0 }}</div>
                                    <div class="text-emerald-100 text-xs">Pending Trades</div>
                                </div>
                                <div class="bg-white bg-opacity-20 rounded-lg p-3 text-center">
                                    <div class="text-xl font-bold text-white">4-Party</div>
                                    <div class="text-emerald-100 text-xs">Secure Trading</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 flex flex-wrap gap-3">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-3 py-1.5 bg-white text-emerald-700 rounded-md hover:bg-emerald-50 transition-colors duration-200 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                                Back to Dashboard
                            </a>
                            <a href="{{ route('profile') }}" class="inline-flex items-center px-3 py-1.5 bg-stone-700 text-white rounded-md hover:bg-stone-800 transition-colors duration-200 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                Update Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pending Trades Section -->
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg border-l-4 border-amber-500 transition-all duration-300 hover:shadow-xl mb-6">
                <div class="p-4 text-gray-900">
                    <h3 class="font-semibold text-lg text-gray-900 flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-amber-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 10.414V10a1 1 0 10-2 0v3a1 1 0 00.293.707l2 2a1 1 0 001.414-1.414L11 12.414z" clip-rule="evenodd" />
                        </svg>
                        Pending Trades
                    </h3>

                    @if(isset($pendingTrades) && $pendingTrades->count() > 0)
                        <div class="overflow-x-auto bg-white rounded-lg shadow-inner">
                            <table class="min-w-full table-auto border-collapse text-sm">
                                <thead>
                                    <tr class="bg-amber-50 text-amber-800 uppercase text-xs">
                                        <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider rounded-tl-lg">ID</th>
                                        <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Your Role</th>
                                        <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Product (X→A)</th>
                                        <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Product (B→Y)</th>
                                        <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Hash Key</th>
                                        <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Status</th>
                                        <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider rounded-tr-lg">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingTrades as $trade)
                                        <tr class="hover:bg-amber-50 transition-colors duration-150 ease-in-out">
                                            <td class="px-3 py-2 border-b border-gray-200 font-medium">{{ $trade->transaction_id }}</td>
                                            <td class="px-3 py-2 border-b border-gray-200">
                                                @if(Auth::id() == $trade->initiator_id)
                                                    <span class="px-2 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-medium">Initiator (A)</span>
                                                @elseif(Auth::id() == $trade->counterparty_id)
                                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">Counterparty (X)</span>
                                                @elseif(Auth::id() == $trade->partner_b_id)
                                                    <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-medium">Partner (B)</span>
                                                @elseif(Auth::id() == $trade->partner_y_id)
                                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">Partner (Y)</span>
                                                @endif
                                            </td>
                                            <td class="px-3 py-2 border-b border-gray-200">
                                                {{ $trade->productp ? $trade->productp->name : 'N/A' }} 
                                                @if($trade->status == 'Countered' && $trade->counter_quantity_p)
                                                    <div class="mt-1 flex items-center">
                                                        <span class="line-through text-gray-500 text-xs">({{ $trade->quantity_p }})</span>
                                                        <span class="ml-1 text-purple-700 text-xs font-medium">({{ $trade->counter_quantity_p }})</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M5 12a1 1 0 102 0V6.414l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L5 6.414V12z" />
                                                        </svg>
                                                    </div>
                                                @else
                                                    ({{ $trade->quantity_p }})
                                                @endif
                                            </td>
                                            <td class="px-3 py-2 border-b border-gray-200">
                                                {{ $trade->producte ? $trade->producte->name : 'N/A' }} 
                                                @if($trade->status == 'Countered' && $trade->counter_quantity_e)
                                                    <div class="mt-1 flex items-center">
                                                        <span class="line-through text-gray-500 text-xs">({{ $trade->quantity_e }})</span>
                                                        <span class="ml-1 text-purple-700 text-xs font-medium">({{ $trade->counter_quantity_e }})</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M5 12a1 1 0 102 0V6.414l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L5 6.414V12z" />
                                                        </svg>
                                                    </div>
                                                @else
                                                    ({{ $trade->quantity_e }})
                                                @endif
                                            </td>
                                            <td class="px-3 py-2 border-b border-gray-200 font-mono text-xs">
                                                @if(Auth::id() == $trade->initiator_id)
                                                    {{ $trade->hash_first }} <span class="text-gray-400">********</span>
                                                @elseif(Auth::id() == $trade->counterparty_id)
                                                    <span class="text-gray-400">********</span> {{ $trade->hash_second }}
                                                @else
                                                    <span class="text-gray-400 italic">Hidden</span>
                                                @endif
                                            </td>
                                            <td class="px-3 py-2 border-b border-gray-200">
                                                <div class="flex flex-col space-y-1">
                                                    <span class="px-2 py-1 bg-amber-100 text-amber-800 rounded-full text-xs font-medium">{{ $trade->status }}</span>
                                                    @if($trade->initiator_confirmed)
                                                        <span class="px-2 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-medium">A Confirmed</span>
                                                    @endif
                                                    @if($trade->counterparty_confirmed)
                                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">X Confirmed</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-3 py-2 border-b border-gray-200">
                                                @if((Auth::id() == $trade->initiator_id && !$trade->initiator_confirmed) || 
                                                    (Auth::id() == $trade->counterparty_id && !$trade->counterparty_confirmed))
                                                    <form action="{{ route('trade.accept', $trade) }}" method="POST" class="flex flex-col space-y-2">
                                                        @csrf
                                                        <div>
                                                            <input type="text" name="hash_part" placeholder="Enter your hash part" 
                                                                class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md"
                                                                maxlength="8" minlength="8" required>
                                                        </div>
                                                        <div class="flex space-x-2">
                                                            <button type="submit" 
                                                                class="px-3 py-1 text-xs bg-emerald-600 text-white rounded-md hover:bg-emerald-700 shadow-sm flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                                </svg>
                                                                Confirm
                                                            </button>
                                                            <form action="{{ route('trade.reject', $trade) }}" method="POST" class="inline">
                                                                @csrf
                                                                <button type="submit" 
                                                                    class="px-3 py-1 text-xs bg-red-600 text-white rounded-md hover:bg-red-700 shadow-sm flex items-center">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                    </svg>
                                                                    Reject
                                                                </button>
                                                            </form>
                                                            
                                                            <!-- Counteroffer Button -->
                                                            <button 
                                                                class="px-3 py-1 text-xs bg-purple-600 text-white rounded-md hover:bg-purple-700 shadow-sm flex items-center"
                                                                onclick="openCounterOfferModal('{{ $trade->transaction_id }}', '{{ $trade->productp ? $trade->productp->name : 'N/A' }}', {{ $trade->quantity_p }}, '{{ $trade->producte ? $trade->producte->name : 'N/A' }}', {{ $trade->quantity_e }})">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                                                                </svg>
                                                                Counter
                                                            </button>
                                                        </div>
                                                    </form>
                                                @elseif(Auth::id() == $trade->initiator_id || Auth::id() == $trade->counterparty_id)
                                                    <span class="text-xs text-amber-600">Waiting for other party</span>
                                                @else
                                                    <span class="text-xs text-gray-500 italic">No action needed</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-lg p-6 text-center">
                            <p class="text-gray-500 italic">You don't have any pending trades at the moment.</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Counteroffer Modal -->
            <div id="counterOfferModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-lg text-gray-900">Make Counteroffer</h3>
                        <button onclick="closeCounterOfferModal()" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    
                    <form id="counterOfferForm" method="POST">
                        @csrf
                        <div class="mb-4">
                            <div class="bg-amber-50 p-3 rounded-lg mb-4">
                                <p class="text-sm text-amber-800">You are adjusting the quantities for this trade. The products cannot be changed.</p>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-medium mb-2">Product P:</label>
                                <div class="flex flex-col">
                                    <span id="productPName" class="font-semibold text-gray-900"></span>
                                    <div class="flex items-center mt-1">
                                        <span class="text-sm text-gray-600">Current quantity: </span>
                                        <span id="currentQuantityP" class="ml-1 font-medium"></span>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <label for="counter_quantity_p" class="block text-gray-700 text-sm">New quantity:</label>
                                    <input type="number" name="counter_quantity_p" id="counter_quantity_p" min="1" value="1" 
                                           class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-medium mb-2">Product E:</label>
                                <div class="flex flex-col">
                                    <span id="productEName" class="font-semibold text-gray-900"></span>
                                    <div class="flex items-center mt-1">
                                        <span class="text-sm text-gray-600">Current quantity: </span>
                                        <span id="currentQuantityE" class="ml-1 font-medium"></span>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <label for="counter_quantity_e" class="block text-gray-700 text-sm">New quantity:</label>
                                    <input type="number" name="counter_quantity_e" id="counter_quantity_e" min="1" value="1" 
                                           class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="closeCounterOfferModal()" 
                                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
                                Submit Counteroffer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Messages Section -->
            @if(session('success'))
                <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 px-4 py-3 rounded-md shadow-sm mb-6 relative flex items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-md shadow-sm mb-6 relative flex items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Inventory Info Message -->
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 px-4 py-3 rounded-md shadow-sm mb-6 relative flex items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                <div>
                    <p class="font-medium">Inventory Management</p>
                    <p class="text-sm">You can manage your inventory from the <a href="{{ route('dashboard') }}" class="text-blue-800 underline font-medium">Dashboard</a>. Add or update product quantities there before initiating trades.</p>
                </div>
            </div>

            <!-- Products Available for Trading Section -->
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg border-l-4 border-emerald-700 transition-all duration-300 hover:shadow-xl">
                <div class="p-4 text-gray-900">
                    <h3 class="font-semibold text-lg text-gray-900 flex items-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                        </svg>
                        Products Available for Trading
                    </h3>

                    @if(!Auth::user()->is_approved)
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-md shadow-sm mb-6 relative flex items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="font-medium">Admin Approval Required</p>
                                <p class="text-sm">Your account is pending approval by an administrator. You cannot initiate trades until your account has been approved.</p>
                            </div>
                        </div>
                    @endif

                    @if(Auth::user()->is_suspended)
                        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 px-4 py-3 rounded-md shadow-sm mb-6 relative flex items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="font-medium">Account Suspended</p>
                                <p class="text-sm">Your account has been suspended by an administrator. You cannot initiate trades until your account has been unsuspended.</p>
                            </div>
                        </div>
                    @endif

                    @if(!Auth::user()->partner_id)
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-md shadow-sm mb-6 relative flex items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="font-medium">Partner Required</p>
                                <p class="text-sm">You need to set a partner in your profile before you can initiate a four-party trade. <a href="{{ route('profile') }}" class="text-red-800 underline font-medium">Go to Profile Settings</a></p>
                            </div>
                        </div>
                    @endif

                    <!-- Search Products -->
                    <div class="mb-4">
                        <div class="relative">
                            <input type="text" id="productSearch" placeholder="Search products..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto bg-white rounded-lg shadow-inner">
                        <table class="min-w-full table-auto border-collapse text-sm">
                            <thead>
                                <tr class="bg-emerald-50 text-emerald-800 uppercase text-xs">
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider rounded-tl-lg">Product</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Value</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Available Quantity</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $filteredProducts = $otherUserProducts->filter(function($item) {
                                        // Only show products from users who have partners
                                        // Exclude products from the current user's partner
                                        return $item->user->partner_id && $item->user->id != Auth::user()->partner_id;
                                    });
                                @endphp
                                
                                @forelse($filteredProducts as $item)
                                    <tr class="hover:bg-emerald-50 transition-colors duration-150 ease-in-out">
                                        <td class="px-3 py-2 border-b border-gray-200 font-medium">{{ $item->product->name }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200 text-stone-700 font-medium">${{ number_format($item->product->value, 2) }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200">{{ $item->quantity }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200">
                                            @if(Auth::user()->partner_id && Auth::user()->is_approved && !Auth::user()->is_suspended)
                                                <button 
                                                    type="button" 
                                                    class="px-3 py-1 text-sm bg-emerald-700 text-white rounded-md hover:bg-emerald-800 flex items-center shadow-sm transition-all duration-200 hover:shadow open-trade-modal"
                                                    data-product-id="{{ $item->product->id }}"
                                                    data-product-name="{{ $item->product->name }}"
                                                    data-product-quantity="{{ $item->quantity }}"
                                                    data-product-value="{{ $item->product->value }}"
                                                    data-owner-id="{{ $item->user->id }}"
                                                    data-owner-name="{{ $item->user->name }}"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                                                    </svg>
                                                    Initiate Trade
                                                </button>
                                            @else
                                                <button 
                                                    type="button" 
                                                    class="px-3 py-1 text-sm bg-gray-400 text-white rounded-md flex items-center shadow-sm cursor-not-allowed"
                                                    title="{{ !Auth::user()->is_approved ? 'Your account requires approval' : (!Auth::user()->partner_id ? 'You need to set a partner in your profile first' : 'Your account is suspended') }}"
                                                    disabled
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                                                    </svg>
                                                    Initiate Trade
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-3 py-4 text-center text-gray-500 italic text-sm">
                                            No products are available for trading at the moment.
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

    <!-- Trade Modal -->
    <div id="tradeModal" class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm flex items-center justify-center hidden z-50 transition-all duration-300">
        <div class="bg-white p-6 rounded-lg shadow-2xl w-full max-w-md border-l-4 border-emerald-700 modal-content">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                    </svg>
                    Four-Party Barter Exchange
                </h3>
                <button type="button" class="text-gray-500 hover:text-gray-700 close-modal transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <form id="tradeForm" method="POST" action="{{ route('trade.initiate') }}">
                @csrf
                <input type="hidden" name="productp_id" id="productp_id">
                <input type="hidden" name="counterparty_id" id="counterparty_id">
                
                <!-- Desired Product Section -->
                <div class="mb-5 bg-emerald-50 rounded-lg p-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Product You Want (Role A):</label>
                    <div class="flex items-center">
                        <p id="requestedProductName" class="font-semibold text-emerald-800"></p>
                    </div>
                    <div class="flex justify-between mt-2 text-sm text-gray-600">
                        <div>Available: <span id="requestedProductQuantity" class="font-medium"></span></div>
                        <div>Value: $<span id="requestedProductValue" class="font-medium"></span></div>
                    </div>
                    <div class="mt-3">
                        <label for="quantity_p" class="block text-gray-700 text-sm font-bold">Quantity You Want:</label>
                        <input type="number" name="quantity_p" id="quantity_p" min="1" value="1" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                    </div>
                </div>
                
                <!-- Your Partner (B) Section -->
                <div class="mb-5 bg-blue-50 rounded-lg p-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Your Partner (Role B):</label>
                    <p class="font-semibold text-emerald-800">{{ Auth::user()->partner ? Auth::user()->partner->name : 'No partner set' }}</p>
                    
                    <div class="mt-3">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Product Your Partner Can Offer:</label>
                        <select name="producte_id" id="producte_id" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm required">
                            <option value="">-- Select a product --</option>
                            @if(Auth::user()->partner)
                                @foreach($partnerProducts as $item)
                                    <option value="{{ $item->product->id }}" data-quantity="{{ $item->quantity }}" data-value="{{ $item->product->value }}">
                                        {{ $item->product->name }} (Qty: {{ $item->quantity }}, Value: ${{ number_format($item->product->value, 2) }})
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <div class="text-xs text-red-500 mt-1 hidden" id="partnerProductRequiredMessage">
                            A product from your partner is required
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <label for="quantity_e" class="block text-gray-700 text-sm font-bold mb-2">Quantity Your Partner Will Provide:</label>
                        <input type="number" name="quantity_e" id="quantity_e" min="1" value="1" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                        <p class="text-xs text-gray-500 mt-1">This will be automatically calculated based on the equivalence table.</p>
                    </div>
                </div>
                
                <!-- Counterparty Information (X and Y) -->
                <div class="mb-5 bg-stone-50 rounded-lg p-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Counterparty (Role X):</label>
                    <p class="text-xs text-gray-500">The counterparty is the owner of the product you want to receive. Their identity remains anonymous during trading.</p>
                    
                    <div class="mt-3">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Counterparty's Partner (Role Y):</label>
                        <p class="text-xs text-gray-500">The counterparty will select their partner who will receive your partner's product.</p>
                    </div>
                </div>
                
                <!-- Equivalence Calculation Section -->
                <div class="mb-5 bg-gray-50 rounded-lg p-4" id="equivalenceCalculation" style="display: none;">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Trade Calculation:</label>
                    <div class="text-sm">
                        <div class="flex justify-between mb-1">
                            <span>Requested Product Value:</span>
                            <span>$<span id="calc_product_p_value">0.00</span> × <span id="calc_quantity_p">0</span> = $<span id="calc_total_p_value">0.00</span></span>
                        </div>
                        <div class="flex justify-between mb-1">
                            <span>Partner's Product Value:</span>
                            <span>$<span id="calc_product_e_value">0.00</span> × <span id="calc_quantity_e">0</span> = $<span id="calc_total_e_value">0.00</span></span>
                        </div>
                        <div class="flex justify-between mb-1 text-xs text-gray-500">
                            <span>Equivalence Weight:</span>
                            <span><span id="calc_weight_percentage">0</span>%</span>
                        </div>
                        <div class="flex justify-between mb-1 text-xs text-gray-500">
                            <span>Transfer Costs:</span>
                            <span><span id="calc_transfer_cost_p">0</span>% (P), <span id="calc_transfer_cost_e">0</span>% (E)</span>
                        </div>
                        <div class="border-t border-gray-300 mt-2 pt-2 font-semibold flex justify-between">
                            <span>Required Quantity to Offer:</span>
                            <span id="required_quantity">0</span>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md close-modal hover:bg-gray-300 transition-colors duration-200">
                        Cancel
                    </button>
                    <button type="submit" id="initiateTradeButton" class="px-4 py-2 bg-emerald-700 text-white rounded-md hover:bg-emerald-800 transition-colors duration-200">
                        Initiate Four-Party Trade
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Close modal functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Trade modal functionality
            const tradeModal = document.getElementById('tradeModal');
            const tradeButtons = document.querySelectorAll('.open-trade-modal');
            const initiateButton = document.getElementById('initiateTradeButton');
            const productESelect = document.getElementById('producte_id');
            const partnerProductRequiredMessage = document.getElementById('partnerProductRequiredMessage');
            
            // Validate form and update button state
            function validateTradeForm() {
                const productId = productESelect.value;
                
                if (!productId) {
                    partnerProductRequiredMessage.classList.remove('hidden');
                    initiateButton.disabled = true;
                    initiateButton.classList.remove('bg-emerald-700', 'hover:bg-emerald-800');
                    initiateButton.classList.add('bg-gray-400', 'cursor-not-allowed');
                    return false;
                } else {
                    partnerProductRequiredMessage.classList.add('hidden');
                    initiateButton.disabled = false;
                    initiateButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
                    initiateButton.classList.add('bg-emerald-700', 'hover:bg-emerald-800');
                    return true;
                }
            }
            
            // Call validation on product selection change
            productESelect.addEventListener('change', validateTradeForm);
            
            // Form submission validation
            document.getElementById('tradeForm').addEventListener('submit', function(event) {
                if (!validateTradeForm()) {
                    event.preventDefault();
                    return false;
                }
                
                // Add partner_b_id to the form submission (hidden input)
                const partnerId = {{ Auth::user()->partner_id ?? 'null' }};
                if (partnerId) {
                    // Create a hidden field with the partner's ID if it doesn't exist
                    if (!document.getElementById('partner_b')) {
                        const partnerInput = document.createElement('input');
                        partnerInput.type = 'hidden';
                        partnerInput.name = 'partner_b';
                        partnerInput.id = 'partner_b';
                        partnerInput.value = partnerId;
                        this.appendChild(partnerInput);
                    }
                }
                
                return true;
            });
            
            tradeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const productName = this.getAttribute('data-product-name');
                    const productQuantity = this.getAttribute('data-product-quantity');
                    const productValue = this.getAttribute('data-product-value');
                    const ownerId = this.getAttribute('data-owner-id');
                    const ownerName = this.getAttribute('data-owner-name');
                    
                    document.getElementById('productp_id').value = productId;
                    document.getElementById('counterparty_id').value = ownerId;
                    document.getElementById('requestedProductName').textContent = productName;
                    document.getElementById('requestedProductQuantity').textContent = productQuantity;
                    document.getElementById('requestedProductValue').textContent = productValue;
                    
                    // Reset the form
                    document.getElementById('quantity_p').value = 1;
                    document.getElementById('producte_id').selectedIndex = 0;
                    document.getElementById('quantity_e').value = 1;
                    document.getElementById('equivalenceCalculation').style.display = 'none';
                    
                    // Reset validation UI
                    validateTradeForm();
                    
                    tradeModal.classList.remove('hidden');
                });
            });
            
            // Calculate equivalence when product and quantity change
            const productPQuantity = document.getElementById('quantity_p');
            const productEQuantity = document.getElementById('quantity_e');
            
            function calculateEquivalence() {
                const productPId = document.getElementById('productp_id').value;
                const productEId = productESelect.value;
                const quantityP = productPQuantity.value;
                
                if (productPId && productEId && quantityP > 0) {
                    fetch('{{ route("trade.calculate") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            product_p_id: productPId,
                            product_e_id: productEId,
                            quantity_p: quantityP
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Update calculation display
                        document.getElementById('calc_product_p_value').textContent = parseFloat(document.getElementById('requestedProductValue').textContent).toFixed(2);
                        document.getElementById('calc_quantity_p').textContent = quantityP;
                        document.getElementById('calc_total_p_value').textContent = (parseFloat(document.getElementById('requestedProductValue').textContent) * quantityP).toFixed(2);
                        
                        document.getElementById('calc_product_e_value').textContent = parseFloat(productESelect.options[productESelect.selectedIndex].getAttribute('data-value')).toFixed(2);
                        document.getElementById('calc_quantity_e').textContent = data.required_quantity;
                        document.getElementById('calc_total_e_value').textContent = (parseFloat(productESelect.options[productESelect.selectedIndex].getAttribute('data-value')) * data.required_quantity).toFixed(2);
                        
                        document.getElementById('calc_weight_percentage').textContent = (data.weight_percentage * 100).toFixed(0);
                        document.getElementById('calc_transfer_cost_p').textContent = (data.transfer_cost_p * 100).toFixed(0);
                        document.getElementById('calc_transfer_cost_e').textContent = (data.transfer_cost_e * 100).toFixed(0);
                        
                        document.getElementById('required_quantity').textContent = data.required_quantity;
                        
                        // Set the quantity_e field
                        productEQuantity.value = data.required_quantity;
                        
                        // Show the calculation
                        document.getElementById('equivalenceCalculation').style.display = 'block';
                        
                        // Re-validate form
                        validateTradeForm();
                    })
                    .catch(error => {
                        console.error('Error calculating equivalence:', error);
                    });
                }
            }
            
            productPQuantity.addEventListener('change', calculateEquivalence);
            productESelect.addEventListener('change', calculateEquivalence);
            
            // Close modal functionality
            document.querySelectorAll('.close-modal').forEach(button => {
                button.addEventListener('click', function() {
                    document.querySelectorAll('.fixed').forEach(modal => {
                        modal.classList.add('hidden');
                    });
                });
            });
            
            // Initial validation
            validateTradeForm();
        });
    </script>

    <style>
    /* Animation for modal */
    .animate-appear {
        animation: appear 0.3s ease-out;
    }

    .animate-disappear {
        animation: disappear 0.3s ease-in;
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

    @keyframes disappear {
        from {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
        to {
            opacity: 0;
            transform: scale(0.95) translateY(10px);
        }
    }

    input:focus, select:focus, button:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.3);
    }
    </style>

    <!-- Product Search Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('productSearch');
            const productRows = document.querySelectorAll('table tbody tr');
            
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                productRows.forEach(row => {
                    // Skip the "No products available" row if it exists
                    if (row.cells.length === 1 && row.cells[0].getAttribute('colspan')) {
                        return;
                    }
                    
                    const productName = row.cells[0].textContent.toLowerCase();
                    const ownerName = row.cells[1].textContent.toLowerCase();
                    
                    if (productName.includes(searchTerm) || ownerName.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
                
                // Check if all rows are hidden (except the "No products" row)
                let allHidden = true;
                productRows.forEach(row => {
                    if (row.style.display !== 'none' && !(row.cells.length === 1 && row.cells[0].getAttribute('colspan'))) {
                        allHidden = false;
                    }
                });
                
                // Show "No results" message if needed
                let noResultsRow = document.getElementById('noSearchResults');
                if (allHidden && searchTerm !== '') {
                    if (!noResultsRow) {
                        noResultsRow = document.createElement('tr');
                        noResultsRow.id = 'noSearchResults';
                        const cell = document.createElement('td');
                        cell.setAttribute('colspan', '5');
                        cell.className = 'px-3 py-4 text-center text-gray-500 italic text-sm';
                        cell.textContent = 'No products match your search.';
                        noResultsRow.appendChild(cell);
                        document.querySelector('table tbody').appendChild(noResultsRow);
                    }
                } else if (noResultsRow) {
                    noResultsRow.remove();
                }
            });
        });
    </script>

    <!-- Counteroffer modal functions -->
    <script>
        function openCounterOfferModal(transactionId, productPName, quantityP, productEName, quantityE) {
            // Set form action
            document.getElementById('counterOfferForm').action = `{{ route('trade.counteroffer', '') }}/${transactionId}`;
            
            // Set current values
            document.getElementById('productPName').textContent = productPName;
            document.getElementById('currentQuantityP').textContent = quantityP;
            document.getElementById('counter_quantity_p').value = quantityP;
            
            document.getElementById('productEName').textContent = productEName;
            document.getElementById('currentQuantityE').textContent = quantityE;
            document.getElementById('counter_quantity_e').value = quantityE;
            
            // Show modal
            document.getElementById('counterOfferModal').classList.remove('hidden');
        }
        
        function closeCounterOfferModal() {
            document.getElementById('counterOfferModal').classList.add('hidden');
        }
        
        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('counterOfferModal');
            const modalContent = modal.querySelector('.bg-white');
            
            if (event.target === modal) {
                closeCounterOfferModal();
            }
        });
    </script>
</x-app-layout>