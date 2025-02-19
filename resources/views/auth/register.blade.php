<!DOCTYPE html>
<html lang="id">

<head>
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-lg w-80">
        <h4 class="text-center text-lg font-semibold">Register</h4>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('register') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                    name="name" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                    name="email" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                    name="password" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                    name="password_confirmation" required>
            </div>
            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">Login</button>
        </form>
        <p class="text-center text-sm text-gray-600 mt-3">Already have an account? <a href="{{ route('login') }}"
                class="text-blue-500 hover:underline">Login</a></p>
    </div>
</body>

</html>
