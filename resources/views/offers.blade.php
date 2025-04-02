<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-700" viewBox="0 0 20 20" fill="currentColor">
                <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
            </svg>
            {{ __('Barter System') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Messages Section -->
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-md shadow-sm mb-6 relative flex items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-500" viewBox="0 0 20 20" fill="currentColor">
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
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zm-1 9a1 1 0 01-1-1v-4a1 1 0 112 0v4a1 1 0 01-1 1z" clip-rule="evenodd" />
                </svg>
                <div>
                    <p class="font-medium">Inventory Management</p>
                    <p class="text-sm">You can manage your inventory from the <a href="{{ route('dashboard') }}" class="text-blue-800 underline font-medium">Dashboard</a>. Add or update product quantities there before initiating trades.</p>
                </div>
            </div>

            <!-- Pending Trades from Others Section -->
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg border-l-4 border-yellow-500 transition-all duration-300 hover:shadow-xl mb-6">
                <div class="p-4 text-gray-900">
                    <h3 class="font-semibold text-lg text-gray-900 flex items-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-yellow-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                        Pending Trades from Others
                    </h3>

                    <div class="overflow-x-auto bg-white rounded-lg shadow-inner">
                        <table class="min-w-full table-auto border-collapse text-sm">
                            <thead>
                                <tr class="bg-yellow-50 text-yellow-800 uppercase text-xs">
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider rounded-tl-lg">Trader</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">You Give</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Qty</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">You Receive</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Qty</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Value</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($pendingTrades) && count($pendingTrades) > 0)
                                    @foreach($pendingTrades as $trade)
                                        @php
                                            $isInitiator = $trade->initiator->id === Auth::id();
                                            $theirProduct = $isInitiator ? $trade->offeredProduct : $trade->requestedProduct;
                                            $theirQuantity = $isInitiator ? $trade->quantity_offered : $trade->quantity_requested;
                                            $yourProduct = $isInitiator ? $trade->requestedProduct : $trade->offeredProduct;
                                            $yourQuantity = $isInitiator ? $trade->quantity_requested : $trade->quantity_offered;
                                            $tradePartner = $isInitiator ? $trade->receiver->name : $trade->initiator->name;
                                        @endphp
                                        <tr class="hover:bg-yellow-50 transition-colors duration-150 ease-in-out">
                                            <td class="px-3 py-2 border-b border-gray-200 font-medium">{{ $tradePartner }}</td>
                                            <td class="px-3 py-2 border-b border-gray-200">{{ $yourProduct->name }}</td>
                                            <td class="px-3 py-2 border-b border-gray-200">{{ $yourQuantity }}</td>
                                            <td class="px-3 py-2 border-b border-gray-200">{{ $theirProduct->name }}</td>
                                            <td class="px-3 py-2 border-b border-gray-200">{{ $theirQuantity }}</td>
                                            <td class="px-3 py-2 border-b border-gray-200 text-yellow-700 font-medium">
                                                ${{ number_format($theirProduct->value * $theirQuantity, 2) }}
                                                <div class="text-xs text-gray-500">
                                                    Status: {{ $trade->status }} | 
                                                    Last action: {{ isset($trade->last_action_by) ? $trade->last_action_by : 'None' }} | 
                                                    Current user: {{ Auth::id() }}
                                                </div>
                                            </td>
                                            <td class="px-3 py-2 border-b border-gray-200">
                                                <div class="flex space-x-2">
                                                    <form method="POST" action="{{ route('trade.accept', $trade->transaction_id) }}" class="m-0">
                                                        @csrf
                                                        <button type="submit" class="px-3 py-1 text-sm bg-green-700 text-white rounded-md hover:bg-green-800 transition-colors duration-200 shadow-sm">
                                                            Accept
                                                        </button>
                                                    </form>
                                                    <form method="POST" action="{{ route('trade.reject', $trade->transaction_id) }}" class="m-0">
                                                        @csrf
                                                        <button type="submit" class="px-3 py-1 text-sm bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-200 shadow-sm">
                                                            Reject
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="px-3 py-4 text-center text-gray-500 italic text-sm">
                                            No pending trades to review at the moment.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Products Available for Trading Section -->
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg border-l-4 border-green-700 transition-all duration-300 hover:shadow-xl">
                <div class="p-4 text-gray-900">
                    <h3 class="font-semibold text-lg text-gray-900 flex items-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                        </svg>
                        Products Available for Trading
                    </h3>

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

                    <div class="overflow-x-auto bg-white rounded-lg shadow-inner">
                        <table class="min-w-full table-auto border-collapse text-sm">
                            <thead>
                                <tr class="bg-green-50 text-green-800 uppercase text-xs">
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider rounded-tl-lg">Product</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Owner</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Value</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider">Available Quantity</th>
                                    <th class="px-3 py-2 border-b border-gray-200 text-left font-medium tracking-wider rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($otherUserProducts as $item)
                                    <tr class="hover:bg-green-50 transition-colors duration-150 ease-in-out">
                                        <td class="px-3 py-2 border-b border-gray-200 font-medium">{{ $item->product->name }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200">{{ $item->user->name }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200 text-green-700 font-medium">${{ number_format($item->product->value, 2) }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200">{{ $item->quantity }}</td>
                                        <td class="px-3 py-2 border-b border-gray-200">
                                            @if(Auth::user()->partner_id)
                                                <button 
                                                    type="button" 
                                                    class="px-3 py-1 text-sm bg-green-700 text-white rounded-md hover:bg-green-800 flex items-center shadow-sm transition-all duration-200 hover:shadow open-trade-modal"
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
                                                    title="You need to set a partner in your profile first"
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
                                @endforeach
                                
                                @if($otherUserProducts->isEmpty())
                                    <tr>
                                        <td colspan="5" class="px-3 py-4 text-center text-gray-500 italic text-sm">
                                            No products are available for trading at the moment.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Trade Modal -->
    <div id="tradeModal" class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm flex items-center justify-center hidden z-50 transition-all duration-300">
        <div class="bg-white p-6 rounded-lg shadow-2xl w-full max-w-md border-l-4 border-green-700 modal-content">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
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
                <div class="mb-5 bg-green-50 rounded-lg p-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Product You Want (Role A):</label>
                    <div class="flex items-center">
                        <p id="requestedProductName" class="font-semibold text-green-800"></p>
                    </div>
                    <div class="flex justify-between mt-2 text-sm text-gray-600">
                        <div>Available: <span id="requestedProductQuantity" class="font-medium"></span></div>
                        <div>Value: $<span id="requestedProductValue" class="font-medium"></span></div>
                    </div>
                    <div class="mt-3">
                        <label for="quantity_p" class="block text-gray-700 text-sm font-bold">Quantity You Want:</label>
                        <input type="number" name="quantity_p" id="quantity_p" min="1" value="1" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    </div>
                </div>
                
                <!-- Your Partner (B) Section -->
                <div class="mb-5 bg-blue-50 rounded-lg p-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Your Partner (Role B):</label>
                    <p class="font-semibold text-green-800">{{ Auth::user()->partner ? Auth::user()->partner->name : 'No partner set' }}</p>
                    
                    <div class="mt-3">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Product Your Partner Can Offer:</label>
                        <select name="producte_id" id="producte_id" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm required">
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
                        <input type="number" name="quantity_e" id="quantity_e" min="1" value="1" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        <p class="text-xs text-gray-500 mt-1">This will be automatically calculated based on the equivalence table.</p>
                    </div>
                </div>
                
                <!-- Counterparty Information (X and Y) -->
                <div class="mb-5 bg-yellow-50 rounded-lg p-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Counterparty (Role X):</label>
                    <p id="ownerName" class="font-semibold text-green-800"></p>
                    
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
                    <button type="submit" id="initiateTradeButton" class="px-4 py-2 bg-gray-400 text-white rounded-md cursor-not-allowed transition-colors duration-200" disabled>
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
                    initiateButton.classList.remove('bg-green-700', 'hover:bg-green-800');
                    initiateButton.classList.add('bg-gray-400', 'cursor-not-allowed');
                    return false;
                } else {
                    partnerProductRequiredMessage.classList.add('hidden');
                    initiateButton.disabled = false;
                    initiateButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
                    initiateButton.classList.add('bg-green-700', 'hover:bg-green-800');
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
                    document.getElementById('ownerName').textContent = ownerName;
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

    /* Improve focus styles for better accessibility */
    input:focus, select:focus, button:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(72, 187, 120, 0.3);
    }
    </style>
</x-app-layout>