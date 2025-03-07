<nav class="bg-gray-800" x-data="{ isOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <a href="/">
                        <img class="size-10" src="/img/logo.png" alt="Your Company">
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <x-nav-link href="/home" :active="request()->is('home')">Home</x-nav-link>
                        <x-nav-link href="/products" :active="request()->is('products')">Product</x-nav-link>
                        <x-nav-link href="/stock-transactions" :active="request()->is('stock-transactions')">Stock</x-nav-link>
                        <x-nav-link href="/purchases" :active="request()->is('purchases')">Purchase</x-nav-link>
                        <x-nav-link href="/suppliers" :active="request()->is('suppliers')">Suppliers</x-nav-link>
                        <x-nav-link href="/customers" :active="request()->is('customers')">Customer</x-nav-link>
                    </div>
                </div>
            </div>

            <!-- Profile dropdown -->
            @auth
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        <div class="relative ml-3">
                            <button type="button" @click="isOpen = !isOpen"
                                class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-none"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="size-8 rounded-full"
                                    src="{{ auth()->user()->profile_photo_url ?? 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}"
                                    alt="">
                            </button>

                            <div x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform"
                                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75 transform"
                                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                tabindex="-1">

                                <div class="px-4 py-2 text-sm text-gray-700">
                                    <div class="font-semibold">{{ auth()->user()->name }}</div>
                                    <div class="text-sm text-gray-500">{{ auth()->user()->email }}</div>
                                </div>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endauth

            <!-- Mobile menu button -->
            <div class="-mr-2 flex md:hidden">
                <button type="button" @click="isOpen = !isOpen"
                    class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-none"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg :class="{ 'hidden': isOpen, 'block': !isOpen }" class="block size-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg :class="{ 'block': isOpen, 'hidden': !isOpen }" class="hidden size-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="isOpen" class="md:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
            <x-nav-link href="/home" :active="request()->is('home')">Home</x-nav-link>
            <x-nav-link href="/products" :active="request()->is('products')">Product</x-nav-link>
            <x-nav-link href="/stock-transactions" :active="request()->is('stock-transactions')">Stock</x-nav-link>
            <x-nav-link href="/suppliers" :active="request()->is('suppliers')">Suppliers</x-nav-link>
            <x-nav-link href="/customers" :active="request()->is('customers')">Customer</x-nav-link>
        </div>

        @auth
            <div class="border-t border-gray-700 pt-4 pb-3">
                <div class="flex items-center px-5">
                    <div class="shrink-0">
                        <img class="size-10 rounded-full"
                            src="{{ auth()->user()->profile_photo_url ?? 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}"
                            alt="Photo Profiles">
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-white">{{ auth()->user()->name }}</div>
                        <div class="text-sm font-medium text-gray-400">{{ auth()->user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1 px-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">
                            Sign out
                        </button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
