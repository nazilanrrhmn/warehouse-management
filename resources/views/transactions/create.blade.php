<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @error('quantity')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror

    @if (session('success'))
        <div id="success-alert"
            class="flex items-center p-4 mb-4 text-sm text-green-700 bg-green-100 border border-green-400 rounded-lg transition-opacity duration-500"
            role="alert">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span class="font-medium">Success!</span> {{ session('success') }}
        </div>
    @endif

    <form id="stock-transaction-form" action="{{ route('stock-transactions.store') }}" method="POST">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    {{-- Pilih Produk --}}
                    <div class="sm:col-span-2">
                        <label for="product_id" class="block text-sm font-medium text-gray-900">Product Name</label>
                        <div class="mt-2">
                            <select name="product_id" id="product_id" required
                                class="block w-full rounded-md border-gray-300 px-3 py-1.5 text-base text-gray-900 outline-1 focus:ring-gray-600 focus:border-gray-600 sm:text-sm">
                                <option value="" disabled selected>Select a product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Pilih Supplier --}}
                    <div class="sm:col-span-2">
                        <label for="supplier_id" class="block text-sm font-medium text-gray-900">Supplier</label>
                        <div class="mt-2">
                            <select name="supplier_id" id="supplier_id"
                                class="block w-full rounded-md border-gray-300 px-3 py-1.5 text-base text-gray-900 outline-1 focus:ring-gray-600 focus:border-gray-600 sm:text-sm">
                                <option value="" disabled selected>Select a supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Jumlah Stok --}}
                    <div class="sm:col-span-2">
                        <label for="quantity" class="block text-sm font-medium text-gray-900">Quantity</label>
                        <div class="mt-2">
                            <input type="number" name="quantity" id="quantity" min="1" required
                                class="block w-full rounded-md border-gray-300 px-3 py-1.5 text-base text-gray-900 outline-1 focus:ring-gray-600 focus:border-gray-600 sm:text-sm"
                                placeholder="Enter quantity">
                        </div>
                    </div>

                    {{-- Jenis Transaksi --}}
                    <div class="sm:col-span-2">
                        <label for="type" class="block text-sm font-medium text-gray-900">Transaction Type</label>
                        <div class="mt-2">
                            <select name="type" id="type" required
                                class="block w-full rounded-md border-gray-300 px-3 py-1.5 text-base text-gray-900 outline-1 focus:ring-gray-600 focus:border-gray-600 sm:text-sm">
                                <option value="" disabled selected>Select transaction type</option>
                                <option value="IN">Stock In</option>
                                <option value="OUT">Stock Out</option>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm font-semibold text-gray-900"
                onclick="window.history.back()">Cancel</button>
            <button type="submit" id="submit-button"
                class="rounded-md bg-gray-800 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-gray-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                Save Transaction
            </button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('stock-transaction-form').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to save this transaction?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>
</x-layout>
