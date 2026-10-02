<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>StayHub | Find Your Perfect Stay</title>

    <meta name="description"
          content="StayHub makes it easy for guests to book apartments and property managers to showcase their residences.">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            900: '#0c4a6e'
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 text-gray-900 antialiased">
<header class="sticky top-0 z-40 border-b border-gray-200 bg-white/95 backdrop-blur">

<div
    x-data="{
        mobileMenuOpen: false,
        userMenuOpen: false,
        bookingOpen: false,
        selectedApartment: null,
        checkIn: '',
        checkOut: '',

        openBooking(apartment) {
            this.selectedApartment = apartment;
            this.checkIn = '';
            this.checkOut = '';
            this.bookingOpen = true;
            document.body.classList.add('overflow-hidden');
        },

        closeBooking() {
            this.bookingOpen = false;
            this.selectedApartment = null;
            document.body.classList.remove('overflow-hidden');
        },

        get numberOfNights() {
            if (!this.checkIn || !this.checkOut) return 0;

            const start = new Date(this.checkIn);
            const end = new Date(this.checkOut);

            if (isNaN(start) || isNaN(end) || end <= start) {
                return 0;
            }

            return Math.ceil(
                (end.getTime() - start.getTime()) /
                (1000 * 60 * 60 * 24)
            );
        },

        get totalPrice() {
            if (!this.selectedApartment || this.numberOfNights <= 0) {
                return 0;
            }

            return this.numberOfNights *
                   Number(this.selectedApartment.price);
        },

        formatPrice(value) {
            return Number(value).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }
    }"
    @keydown.escape.window="closeBooking()"
>

    <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            <!-- Brand -->
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-brand-600 text-white shadow-sm">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4m4 0h4a1 1 0 001-1V10M9 21v-6a3 3 0 016 0v6"/>
                    </svg>
                </div>

                <span class="text-xl font-bold tracking-tight text-gray-900">
                    Stay<span class="text-brand-600">Hub</span>
                </span>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden items-center gap-3 md:flex">

                <a href="#apartments"
                    class="rounded-lg px-3 py-2 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-900">
                    Apartments
                </a>

                <a href="#about"
                    class="rounded-lg px-3 py-2 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-900">
                    About
                </a>

                @guest

                    <button
                        type="button"
                        onclick="document.getElementById('apartments').scrollIntoView({behavior: 'smooth'})"
                        class="rounded-lg px-3 py-2 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-900"
                    >
                        Search
                    </button>

                    <a href="{{ route('login') }}"
                        class="rounded-lg px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-100">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                        class="rounded-lg bg-brand-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2">
                        Register
                    </a>

                @endguest

                @auth

                    <!-- User Dropdown -->
                    <div class="relative" @click.outside="userMenuOpen = false">

                        <button
                            type="button"
                            @click="userMenuOpen = !userMenuOpen"
                            class="flex items-center gap-2 rounded-full border border-gray-200 bg-white p-1 pr-3 transition hover:border-gray-300 hover:shadow-sm"
                            :aria-expanded="userMenuOpen"
                        >
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-600 text-sm font-bold text-white">
                                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                            </span>

                            <span class="hidden max-w-32 truncate text-sm font-medium text-gray-700 sm:block">
                                {{ auth()->user()->name }}
                            </span>

                            <svg class="h-4 w-4 text-gray-500"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div
                            x-show="userMenuOpen"
                            x-transition
                            x-cloak
                            class="absolute right-0 mt-2 w-64 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-xl"
                        >
                            <div class="border-b border-gray-100 px-4 py-3">
                                <p class="truncate text-sm font-semibold text-gray-900">
                                    {{ auth()->user()->name }}
                                </p>
                                <p class="truncate text-xs text-gray-500">
                                    {{ auth()->user()->email }}
                                </p>
                            </div>

                            <div class="p-2">
                                <a href="{{ route('customers.bookings') }}"
                                    class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    My Bookings
                                </a>

                                <a href="{{ route('/') }}"
                                    class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 13h8V3H3v10zm10 8h8V11h-8v10zM3 21h8v-6H3v6zm10-10h8V3h-8v8z"/>
                                    </svg>
                                    Dashboard
                                </a>

                                <a href="{{ route('customers.settings') }}"
                                    class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                     <svg class="h-5 w-5 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10.5 6h9.75M10.5 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM3.75 6H4.5m6 12h9.75M10.5 18a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM3.75 18H4.5m9-6h6.75M13.5 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM3.75 12H7.5"/>
                                    </svg>
                                    Settings
                                </a>
                            </div>

                            <div class="border-t border-gray-100 p-2">
                                <form method="POST" action="{{ url('/logout') }}">
                                    @csrf

                                    <button type="submit"
                                            class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button
                type="button"
                @click="mobileMenuOpen = !mobileMenuOpen"
                class="rounded-lg p-2 text-gray-600 hover:bg-gray-100 md:hidden"
                aria-label="Toggle navigation"
            >
                <svg x-show="!mobileMenuOpen"
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                <svg x-show="mobileMenuOpen"
                        x-cloak
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="mobileMenuOpen"
                x-transition
                x-cloak
                class="border-t border-gray-100 py-4 md:hidden">

            <div class="space-y-1">

                <a href="#apartments"
                    @click="mobileMenuOpen = false"
                    class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                    Apartments
                </a>

                <a href="#about"
                    @click="mobileMenuOpen = false"
                    class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                    About
                </a>

                @guest

                    <a href="{{ route('login') }}"
                        class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                        class="mt-2 block rounded-lg bg-brand-600 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-brand-700">
                        Register
                    </a>

                @endguest

                    @auth

                        <div class="my-2 rounded-xl bg-gray-50 p-3">
                            <div class="flex items-center gap-3">
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-brand-600 font-bold text-white">
                                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                </span>
    
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold">
                                        {{ auth()->user()->name }}
                                    </p>
                                    <p class="truncate text-xs text-gray-500">
                                        {{ auth()->user()->email }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('customers.bookings') }}"
                           class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                            My Bookings
                        </a>

                        <a href="{{ url('/dashboard') }}"
                           class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                            Dashboard
                        </a>
                        <a href="{{ route('customers.settings') }}"
                        class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                            Settings
                        </a>

                        <form method="POST" action="{{ url('/logout') }}">
                            @csrf

                            <button type="submit"
                                    class="w-full rounded-lg px-3 py-2 text-left text-sm font-medium text-red-600 hover:bg-red-50">
                                Logout
                            </button>
                        </form>

                    @endauth
                </div>
            </div>
        </nav>
    </header>

    {{$slot}}

</body>
</html>