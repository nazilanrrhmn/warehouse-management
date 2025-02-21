<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <form id="product-form" action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-900">Product Name</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name"
                                value="{{ old('name', $product->name) }}" autocomplete="given-name"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-gray-900 border-gray-300 focus:ring-gray-600 focus:border-gray-600 sm:text-sm">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="price" class="block text-sm font-medium text-gray-900">Price</label>
                        <div class="mt-2">
                            <input type="number" name="price" id="price"
                                value="{{ old('price', $product->price) }}" step="0.01"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-gray-900 border-gray-300 focus:ring-gray-600 focus:border-gray-600 sm:text-sm">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="stock" class="block text-sm font-medium text-gray-900">Stock</label>
                        <div class="mt-2">
                            <input id="stock" name="stock" type="number"
                                value="{{ old('stock', $product->stock) }}"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-gray-900 border-gray-300 focus:ring-gray-600 focus:border-gray-600 sm:text-sm">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="supplier_id" class="block text-sm font-medium text-gray-900">Supplier</label>
                        <div class="mt-2">
                            <select name="supplier_id" id="supplier_id"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-gray-900 border-gray-300 focus:ring-gray-600 focus:border-gray-600 sm:text-sm">
                                <option value="">-- Select Supplier --</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"
                                        {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="description" class="block text-sm font-medium text-gray-900">Description</label>
                        <div class="mt-2">
                            <textarea name="description" id="description" rows="6"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-gray-900 border-gray-300 focus:ring-gray-600 focus:border-gray-600 sm:text-sm">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm font-semibold text-gray-900"
                onclick="window.history.back()">Cancel</button>
            <button type="submit" id="submit-button"
                class="rounded-md bg-gray-800 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-gray-700 focus:ring-gray-600 focus:border-gray-600">
                Save Product
            </button>
        </div>
    </form>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Konfirmasi sebelum submit
        document.getElementById('product-form').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to save this product?',
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

        // Notifikasi sukses setelah update produk
        @if (session('success'))
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonColor: "#3085d6",
            });
        @endif

        // Notifikasi sukses setelah produk dihapus
        @if (session('deleted'))
            Swal.fire({
                title: "Deleted!",
                text: "{{ session('deleted') }}",
                icon: "success",
                confirmButtonColor: "#d33",
            });
        @endif
    </script>

</x-layout>
