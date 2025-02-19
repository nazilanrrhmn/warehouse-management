<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <a href="{{ route('customers.create') }}">
        <button type="button"
            class="bg-gray-700 text-white font-semibold py-2 px-4 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600">
            Add Customer
        </button>
    </a>

    {{-- Table --}}
    <div class="overflow-x-auto mt-4">
        <table class="min-w-full table-auto bg-slate border-separate border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-gray-600">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-white">ID</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-white">Customer Name</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-white">Email</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-white">Phone</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-white">Address</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-white">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr class="border-b hover:bg-gray-300">
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $customer['name'] }}</td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $customer['email'] }}</td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $customer['phone'] }}</td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $customer['address'] }}</td>
                        <td class="px-4 py-2 text-sm text-gray-600">
                            <a href="{{ route('customers.edit', $customer->id) }}"
                                class="text-blue-500 hover:text-blue-700">Edit</a>
                            <span class="text-gray-500 mx-2">|</span>
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                class="delete-form" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="text-red-500 hover:text-red-700 delete-button">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- SweetAlert Script --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('.delete-form'); // Ambil form terkait
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This action cannot be undone!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Kirim form jika dikonfirmasi
                        }
                    });
                });
            });
        });
    </script>
</x-layout>
