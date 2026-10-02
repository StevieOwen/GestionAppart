<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Manager Dashboard') - StayHub
    </title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Tailwind Configuration --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        jakarta: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    {{-- Alpine.js --}}
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js">
    </script>

    {{-- Prevent Alpine flicker --}}
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-slate-100 text-slate-900 antialiased">

    <div
        x-data="{
            sidebarOpen: true,
            mobileSidebarOpen: false
        }"
        class="min-h-screen"
    >

        {{-- ============================================================
            MOBILE SIDEBAR OVERLAY
        ============================================================= --}}
        <div
            x-show="mobileSidebarOpen"
            x-cloak
            x-transition.opacity
            @click="mobileSidebarOpen = false"
            class="fixed inset-0 z-40 bg-slate-950/60 backdrop-blur-sm lg:hidden"
            aria-hidden="true"
        ></div>


        {{-- ============================================================
            SIDEBAR
        ============================================================= --}}
        <aside
            class="fixed inset-y-0 left-0 z-50 flex flex-col bg-slate-900 text-white border-r border-slate-800 transition-all duration-300 ease-in-out
                   -translate-x-full lg:translate-x-0"
            :class="[
                mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0',
                sidebarOpen ? 'w-64' : 'w-20'
            ]"
        >

            {{-- Sidebar Header --}}
            <div
                class="flex h-16 items-center border-b border-slate-800"
                :class="sidebarOpen ? 'justify-between px-5' : 'justify-center px-3'"
            >

                {{-- Logo --}}
                <a
                    href="{{ route('overview') }}"
                    class="flex items-center gap-3 min-w-0"
                >

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-600 shadow-lg shadow-indigo-950/30"
                    >
                        <svg
                            class="h-6 w-6 text-white"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h12a1 1 0 001-1V10"
                            />
                        </svg>
                    </div>

                    <div
                        x-show="sidebarOpen"
                        x-cloak
                        x-transition.opacity
                        class="min-w-0"
                    >
                        <div class="font-jakarta text-lg font-extrabold tracking-tight text-white">
                            StayHub
                        </div>

                        <div class="text-[10px] font-semibold uppercase tracking-widest text-slate-500">
                            Manager Portal
                        </div>
                    </div>

                </a>


                {{-- Mobile Close Button --}}
                <button
                    type="button"
                    @click="mobileSidebarOpen = false"
                    class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-800 hover:text-white lg:hidden"
                    aria-label="Close sidebar"
                >
                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>

            </div>


            {{-- ========================================================
                SIDEBAR NAVIGATION
            ========================================================= --}}
            <nav class="flex-1 space-y-2 overflow-y-auto px-3 py-6">

                {{-- Overview --}}
                <a
                    href="{{ route('overview') }}"
                    @class([
                        'group relative flex items-center gap-3 rounded-xl px-3 py-3 transition-all duration-200',
                        'bg-indigo-600 text-white font-semibold shadow-sm shadow-indigo-950/20'
                            => request()->routeIs('overview'),
                        'text-slate-400 hover:bg-slate-800 hover:text-white'
                            => !request()->routeIs('overview'),
                    ])
                    :class="sidebarOpen ? '' : 'justify-center'"
                    aria-current="{{ request()->routeIs('overview') ? 'page' : 'false' }}"
                >

                    @if(request()->routeIs('overview'))
                        <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-white"></span>
                    @endif

                    <svg
                        class="h-5 w-5 shrink-0 {{ request()->routeIs('overview') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h12a1 1 0 001-1V10"
                        />
                    </svg>

                    <span
                        x-show="sidebarOpen"
                        x-cloak
                        class="whitespace-nowrap"
                    >
                        Overview
                    </span>

                </a>


                {{-- Buildings --}}
                <a
                    href="{{ route('buildings.create') }}"
                    @class([
                        'group relative flex items-center gap-3 rounded-xl px-3 py-3 transition-all duration-200',
                        'bg-indigo-600 text-white font-semibold shadow-sm shadow-indigo-950/20'
                            => request()->routeIs('buildings.*'),
                        'text-slate-400 hover:bg-slate-800 hover:text-white'
                            => !request()->routeIs('buildings.*'),
                    ])
                    :class="sidebarOpen ? '' : 'justify-center'"
                    aria-current="{{ request()->routeIs('buildings.*') ? 'page' : 'false' }}"
                >

                    @if(request()->routeIs('buildings.*'))
                        <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-white"></span>
                    @endif

                    <svg
                        class="h-5 w-5 shrink-0 {{ request()->routeIs('buildings.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 21h18M5 21V5a2 2 0 012-2h6a2 2 0 012 2v16M15 21V9a2 2 0 012-2h2a2 2 0 012 2v12M9 7h2M9 11h2M9 15h2"
                        />
                    </svg>

                    <span
                        x-show="sidebarOpen"
                        x-cloak
                        class="whitespace-nowrap"
                    >
                        Buildings
                    </span>

                </a>


                {{-- Apartments --}}
                <a
                    href="{{ route('appartments.index') }}"
                    @class([
                        'group relative flex items-center gap-3 rounded-xl px-3 py-3 transition-all duration-200',
                        'bg-indigo-600 text-white font-semibold shadow-sm shadow-indigo-950/20'
                            => request()->routeIs('appartments.*'),
                        'text-slate-400 hover:bg-slate-800 hover:text-white'
                            => !request()->routeIs('appartments.*'),
                    ])
                    :class="sidebarOpen ? '' : 'justify-center'"
                    aria-current="{{ request()->routeIs('appartments.*') ? 'page' : 'false' }}"
                >

                    @if(request()->routeIs('appartments.*'))
                        <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-white"></span>
                    @endif

                    <svg
                        class="h-5 w-5 shrink-0 {{ request()->routeIs('appartments.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 21V5a2 2 0 012-2h12a2 2 0 012 2v16M4 21h16M8 7h2M14 7h2M8 11h2M14 11h2M8 15h2M14 15h2"
                        />
                    </svg>

                    <span
                        x-show="sidebarOpen"
                        x-cloak
                        class="whitespace-nowrap"
                    >
                        Apartments
                    </span>

                </a>


                {{-- Bookings --}}
                <a
                    href="{{ route('bookings.index') }}"
                    @class([
                        'group relative flex items-center gap-3 rounded-xl px-3 py-3 transition-all duration-200',
                        'bg-indigo-600 text-white font-semibold shadow-sm shadow-indigo-950/20'
                            => request()->routeIs('bookings.*'),
                        'text-slate-400 hover:bg-slate-800 hover:text-white'
                            => !request()->routeIs('bookings.*'),
                    ])
                    :class="sidebarOpen ? '' : 'justify-center'"
                    aria-current="{{ request()->routeIs('bookings.*') ? 'page' : 'false' }}"
                >

                    @if(request()->routeIs('bookings.*'))
                        <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-white"></span>
                    @endif

                    <svg
                        class="h-5 w-5 shrink-0 {{ request()->routeIs('bookings.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                        />
                    </svg>

                    <span
                        x-show="sidebarOpen"
                        x-cloak
                        class="whitespace-nowrap"
                    >
                        Bookings
                    </span>

                </a>


                {{-- Settings --}}
                <a
                    href="{{ route('settings') }}"
                    @class([
                        'group relative flex items-center gap-3 rounded-xl px-3 py-3 transition-all duration-200',
                        'bg-indigo-600 text-white font-semibold shadow-sm shadow-indigo-950/20'
                            => request()->routeIs('settings.*'),
                        'text-slate-400 hover:bg-slate-800 hover:text-white'
                            => !request()->routeIs('settings.*'),
                    ])
                    :class="sidebarOpen ? '' : 'justify-center'"
                    aria-current="{{ request()->routeIs('settings.*') ? 'page' : 'false' }}"
                >

                    @if(request()->routeIs('settings.*'))
                        <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-white"></span>
                    @endif

                    <svg
                        class="h-5 w-5 shrink-0 {{ request()->routeIs('settings.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10.325 4.317a1.724 1.724 0 013.35 0 1.724 1.724 0 002.573 1.066 1.724 1.724 0 012.366 2.366 1.724 1.724 0 001.066 2.573 1.724 1.724 0 010 3.35 1.724 1.724 0 00-1.066 2.573 1.724 1.724 0 01-2.366 2.366 1.724 1.724 0 00-2.573 1.066 1.724 1.724 0 01-3.35 0 1.724 1.724 0 00-2.573-1.066 1.724 1.724 0 01-2.366-2.366 1.724 1.724 0 001.066-2.573 1.724 1.724 0 010-3.35 1.724 1.724 0 001.066-2.573 1.724 1.724 0 012.366-2.366 1.724 1.724 0 002.573-1.066z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                    </svg>

                    <span
                        x-show="sidebarOpen"
                        x-cloak
                        class="whitespace-nowrap"
                    >
                        Settings
                    </span>

                </a>

            </nav>


            {{-- ========================================================
                SIDEBAR USER FOOTER
            ========================================================= --}}
            <div class="border-t border-slate-800 p-3">

                <div
                    class="flex items-center gap-3 rounded-xl p-2"
                    :class="sidebarOpen ? '' : 'justify-center'"
                >

                    {{-- Avatar --}}
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white"
                    >
                        {{ strtoupper(substr(auth()->user()->name ?? 'M', 0, 1)) }}
                    </div>

                    {{-- User Information --}}
                    <div
                        x-show="sidebarOpen"
                        x-cloak
                        class="min-w-0"
                    >
                        <p class="truncate text-sm font-semibold text-white">
                            {{ auth()->user()->name ?? 'Manager' }}
                        </p>

                        <p class="truncate text-xs text-slate-500">
                            Property Manager
                        </p>
                    </div>

                </div>

            </div>

        </aside>


        {{-- ============================================================
            MAIN AREA
        ============================================================= --}}
        <div
            class="min-h-screen transition-all duration-300"
            :class="sidebarOpen ? 'lg:pl-64' : 'lg:pl-20'"
        >

            {{-- ========================================================
                TOP NAVBAR
            ========================================================= --}}
            <header
                class="sticky top-0 z-30 h-16 border-b border-slate-200 bg-white/95 backdrop-blur"
            >

                <div class="flex h-full items-center justify-between px-4 sm:px-6 lg:px-8">

                    {{-- Left Side --}}
                    <div class="flex items-center gap-3">

                        {{-- Mobile Menu --}}
                        <button
                            type="button"
                            @click="mobileSidebarOpen = true"
                            class="rounded-xl p-2.5 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 lg:hidden"
                            aria-label="Open sidebar"
                        >
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                            </svg>
                        </button>


                        {{-- Desktop Sidebar Toggle --}}
                        <button
                            type="button"
                            @click="sidebarOpen = !sidebarOpen"
                            class="hidden rounded-xl p-2.5 text-slate-500 transition hover:bg-slate-100 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 lg:block"
                            aria-label="Toggle sidebar"
                        >
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                            </svg>
                        </button>


                        {{-- Page Title --}}
                        <div class="hidden sm:block">
                            <p class="text-xs font-medium uppercase tracking-wider text-slate-400">
                                Manager Portal
                            </p>

                            <h1 class="font-jakarta text-sm font-bold text-slate-900">
                                @yield('title', 'Dashboard')
                            </h1>
                        </div>

                    </div>


                    {{-- Right Side --}}
                    <div class="flex items-center gap-3">

                        {{-- Notifications --}}
                        <button
                            type="button"
                            class="relative rounded-xl p-2.5 text-slate-500 transition hover:bg-slate-100 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            aria-label="Notifications"
                        >
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                                />
                            </svg>

                            <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-indigo-600 ring-2 ring-white"></span>
                        </button>


                        {{-- User Profile --}}
                        <div class="hidden h-8 w-px bg-slate-200 sm:block"></div>

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-100 text-sm font-bold text-indigo-700"
                            >
                                {{ strtoupper(substr(auth()->user()->name ?? 'M', 0, 1)) }}
                            </div>

                            <div class="hidden md:block">
                                <p class="max-w-[160px] truncate text-sm font-semibold text-slate-800">
                                    {{ auth()->user()->name ?? 'Manager' }}
                                </p>

                                <p class="max-w-[160px] truncate text-xs text-slate-400">
                                    {{ auth()->user()->email ?? '' }}
                                </p>
                            </div>

                        </div>


                        {{-- Logout --}}
                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                            class="ml-1"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="rounded-xl p-2.5 text-slate-500 transition hover:bg-red-50 hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-red-500"
                                aria-label="Logout"
                                title="Logout"
                            >
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                    />
                                </svg>
                            </button>
                        </form>

                    </div>

                </div>

            </header>


            {{-- ========================================================
                MAIN WORKSPACE
                Child content is rendered through $slot
            ========================================================= --}}
            <main class="min-h-[calc(100vh-4rem)] bg-slate-50">

                {{ $slot }}

            </main>

        </div>

    </div>


    @stack('scripts')

</body>
</html>

