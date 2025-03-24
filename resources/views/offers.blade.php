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

                    <h3 class="font-semibold text-xl">Available Barter Offers</h3>

                    <table class="min-w-full table-auto mt-4 border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border-b">Product</th>
                                <th class="px-4 py-2 border-b">Owner</th>
                                <th class="px-4 py-2 border-b">Value</th>
                                <th class="px-4 py-2 border-b">Quantity</th>
                                <th class="px-4 py-2 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="px-4 py-2 border-b">{{ $product->name }}</td>
                                    <td class="px-4 py-2 border-b">{{ $product->owner_id }}</td>
                                    <td class="px-4 py-2 border-b">${{ number_format($product->value, 2) }}</td>
                                    <td class="px-4 py-2 border-b">{{ $product->quantity }}</td>
                                    <td class="px-4 py-2 border-b">
                                        <!-- Show 'Initiate Trade' button if user is not the owner -->
                                        @if(auth()->id() != $product->owner_id)
                                            <form action="{{ route('trade.initiate', $product) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                                    Initiate Trade
                                                </button>
                                            </form>
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
</x-app-layout>
