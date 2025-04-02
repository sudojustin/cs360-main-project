<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-700" viewBox="0 0 20 20" fill="currentColor">
                <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
            </svg>
            {{ __('Offers') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-green-700 transition-all duration-300 hover:shadow-xl">
                <div class="p-6 text-gray-900">
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

                    <h3 class="font-semibold text-xl text-gray-900 flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                        </svg>
                        Products Available for Trading
                    </h3>

                    <div class="overflow-x-auto bg-white rounded-lg shadow-inner">
                        <table class="min-w-full table-auto border-collapse">
                            <thead>
                                <tr class="bg-green-50 text-green-800 uppercase text-xs">
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider rounded-tl-lg">Product</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Description</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Owner</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Value</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Quantity</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Created At</th>
                                    <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr class="hover:bg-green-50 transition-colors duration-150 ease-in-out">
                                        <td class="px-4 py-3 border-b border-gray-200 font-medium">{{ $product->name }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200 text-gray-600 italic">{{ $product->description ?? 'No description available' }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200">{{ $product->owner->name ?? 'Unknown' }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200 text-green-700 font-medium">${{ number_format($product->value, 2) }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200">{{ $product->quantity }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200 text-gray-600">{{ $product->created_at->format('M d, Y') }}</td>
                                        <td class="px-4 py-3 border-b border-gray-200">
                                            @if(auth()->id() != $product->owner_id)
                                                <button 
                                                    type="button" 
                                                    class="px-4 py-2 bg-green-700 text-white rounded-md hover:bg-green-800 flex items-center shadow-sm transition-all duration-200 hover:shadow open-trade-modal"
                                                    data-product-id="{{ $product->id }}"
                                                    data-product-name="{{ $product->name }}"
                                                    data-product-quantity="{{ $product->quantity }}"
                                                    data-product-value="{{ $product->value }}"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                                                    </svg>
                                                    Initiate Trade
                                                </button>
                                            @else
                                                @php
                                                    $pendingOffer = \App\Models\Transaction::where(function ($query) use ($product) {
                                                            $query->where('productp_id', $product->id)
                                                                ->orWhere('producte_id', $product->id);
                                                        })
                                                        ->where('counterparty_id', auth()->id())
                                                        ->whereIn('status', ['pending', 'Pending'])
                                                        ->first();
                                                @endphp

                                                @if($pendingOffer)
                                                    <div class="flex space-x-2">
                                                        <form action="{{ route('trade.accept', $pendingOffer) }}" method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit" class="px-4 py-2 bg-green-700 text-white rounded-md hover:bg-green-800 flex items-center shadow-sm transition-all duration-200 hover:shadow">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                                </svg>
                                                                Accept
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('trade.reject', $pendingOffer) }}" method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit" class="px-4 py-2 bg-white border border-red-500 text-red-600 rounded-md hover:bg-red-50 flex items-center shadow-sm transition-all duration-200 hover:shadow">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                </svg>
                                                                Reject
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endif
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

    <!-- Pending Offers Section -->
    <div class="py-6 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-l-4 border-green-700 transition-all duration-300 hover:shadow-xl">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl text-gray-900 flex items-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                        </svg>
                        Pending Trade Offers From Others
                    </h3>
                    
                    @if($pendingOffers->isEmpty())
                        <div class="bg-blue-50 rounded-lg p-4 text-gray-500 italic flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            You currently have no pending trade offers.
                        </div>
                    @else
                        <div class="overflow-x-auto bg-white rounded-lg shadow-inner">
                            <table class="min-w-full table-auto border-collapse">
                                <thead>
                                    <tr class="bg-green-50 text-green-800 uppercase text-xs">
                                        <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider rounded-tl-lg">From</th>
                                        <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">They Want</th>
                                        <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">They Offer</th>
                                        <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider">Date Received</th>
                                        <th class="px-4 py-3 border-b border-gray-200 text-left font-medium tracking-wider rounded-tr-lg">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingOffers as $offer)
                                        <tr class="hover:bg-green-50 transition-colors duration-150 ease-in-out">
                                            <td class="px-4 py-3 border-b border-gray-200 font-medium">{{ $offer->initiator->name }}</td>
                                            <td class="px-4 py-3 border-b border-gray-200">
                                                @if($offer->producte)
                                                    <span class="font-medium">{{ $offer->producte->name }}</span>
                                                    <span class="text-sm text-gray-500 block">
                                                        Value: ${{ number_format($offer->producte->value, 2) }}
                                                    </span>
                                                @else
                                                    <span class="text-red-500">Unknown Product</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 border-b border-gray-200">
                                                @if($offer->productp)
                                                    <span class="font-medium">{{ $offer->productp->name }}</span>
                                                    <span class="text-sm text-gray-500 block">
                                                        Value: ${{ number_format($offer->productp->value, 2) }}
                                                    </span>
                                                @else
                                                    <span class="text-red-500">Unknown Product</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 border-b border-gray-200 text-gray-600">
                                                {{ \Carbon\Carbon::parse($offer->created_at)->format('M d, Y') }}
                                            </td>
                                            <td class="px-4 py-3 border-b border-gray-200">
                                                <div class="flex space-x-2">
                                                    <form action="{{ route('trade.accept', $offer) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="px-4 py-2 bg-green-700 text-white rounded-md hover:bg-green-800 flex items-center shadow-sm transition-all duration-200 hover:shadow">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                            </svg>
                                                            Accept
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('trade.reject', $offer) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="px-4 py-2 bg-white border border-red-500 text-red-600 rounded-md hover:bg-red-50 flex items-center shadow-sm transition-all duration-200 hover:shadow">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                            </svg>
                                                            Reject
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
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
                    Initiate Trade
                </h3>
                <button type="button" class="text-gray-500 hover:text-gray-700 close-modal transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <form id="tradeForm" method="POST" action="">
                @csrf
                <div class="mb-5 bg-green-50 rounded-lg p-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Product You Want:</label>
                    <div class="flex items-center">
                        <p id="requestedProductName" class="font-semibold text-green-800"></p>
                    </div>
                    <div class="flex justify-between mt-2 text-sm text-gray-600">
                        <div>Available: <span id="requestedProductQuantity" class="font-medium"></span></div>
                        <div>Value: $<span id="requestedProductValue" class="font-medium"></span></div>
                    </div>
                </div>
                
                <div class="mb-5">
                    <label for="request_quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity You Want:</label>
                    <div class="relative rounded-md shadow-sm">
                        <input type="number" name="request_quantity" id="request_quantity" min="1" value="1" 
                            class="block w-full pr-10 border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 transition-colors duration-200" required>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">unit(s)</span>
                        </div>
                    </div>
                </div>
                
                <div class="mb-5">
                    <label for="user_product_id" class="block text-gray-700 text-sm font-bold mb-2">Your Product to Offer:</label>
                    <select name="user_product_id" id="user_product_id" 
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 transition-colors duration-200" required>
                        <option value="">-- Select Your Product --</option>
                        <optgroup label="Your Products">
                            @foreach($userProducts as $userProduct)
                                <option value="{{ $userProduct->id }}" data-quantity="{{ $userProduct->quantity }}" data-value="{{ $userProduct->value }}" data-owner="self">
                                    {{ $userProduct->name }} (Qty: {{ $userProduct->quantity }}, Value: ${{ number_format($userProduct->value, 2) }})
                                </option>
                            @endforeach
                        </optgroup>
                        @if(auth()->user()->partner)
                            <optgroup label="Your Partner's Products">
                                @foreach(auth()->user()->partner->products as $partnerProduct)
                                    <option value="{{ $partnerProduct->id }}" data-quantity="{{ $partnerProduct->quantity }}" data-value="{{ $partnerProduct->value }}" data-owner="partner">
                                        {{ $partnerProduct->name }} (Qty: {{ $partnerProduct->quantity }}, Value: ${{ number_format($partnerProduct->value, 2) }})
                                    </option>
                                @endforeach
                            </optgroup>
                        @endif
                    </select>
                </div>
                
                <div class="mb-5">
                    <label for="offer_quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity to Offer:</label>
                    <div class="relative rounded-md shadow-sm">
                        <input type="number" name="offer_quantity" id="offer_quantity" min="1" value="1" 
                            class="block w-full pr-10 border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 transition-colors duration-200" required>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">unit(s)</span>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end mt-8 space-x-3">
                    <button type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors duration-200 close-modal">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-green-700 text-white rounded-md hover:bg-green-800 flex items-center shadow transition-all duration-200 ease-in-out transform hover:translate-y-[-1px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                        </svg>
                        Initiate Trade
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Trade modal functionality
        const tradeModal = document.getElementById('tradeModal');
        const openButtons = document.querySelectorAll('.open-trade-modal');
        const closeButtons = document.querySelectorAll('.close-modal');
        const modalContent = tradeModal.querySelector('.modal-content');
        const tradeForm = document.getElementById('tradeForm');
        
        // Open modal
        openButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const productName = this.getAttribute('data-product-name');
                const productQuantity = this.getAttribute('data-product-quantity');
                const productValue = this.getAttribute('data-product-value');
                
                document.getElementById('requestedProductName').textContent = productName;
                document.getElementById('requestedProductQuantity').textContent = productQuantity;
                document.getElementById('requestedProductValue').textContent = productValue;
                
                // Set the form action
                tradeForm.action = `/trade/initiate/${productId}`;
                
                // Show modal with animation
                tradeModal.classList.remove('hidden');
                setTimeout(() => {
                    modalContent.classList.add('animate-appear');
                }, 10);
            });
        });
        
        // Close modal
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                modalContent.classList.remove('animate-appear');
                modalContent.classList.add('animate-disappear');
                
                setTimeout(() => {
                    tradeModal.classList.add('hidden');
                    modalContent.classList.remove('animate-disappear');
                }, 300);
            });
        });
        
        // Close modal when clicking outside
        tradeModal.addEventListener('click', function(e) {
            if (e.target === tradeModal) {
                modalContent.classList.remove('animate-appear');
                modalContent.classList.add('animate-disappear');
                
                setTimeout(() => {
                    tradeModal.classList.add('hidden');
                    modalContent.classList.remove('animate-disappear');
                }, 300);
            }
        });
        
        // Quantity validation
        const requestQuantityInput = document.getElementById('request_quantity');
        const offerQuantityInput = document.getElementById('offer_quantity');
        const userProductSelect = document.getElementById('user_product_id');
        
        requestQuantityInput.addEventListener('change', function() {
            if (parseInt(this.value) < 1) {
                this.value = 1;
            }
        });
        
        offerQuantityInput.addEventListener('change', function() {
            if (parseInt(this.value) < 1) {
                this.value = 1;
            }
            
            // Check if selected quantity is available
            if (userProductSelect.value) {
                const selectedOption = userProductSelect.options[userProductSelect.selectedIndex];
                const availableQuantity = parseInt(selectedOption.getAttribute('data-quantity'));
                
                if (parseInt(this.value) > availableQuantity) {
                    this.value = availableQuantity;
                    alert('You cannot offer more than the available quantity.');
                }
            }
        });
        
        userProductSelect.addEventListener('change', function() {
            if (this.value) {
                const selectedOption = this.options[this.selectedIndex];
                const availableQuantity = parseInt(selectedOption.getAttribute('data-quantity'));
                const owner = selectedOption.getAttribute('data-owner');
                
                // Reset offer quantity to 1 when changing products
                offerQuantityInput.value = 1;
                
                // Update the form action to include the owner information
                const formAction = tradeForm.action;
                const baseUrl = formAction.split('/').slice(0, -1).join('/');
                tradeForm.action = `${baseUrl}/${this.value}?owner=${owner}`;
            }
        });

        // Form submission validation
        tradeForm.addEventListener('submit', function(e) {
            if (!userProductSelect.value) {
                e.preventDefault();
                alert('Please select a product to offer.');
                return;
            }

            const selectedOption = userProductSelect.options[userProductSelect.selectedIndex];
            const owner = selectedOption.getAttribute('data-owner');
            const availableQuantity = parseInt(selectedOption.getAttribute('data-quantity'));
            const requestedQuantity = parseInt(offerQuantityInput.value);

            if (requestedQuantity > availableQuantity) {
                e.preventDefault();
                alert('You cannot offer more than the available quantity.');
                return;
            }

            // Add owner information to the form data
            const ownerInput = document.createElement('input');
            ownerInput.type = 'hidden';
            ownerInput.name = 'product_owner';
            ownerInput.value = owner;
            this.appendChild(ownerInput);
        });
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
