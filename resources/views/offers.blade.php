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

                    @if(session('success'))
                        <div class="text-green-500">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="text-red-500">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h3 class="font-semibold text-xl">Products Available for Trading</h3>

                    <table class="min-w-full table-auto mt-4 border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border-b text-left">Product</th>
                                <th class="px-4 py-2 border-b text-left">Description</th>
                                <th class="px-4 py-2 border-b text-left">Owner</th>
                                <th class="px-4 py-2 border-b text-left">Value</th>
                                <th class="px-4 py-2 border-b text-left">Quantity</th>
                                <th class="px-4 py-2 border-b text-left">Created At</th>
                                <th class="px-4 py-2 border-b text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="px-4 py-2 border-b">{{ $product->name }}</td>
                                    <td class="px-4 py-2 border-b text-gray-600 italic">{{ $product->description ?? 'No description available' }}</td>
                                    <td class="px-4 py-2 border-b">{{ $product->owner->name ?? 'Unknown' }}</td>
                                    <td class="px-4 py-2 border-b">${{ number_format($product->value, 2) }}</td>
                                    <td class="px-4 py-2 border-b">{{ $product->quantity }}</td>
                                    <td class="px-4 py-2 border-b">{{ $product->created_at->format('M d, Y') }}</td>
                                    <td class="px-4 py-2 border-b">
                                        <!-- Show 'Initiate Trade' button if user is not the owner -->
                                        @if(auth()->id() != $product->owner_id)
                                            <button 
                                                type="button" 
                                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 open-trade-modal"
                                                data-product-id="{{ $product->id }}"
                                                data-product-name="{{ $product->name }}"
                                                data-product-quantity="{{ $product->quantity }}"
                                                data-product-value="{{ $product->value }}"
                                            >
                                                Initiate Trade
                                            </button>
                                        @else
                                            <!-- Check if the user is the owner and there is a pending trade with them -->
                                            @php
                                                $pendingOffer = \App\Models\Transaction::where(function ($query) use ($product) {
                                                        $query->where('productp_id', $product->id)
                                                            ->orWhere('producte_id', $product->id);
                                                    })
                                                    ->where('counterparty_id', auth()->id())
                                                    ->whereIn('status', ['pending', 'Pending'])
                                                    ->first();
                                            @endphp

                                            <!-- Debugging: Show if no pending offer exists -->
                                            @if(!$pendingOffer)
                                                <div class="text-red-500">
                                                    No pending offer for this product.
                                                </div>
                                            @endif

                                            <!-- Show accept/reject buttons if a pending trade exists -->
                                            @if($pendingOffer)
                                                <form action="{{ route('trade.accept', $pendingOffer) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                                        Accept Trade
                                                    </button>
                                                </form>
                                                <form action="{{ route('trade.reject', $pendingOffer) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                                        Reject Trade
                                                    </button>
                                                </form>
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

    <!-- Pending Offers Section -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl mb-4">Pending Trade Offers From Others</h3>
                    
                    @if($pendingOffers->isEmpty())
                        <p class="text-gray-500 italic">You currently have no pending trade offers.</p>
                    @else
                        <table class="min-w-full table-auto border-collapse">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 border-b text-left">From</th>
                                    <th class="px-4 py-2 border-b text-left">They Want</th>
                                    <th class="px-4 py-2 border-b text-left">They Offer</th>
                                    <th class="px-4 py-2 border-b text-left">Date Received</th>
                                    <th class="px-4 py-2 border-b text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingOffers as $offer)
                                    <tr>
                                        <td class="px-4 py-2 border-b">{{ $offer->initiator->name }}</td>
                                        <td class="px-4 py-2 border-b">
                                            @if($offer->producte)
                                                {{ $offer->producte->name }}
                                                <span class="text-sm text-gray-500">
                                                    (${{ number_format($offer->producte->value, 2) }})
                                                </span>
                                            @else
                                                <span class="text-red-500">Unknown Product</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 border-b">
                                            @if($offer->productp)
                                                {{ $offer->productp->name }}
                                                <span class="text-sm text-gray-500">
                                                    (${{ number_format($offer->productp->value, 2) }})
                                                </span>
                                            @else
                                                <span class="text-red-500">Unknown Product</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 border-b">
                                            {{ \Carbon\Carbon::parse($offer->created_at)->format('M d, Y') }}
                                        </td>
                                        <td class="px-4 py-2 border-b">
                                            <div class="flex space-x-2">
                                                <form action="{{ route('trade.accept', $offer) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                                        Accept
                                                    </button>
                                                </form>
                                                <form action="{{ route('trade.reject', $offer) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                                        Reject
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Trade Modal -->
    <div id="tradeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold">Initiate Trade</h3>
                <button type="button" class="text-gray-500 hover:text-gray-700 close-modal text-2xl font-bold">&times;</button>
            </div>
            
            <form id="tradeForm" method="POST" action="">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Product You Want:</label>
                    <div class="flex items-center">
                        <p id="requestedProductName" class="font-semibold"></p>
                        <p class="ml-2">
                            (Available: <span id="requestedProductQuantity"></span>, 
                            Value: $<span id="requestedProductValue"></span>)
                        </p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="request_quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity You Want:</label>
                    <input type="number" name="request_quantity" id="request_quantity" min="1" value="1" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                
                <div class="mb-4">
                    <label for="user_product_id" class="block text-gray-700 text-sm font-bold mb-2">Your Product to Offer:</label>
                    <select name="user_product_id" id="user_product_id" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="">-- Select Your Product --</option>
                        @foreach($userProducts as $userProduct)
                            <option value="{{ $userProduct->id }}" data-quantity="{{ $userProduct->quantity }}" data-value="{{ $userProduct->value }}">
                                {{ $userProduct->name }} (Qty: {{ $userProduct->quantity }}, Value: ${{ number_format($userProduct->value, 2) }})
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="offer_quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity to Offer:</label>
                    <input type="number" name="offer_quantity" id="offer_quantity" min="1" value="1" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                
                <div class="flex justify-end mt-6">
                    <button type="button" class="px-4 py-2 bg-gray-300 text-gray-800 rounded mr-2 close-modal">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Initiate Trade</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/trade-modal.js') }}"></script>
</x-app-layout>
