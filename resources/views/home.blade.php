<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="text-black p-6">
        <h4 class="text-xl font-semibold mb-2">Welcome back, <span class="text-blue-400">{{ Auth::user()->name }}</span>
        </h4>
        <p class="text-gray-600 text-sm">We are glad to have you here! Let’s continue where you left off.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
        <!-- Total Products -->
        <div class="bg-white shadow-md rounded-lg p-4 flex items-center">
            <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                📦
            </div>
            <div class="ml-4">
                <p class="text-gray-600 text-sm">Total Products</p>
                <p class="text-xl font-semibold">{{ $totalProducts }}</p>
            </div>
        </div>

        <!-- Total Stock -->
        <div class="bg-white shadow-md rounded-lg p-4 flex items-center">
            <div class="bg-green-100 text-green-600 p-3 rounded-full">
                🏬
            </div>
            <div class="ml-4">
                <p class="text-gray-600 text-sm">Total Stock</p>
                <p class="text-xl font-semibold">{{ $totalStock }}</p>
            </div>
        </div>

        <!-- Total Purchases -->
        <div class="bg-white shadow-md rounded-lg p-4 flex items-center">
            <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full">
                🛒
            </div>
            <div class="ml-4">
                <p class="text-gray-600 text-sm">Total Purchases</p>
                <p class="text-xl font-semibold">{{ $totalPurchases }}</p>
            </div>
        </div>

        <!-- Total Suppliers -->
        <div class="bg-white shadow-md rounded-lg p-4 flex items-center">
            <div class="bg-red-100 text-red-600 p-3 rounded-full">
                🚚
            </div>
            <div class="ml-4">
                <p class="text-gray-600 text-sm">Total Suppliers</p>
                <p class="text-xl font-semibold">{{ $totalSuppliers }}</p>
            </div>
        </div>

        <!-- Total Customers -->
        <div class="bg-white shadow-md rounded-lg p-4 flex items-center">
            <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
                👥
            </div>
            <div class="ml-4">
                <p class="text-gray-600 text-sm">Total Customers</p>
                <p class="text-xl font-semibold">{{ $totalCustomers }}</p>
            </div>
        </div>
    </div>
</x-layout>
