<footer class="bg-white shadow mt-8">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <div class="text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">Dashboard</a>
                <a href="{{ route('offers') }}" class="text-sm text-gray-500 hover:text-gray-700">Offers</a>
                <a href="{{ route('profile') }}" class="text-sm text-gray-500 hover:text-gray-700">Profile</a>
            </div>
        </div>
    </div>
</footer> 