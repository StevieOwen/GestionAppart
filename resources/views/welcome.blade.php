<x-customerLayout>

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
         APARTMENTS (DISCOVER & FILTER SECTION)
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

            <!-- Address and Date Search / Filter Form -->
            <div class="mb-10 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <form action="{{ url('/#apartments') }}" method="GET" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 items-end">
                    
                    <!-- Address / Location Search -->
                    <div>
                        <label for="address" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1">
                            Address / Location
                        </label>
                        <div class="relative">
                            <input
                                type="text"
                                name="address"
                                id="address"
                                value="{{ request('address') }}"
                                placeholder="City, street, or building name..."
                                class="w-full rounded-xl border border-gray-300 bg-gray-50 px-3.5 py-2.5 pl-10 text-sm text-gray-900 focus:border-brand-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                            >
                            <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 21l-1.414-1.414-5.657-5.657a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Check-in Date -->
                    <div>
                        <label for="check_in" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1">
                            Check-in Date
                        </label>
                        <input
                            type="date"
                            name="check_in"
                            id="check_in"
                            value="{{ request('check_in') }}"
                            class="w-full rounded-xl border border-gray-300 bg-gray-50 px-3.5 py-2.5 text-sm text-gray-900 focus:border-brand-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                        >
                    </div>

                    <!-- Check-out Date -->
                    <div>
                        <label for="check_out" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1">
                            Check-out Date
                        </label>
                        <input
                            type="date"
                            name="check_out"
                            id="check_out"
                            value="{{ request('check_out') }}"
                            class="w-full rounded-xl border border-gray-300 bg-gray-50 px-3.5 py-2.5 text-sm text-gray-900 focus:border-brand-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                        >
                    </div>

                    <!-- Submit & Clear Actions -->
                    <div class="flex items-center gap-2">
                        <button
                            type="submit"
                            class="flex-1 rounded-xl bg-brand-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                        >
                            Filter Results
                        </button>

                        @if(request()->hasAny(['address', 'check_in', 'check_out']))
                            <a
                                href="{{ url('/#apartments') }}"
                                class="rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-50"
                                title="Clear filters"
                            >
                                Clear
                            </a>
                        @endif
                    </div>

                </form>
            </div>


            <!-- Grid Container -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

                @forelse($appartments as $appartment)

                    @php
                        $firstImage = $appartment->images->first();
                    @endphp

                    <!-- Apartment Card -->
                    <article
                        class="group overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                    >

                        <!-- Image -->
                        <div class="relative h-56 overflow-hidden bg-gray-100">

                            @if($firstImage)
                                <img
                                    src="{{ asset('storage/' . $firstImage->img) }}"
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
                                        {{ $appartment->building->building_name }}
                                        <span class="mx-1">•</span>
                                        {{ $appartment->building->address }}
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
                                       {{ $appartment->bedroom }} {{ $appartment->bedroom == 1 ? 'Bed' : 'Beds' }}
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
                                        {{ $appartment->bathroom}} {{ $appartment->bathroom == 1 ? 'Bath' : 'Baths' }}
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
                                        {{ $appartment->kitchen }} {{ $appartment->kitchen == 1 ? 'Kitchen' : 'Kitchens' }} 
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
                                        {{ $appartment->livingroom }} {{ $appartment->livingroom == 1 ? 'Living' : 'Livings' }} 
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

                                <a
                                    href="{{ route('customers.book-appartment', array_filter(['id' => $appartment->id, 'check_in' => request('check_in'), 'check_out' => request('check_out')])) }}"
                                    class="inline-flex items-center justify-center rounded-xl bg-brand-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                                >
                                    Book Apartment
                                </a>

                            </div>

                        </div>
                    </article>

                @empty

                    <!-- Empty State -->
                    <div class="col-span-full rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center">

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
                            There are currently no apartments matching your selected filters. Try searching for a different address or date range.
                        </p>

                    </div>

                @endforelse

            </div>

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
                                <a href="{{ route('customers.bookings')}}"
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

</x-customerLayout>