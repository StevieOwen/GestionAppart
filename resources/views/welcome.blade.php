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

    <!-- =========================================================
         NAVIGATION
    ========================================================== -->
    <header class="sticky top-0 z-40 border-b border-gray-200 bg-white/95 backdrop-blur">
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

                    @if(!$user)

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

                    @else

                        <!-- User Dropdown -->
                        <div class="relative" @click.outside="userMenuOpen = false">

                            <button
                                type="button"
                                @click="userMenuOpen = !userMenuOpen"
                                class="flex items-center gap-2 rounded-full border border-gray-200 bg-white p-1 pr-3 transition hover:border-gray-300 hover:shadow-sm"
                                :aria-expanded="userMenuOpen"
                            >
                                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-600 text-sm font-bold text-white">
                                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                </span>

                                <span class="hidden max-w-32 truncate text-sm font-medium text-gray-700 sm:block">
                                    {{ $user->name }}
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
                                        {{ $user->name }}
                                    </p>
                                    <p class="truncate text-xs text-gray-500">
                                        {{ $user->email }}
                                    </p>
                                </div>

                                <div class="p-2">
                                    <a href="{{ url('/bookings') }}"
                                       class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        My Bookings
                                    </a>

                                    <a href="{{ url('/dashboard') }}"
                                       class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M3 13h8V3H3v10zm10 8h8V11h-8v10zM3 21h8v-6H3v6zm10-10h8V3h-8v8z"/>
                                        </svg>
                                        Dashboard
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

                    @endif
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

                    @if(!$user)

                        <a href="{{ route('login') }}"
                           class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                            Login
                        </a>

                        <a href="{{ route('register') }}"
                           class="mt-2 block rounded-lg bg-brand-600 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-brand-700">
                            Register
                        </a>

                    @else

                        <div class="my-2 rounded-xl bg-gray-50 p-3">
                            <div class="flex items-center gap-3">
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-brand-600 font-bold text-white">
                                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                </span>

                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold">
                                        {{ $user->name }}
                                    </p>
                                    <p class="truncate text-xs text-gray-500">
                                        {{ $user->email }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <a href="{{ url('/bookings') }}"
                           class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                            My Bookings
                        </a>

                        <a href="{{ url('/dashboard') }}"
                           class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                            Dashboard
                        </a>

                        <form method="POST" action="{{ url('/logout') }}">
                            @csrf

                            <button type="submit"
                                    class="w-full rounded-lg px-3 py-2 text-left text-sm font-medium text-red-600 hover:bg-red-50">
                                Logout
                            </button>
                        </form>

                    @endif
                </div>
            </div>
        </nav>
    </header>


    <!-- =========================================================
         HERO
    ========================================================== -->
    @if(!$user)

        <section class="relative overflow-hidden bg-white">
            <div class="absolute inset-0 -z-0">
                <div class="absolute -right-40 -top-40 h-96 w-96 rounded-full bg-brand-100 opacity-60 blur-3xl"></div>
                <div class="absolute -bottom-40 -left-40 h-96 w-96 rounded-full bg-sky-100 opacity-60 blur-3xl"></div>
            </div>

            <div class="relative mx-auto max-w-7xl px-4 py-20 sm:px-6 sm:py-28 lg:px-8">

                <div class="mx-auto max-w-3xl text-center">

                    <span class="inline-flex items-center rounded-full bg-brand-50 px-4 py-1.5 text-sm font-semibold text-brand-700 ring-1 ring-inset ring-brand-200">
                        Your next stay starts here
                    </span>

                    <h1 class="mt-6 text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">
                        Find a place you'll
                        <span class="text-brand-600">love to stay.</span>
                    </h1>

                    <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-gray-600">
                        StayHub connects property managers with guests looking for
                        comfortable apartments and residences. List your properties
                        or discover your next home away from home.
                    </p>

                    <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
                        <a href="{{ route('register') }}"
                           class="rounded-xl bg-brand-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-brand-600/20 transition hover:bg-brand-700">
                            Get Started
                        </a>

                        <a href="#apartments"
                           class="rounded-xl border border-gray-300 bg-white px-6 py-3.5 text-sm font-bold text-gray-700 transition hover:bg-gray-50">
                            Explore Apartments
                        </a>
                    </div>
                </div>
            </div>
        </section>


        <!-- Value Proposition -->
        <section id="about" class="bg-gray-50 py-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="mx-auto mb-10 max-w-2xl text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900">
                        Built for everyone
                    </h2>

                    <p class="mt-3 text-gray-600">
                        Whether you manage properties or need somewhere to stay,
                        StayHub simplifies the entire experience.
                    </p>
                </div>

                <div class="grid gap-6 md:grid-cols-2">

                    <!-- Managers -->
                    <div class="rounded-2xl border border-gray-200 bg-white p-8 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-brand-100 text-brand-700">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-4h6v4M9 9h.01M12 9h.01M15 9h.01M9 13h.01M12 13h.01M15 13h.01"/>
                            </svg>
                        </div>

                        <h3 class="mt-5 text-xl font-bold">
                            For Property Managers
                        </h3>

                        <p class="mt-3 leading-7 text-gray-600">
                            Showcase your buildings and apartments to potential
                            guests and make your properties easier to discover.
                        </p>

                        <a href="{{ route('register') }}"
                           class="mt-6 inline-flex items-center gap-2 font-semibold text-brand-600 hover:text-brand-700">
                            List your property
                            <span aria-hidden="true">→</span>
                        </a>
                    </div>

                    <!-- Guests -->
                    <div class="rounded-2xl border border-gray-200 bg-white p-8 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-100 text-green-700">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h12a1 1 0 001-1V10M9 21v-6a3 3 0 016 0v6"/>
                            </svg>
                        </div>

                        <h3 class="mt-5 text-xl font-bold">
                            For Guests
                        </h3>

                        <p class="mt-3 leading-7 text-gray-600">
                            Explore available apartments, compare their features,
                            choose your dates and book your next stay effortlessly.
                        </p>

                        <a href="#apartments"
                           class="mt-6 inline-flex items-center gap-2 font-semibold text-brand-600 hover:text-brand-700">
                            Find a place
                            <span aria-hidden="true">→</span>
                        </a>
                    </div>

                </div>
            </div>
        </section>


        <!-- Guest CTA -->
        <section class="bg-brand-600">
            <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
                <div class="flex flex-col items-center justify-between gap-8 text-center md:flex-row md:text-left">

                    <div>
                        <h2 class="text-3xl font-bold text-white">
                            Ready to find your next stay?
                        </h2>

                        <p class="mt-2 max-w-2xl text-brand-100">
                            Create your StayHub account and start exploring
                            available apartments today.
                        </p>
                    </div>

                    <a href="{{ route('register') }}"
                       class="shrink-0 rounded-xl bg-white px-6 py-3.5 text-sm font-bold text-brand-700 shadow-sm transition hover:bg-brand-50">
                        Register Now
                    </a>
                </div>
            </div>
        </section>

    @else

        <!-- =====================================================
             AUTHENTICATED WELCOME
        ====================================================== -->
        <section class="bg-white">
            <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">

                <div class="overflow-hidden rounded-2xl bg-gradient-to-r from-brand-700 to-brand-500 px-6 py-8 shadow-lg sm:px-10">

                    <div class="flex flex-col justify-between gap-6 md:flex-row md:items-center">

                        <div>
                            <p class="text-sm font-medium text-brand-100">
                                Welcome back
                            </p>

                            <h1 class="mt-1 text-3xl font-extrabold text-white sm:text-4xl">
                                {{ $user->name }}!
                            </h1>

                            <p class="mt-2 text-brand-100">
                                Ready for your next stay?
                            </p>
                        </div>

                        <a href="#apartments"
                           class="inline-flex w-fit items-center rounded-xl bg-white px-5 py-3 text-sm font-bold text-brand-700 shadow-sm transition hover:bg-brand-50">
                            Explore Apartments
                        </a>
                    </div>
                </div>


                <!-- Quick Status -->
                <div class="mt-6 grid gap-4 sm:grid-cols-3">

                    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                        <p class="text-sm font-medium text-gray-500">
                            Active Bookings
                        </p>
                        <p class="mt-2 text-3xl font-bold text-gray-900">
                            —
                        </p>
                    </div>

                    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                        <p class="text-sm font-medium text-gray-500">
                            Saved Listings
                        </p>
                        <p class="mt-2 text-3xl font-bold text-gray-900">
                            —
                        </p>
                    </div>

                    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                        <p class="text-sm font-medium text-gray-500">
                            Notifications
                        </p>
                        <p class="mt-2 text-3xl font-bold text-gray-900">
                            —
                        </p>
                    </div>

                </div>
            </div>
        </section>

    @endif


    <!-- =========================================================
         APARTMENTS
    ========================================================== -->
    <section id="apartments" class="bg-gray-50 py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">

                <div>
                    <span class="text-sm font-semibold uppercase tracking-wider text-brand-600">
                        Discover
                    </span>

                    <h2 class="mt-1 text-3xl font-bold tracking-tight text-gray-900">
                        Featured Apartments & Residences
                    </h2>

                    <p class="mt-2 text-gray-600">
                        Explore comfortable places available for your next stay.
                    </p>
                </div>

                <div class="rounded-lg bg-white px-4 py-2 text-sm text-gray-500 shadow-sm ring-1 ring-gray-200">
                    {{ $appartments->count() }} {{ $appartments->count() === 1 ? 'property' : 'properties' }}
                </div>

            </div>


            @forelse($appartments as $appartment)

                <!-- @php
                    $rooms = [];

                    if (is_array($appartment->rooms)) {
                        $rooms = $appartment->rooms;
                    } elseif (is_string($appartment->rooms)) {
                        $rooms = json_decode($appartment->rooms, true) ?: [];
                    }

                    $bedroom = $rooms['bedroom'] ?? $rooms['bedrooms'] ?? 0;
                    $bathroom = $rooms['bathroom'] ?? $rooms['bathrooms'] ?? 0;
                    $kitchen = $rooms['kitchen'] ?? 0;
                    $livingRoom = $rooms['living_room'] ?? $rooms['livingRoom'] ?? 0;

                    $imagePath = $appartment->img
                        ? asset('storage/' . $appartment->img)
                        : null;
                @endphp -->


                <!-- Apartment Card -->
                <article
                    class="group overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                >

                    <!-- Image -->
                    <div class="relative h-56 overflow-hidden bg-gray-100">

                        @if($img)
                            <img
                                src="{{ $img }}"
                                alt="{{ $appartment->appart_designation }}"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                loading="lazy"
                            >
                        @else
                            <div class="flex h-full items-center justify-center text-gray-400">
                                <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.5"
                                          d="M3 15l4-4a2 2 0 012.828 0L15 16m-3-3l2-2a2 2 0 012.828 0L21 15M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif

                        <div class="absolute left-4 top-4">
                            <span class="rounded-full bg-white/95 px-3 py-1 text-xs font-semibold text-gray-700 shadow-sm backdrop-blur">
                                Available
                            </span>
                        </div>

                    </div>


                    <!-- Card Content -->
                    <div class="p-5">

                        <!-- Required hidden apartment ID -->
                        <input
                            type="hidden"
                            name="appartment_id"
                            value="{{ $appartment->id }}"
                            data-appartment-id="{{ $appartment->id }}"
                        >


                        <div class="flex items-start justify-between gap-4">

                            <div class="min-w-0">
                                <h3 class="truncate text-lg font-bold text-gray-900">
                                    {{ $appartment->appart_designation }}
                                </h3>

                                <p class="mt-1 truncate text-sm text-gray-500">
                                    {{ $appartment->building_name }}
                                    <span class="mx-1">•</span>
                                    {{ $appartment->address }}
                                </p>
                            </div>

                        </div>


                        <!-- Room Features -->
                        <div class="mt-5 grid grid-cols-4 gap-2 border-y border-gray-100 py-4">

                            <!-- Bedroom -->
                            <div class="text-center">
                                <div class="mx-auto flex h-9 w-9 items-center justify-center rounded-lg bg-gray-50 text-gray-500">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="1.5"
                                              d="M3 18v-6a2 2 0 012-2h14a2 2 0 012 2v6M5 10V7a2 2 0 012-2h10a2 2 0 012 2v3M3 18h18M6 18v2M18 18v2"/>
                                    </svg>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">
                                    {{$appartment->bedroom == 1 ? 'Bed' : 'Beds' }}
                                </p>
                            </div>

                            <!-- Bathroom -->
                            <div class="text-center">
                                <div class="mx-auto flex h-9 w-9 items-center justify-center rounded-lg bg-gray-50 text-gray-500">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="1.5"
                                              d="M5 11h14M6 11V6a2 2 0 014-1v6M18 11v4a4 4 0 01-4 4h-4a4 4 0 01-4-4v-4M8 19v2M16 19v2"/>
                                    </svg>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">
                                    {{ $appartment->bathroom == 1 ? 'Bath' : 'Baths' }}
                                </p>
                            </div>

                            <!-- Kitchen -->
                            <div class="text-center">
                                <div class="mx-auto flex h-9 w-9 items-center justify-center rounded-lg bg-gray-50 text-gray-500">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="1.5"
                                              d="M6 3v18M10 3v6a2 2 0 01-4 0V3M14 3v18M18 3v18M16 3h4"/>
                                    </svg>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">
                                    {{ $appartment->kitchen }} Kitchen
                                </p>
                            </div>

                            <!-- Living Room -->
                            <div class="text-center">
                                <div class="mx-auto flex h-9 w-9 items-center justify-center rounded-lg bg-gray-50 text-gray-500">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="1.5"
                                              d="M4 11h16v7H4v-7zM6 11V8a2 2 0 012-2h8a2 2 0 012 2v3M7 18v2M17 18v2"/>
                                    </svg>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">
                                    {{ $appartment->livingRoom }} Living
                                </p>
                            </div>

                        </div>


                        <!-- Price + Action -->
                        <div class="mt-5 flex items-center justify-between gap-4">

                            <div>
                                <p class="text-xl font-bold text-gray-900">
                                    ${{ number_format($appartment->price, 2) }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    per night
                                </p>
                            </div>

                            <button
                                type="button"
                                @click="openBooking({
                                    id: {{ (int) $appartment->id }},
                                    name: @js($appartment->appart_designation),
                                    price: {{ (float) $appartment->price }}
                                })"
                                class="rounded-xl bg-brand-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                            >
                                Book Apartment
                            </button>

                        </div>

                    </div>
                </article>

            @empty

                <!-- Empty State -->
                <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-gray-100">
                        <svg class="h-8 w-8 text-gray-400"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="1.5"
                                  d="M3 15l4-4a2 2 0 012.828 0L15 16m-3-3l2-2a2 2 0 012.828 0L21 15M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>

                    <h3 class="mt-5 text-lg font-bold text-gray-900">
                        No apartments available
                    </h3>

                    <p class="mx-auto mt-2 max-w-md text-sm text-gray-500">
                        There are currently no apartments available for booking.
                        Please check back later.
                    </p>

                </div>

            @endforelse

        </div>
    </section>


    <!-- =========================================================
         BOOKING MODAL
    ========================================================== -->
    <div
        x-show="bookingOpen"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-50 overflow-y-auto"
        role="dialog"
        aria-modal="true"
        aria-labelledby="booking-modal-title"
    >

        <!-- Overlay -->
        <div
            class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm"
            @click="closeBooking()"
        ></div>


        <!-- Modal Container -->
        <div class="relative flex min-h-full items-center justify-center p-4">

            <div
                x-show="bookingOpen"
                x-transition
                @click.stop
                class="relative w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl"
            >

                <!-- Modal Header -->
                <div class="border-b border-gray-100 px-6 py-5">

                    <div class="flex items-start justify-between gap-4">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-brand-600">
                                Reservation
                            </p>

                            <h2 id="booking-modal-title"
                                class="mt-1 text-xl font-bold text-gray-900"
                                x-text="selectedApartment ? selectedApartment.name : 'Book Apartment'">
                            </h2>
                        </div>

                        <button
                            type="button"
                            @click="closeBooking()"
                            class="rounded-lg p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-700"
                            aria-label="Close booking modal"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>

                    </div>
                </div>


                <!-- Booking Form -->
                <form method="POST"
                      action="{{ url('/bookings/store') }}"
                      class="px-6 py-6"
                >
                    @csrf

                    <!-- Apartment ID -->
                    <input
                        type="hidden"
                        name="appartment_id"
                        :value="selectedApartment ? selectedApartment.id : ''"
                    >


                    <!-- Dates -->
                    <div class="grid gap-4 sm:grid-cols-2">

                        <div>
                            <label for="check_in"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                Check-In
                            </label>

                            <input
                                id="check_in"
                                name="check_in"
                                type="date"
                                x-model="checkIn"
                                required
                                :min="new Date().toISOString().split('T')[0]"
                                class="block w-full rounded-xl border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-brand-500 focus:ring-brand-500"
                            >
                        </div>

                        <div>
                            <label for="check_out"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                Check-Out
                            </label>

                            <input
                                id="check_out"
                                name="check_out"
                                type="date"
                                x-model="checkOut"
                                required
                                :min="checkIn || new Date().toISOString().split('T')[0]"
                                class="block w-full rounded-xl border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-brand-500 focus:ring-brand-500"
                            >
                        </div>

                    </div>


                    <!-- Price Summary -->
                    <div class="mt-6 rounded-xl bg-gray-50 p-4">

                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">
                                Price per night
                            </span>

                            <span class="font-semibold text-gray-900">
                                $<span x-text="selectedApartment ? formatPrice(selectedApartment.price) : '0.00'"></span>
                            </span>
                        </div>

                        <div class="mt-3 flex items-center justify-between text-sm">
                            <span class="text-gray-500">
                                Number of nights
                            </span>

                            <span class="font-semibold text-gray-900"
                                  x-text="numberOfNights">
                            </span>
                        </div>

                        <div class="mt-4 border-t border-gray-200 pt-4">

                            <div class="flex items-center justify-between">

                                <span class="font-bold text-gray-900">
                                    Estimated Total
                                </span>

                                <span class="text-2xl font-extrabold text-brand-600">
                                    $<span x-text="formatPrice(totalPrice)">
                                    </span>
                                </span>

                            </div>

                        </div>

                    </div>


                    <!-- Validation message -->
                    <div
                        x-show="checkIn && checkOut && numberOfNights <= 0"
                        x-cloak
                        class="mt-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700"
                    >
                        Check-out must be after check-in.
                    </div>


                    <!-- Actions -->
                    <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                        <button
                            type="button"
                            @click="closeBooking()"
                            class="rounded-xl border border-gray-300 px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            :disabled="numberOfNights <= 0"
                            :class="numberOfNights > 0
                                ? 'bg-brand-600 hover:bg-brand-700 cursor-pointer'
                                : 'bg-gray-300 cursor-not-allowed'"
                            class="rounded-xl px-5 py-3 text-sm font-bold text-white shadow-sm transition"
                        >
                            Confirm Booking
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>


    <!-- =========================================================
         FOOTER
    ========================================================== -->
    <footer class="border-t border-gray-200 bg-white">

        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">

            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">

                <!-- Brand -->
                <div class="lg:col-span-2">

                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2">
                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-brand-600 text-white">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4m4 0h4a1 1 0 001-1V10M9 21v-6a3 3 0 016 0v6"/>
                            </svg>
                        </div>

                        <span class="text-xl font-bold">
                            Stay<span class="text-brand-600">Hub</span>
                        </span>
                    </a>

                    <p class="mt-4 max-w-md text-sm leading-6 text-gray-500">
                        StayHub makes apartment discovery and booking simple,
                        helping guests find comfortable stays while giving
                        property managers a platform to showcase their residences.
                    </p>

                </div>


                <!-- Navigation -->
                <div>
                    <h3 class="text-sm font-bold text-gray-900">
                        Quick Links
                    </h3>

                    <ul class="mt-4 space-y-3 text-sm">

                        <li>
                            <a href="#apartments"
                               class="text-gray-500 transition hover:text-brand-600">
                                Apartments
                            </a>
                        </li>

                        <li>
                            <a href="#about"
                               class="text-gray-500 transition hover:text-brand-600">
                                About Us
                            </a>
                        </li>

                        @if(!$user)
                            <li>
                                <a href="{{ route('login') }}"
                                   class="text-gray-500 transition hover:text-brand-600">
                                    Login
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('register') }}"
                                   class="text-gray-500 transition hover:text-brand-600">
                                    Register
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ url('/bookings') }}"
                                   class="text-gray-500 transition hover:text-brand-600">
                                    My Bookings
                                </a>
                            </li>

                            <li>
                                <a href="{{ url('/dashboard') }}"
                                   class="text-gray-500 transition hover:text-brand-600">
                                    Dashboard
                                </a>
                            </li>
                        @endif

                    </ul>
                </div>


                <!-- Contact -->
                <div>
                    <h3 class="text-sm font-bold text-gray-900">
                        Contact
                    </h3>

                    <ul class="mt-4 space-y-3 text-sm text-gray-500">

                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M17.657 16.657L13.414 21l-1.414-1.414-5.657-5.657a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>

                            <span>
                                Your location
                            </span>
                        </li>

                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 shrink-0"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.502 5.502l1.13-2.257a1 1 0 011.21-.502l4.493 1.498A1 1 0 0121 15.72V19a2 2 0 01-2 2h-1C9.611 21 3 14.389 3 6V5z"/>
                            </svg>

                            <span>
                                Contact Support
                            </span>
                        </li>

                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 shrink-0"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>

                            <span>
                                support@stayhub.example
                            </span>
                        </li>

                    </ul>
                </div>

            </div>


            <!-- Bottom Footer -->
            <div class="mt-10 flex flex-col gap-4 border-t border-gray-100 pt-8 sm:flex-row sm:items-center sm:justify-between">

                <p class="text-sm text-gray-500">
                    © {{ date('Y') }} StayHub. All rights reserved.
                </p>

                <div class="flex gap-5 text-sm">

                    <a href="{{ url('/privacy') }}"
                       class="text-gray-500 hover:text-gray-900">
                        Privacy
                    </a>

                    <a href="{{ url('/terms') }}"
                       class="text-gray-500 hover:text-gray-900">
                        Terms
                    </a>

                </div>

            </div>

        </div>
    </footer>

</div>

<!-- Prevent Alpine x-cloak elements from flashing before Alpine initializes -->
<style>
    [x-cloak] {
        display: none !important;
    }
</style>

</body>
</html>

