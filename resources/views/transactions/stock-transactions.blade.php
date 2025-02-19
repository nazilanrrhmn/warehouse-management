<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <a href="{{ route('stock-transactions.create') }}">
        <button type="button"
            class="bg-gray-700 text-white font-semibold py-2 px-4 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600">
            Add Stock Transactions
        </button>
    </a>

    {{-- Table --}}

    <div class="overflow-x-auto mt-4">
        <table class="min-w-full table-auto bg-slate border-separate border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-gray-600">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-white">ID</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-white">Product Name</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-white">Quantity</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-white">Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <!-- Example product row -->
                    <tr class="border-b hover:bg-gray-300">
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $transaction->product->name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $transaction->quantity }}</td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ ucfirst($transaction->type) }}</td>
                    </tr>
                    <!-- More product rows can be added here -->
                @endforeach
            </tbody>
        </table>
    </div>


</x-layout>
