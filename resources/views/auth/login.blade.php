<!DOCTYPE html>
<html lang="id">

<head>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-lg w-80">
        <h4 class="text-center text-lg font-semibold">Login</h4>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST" class="mt-4">
            @csrf
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
            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">Login</button>
        </form>
        <p class="text-center text-sm text-gray-600 mt-3">Don't have an account? <a href="{{ route('register') }}"
                class="text-blue-500 hover:underline">Register</a></p>
    </div>
</body>

</html>
