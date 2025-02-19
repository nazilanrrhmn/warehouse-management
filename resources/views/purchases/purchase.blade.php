<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <a href="{{ route('purchases.create') }}">
        <button type="button"
            class="bg-gray-700 text-white font-semibold py-2 px-4 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600">
            Add Purchases
        </button>
    </a>

    {{-- Table --}}

    <div class="overflow-x-auto mt-4">
        <table class="min-w-full table-auto bg-slate border-separate border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-gray-600">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-white">ID</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-white">Product Name</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-white">Supplier Name</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-white">Status</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-white">Payment Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $purchase)
                    <!-- Example product row -->
                    <tr class="border-b hover:bg-gray-300">
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $purchase->id }}</td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $purchase->product->name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $purchase->supplier->name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $purchase->status }}</td>
                        <td class="px-4 py-2 text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($purchase->purchase_date)->translatedFormat('d F Y') }}
                        </td>
                    </tr>
                    <!-- More product rows can be added here -->
                @endforeach
            </tbody>
        </table>
    </div>


</x-layout>
