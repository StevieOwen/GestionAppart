<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account | StayHub</title>

    <meta
        name="description"
        content="Create your StayHub account to discover apartments or manage your properties."
    >

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js">
    </script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: [
                            'Inter',
                            'Plus Jakarta Sans',
                            'ui-sans-serif',
                            'system-ui',
                            'sans-serif'
                        ],
                    },
                },
            },
        };
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50 font-sans text-slate-900 antialiased">

<div
    x-data="{
        role: '{{ old('role', 'customer') }}',
        showPassword: false,
        showPasswordConfirmation: false
    }"
    class="min-h-screen"
>

    <!-- =========================================================
         PAGE HEADER / BRAND
    ========================================================== -->
    <header class="absolute left-0 right-0 top-0 z-20">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-6 sm:px-6 lg:px-8">

            <!-- Logo -->
            <a
                href="{{ url('/') }}"
                class="group inline-flex items-center gap-2"
                aria-label="StayHub home"
            >
                <span
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-lg shadow-indigo-600/20 transition group-hover:bg-indigo-700"
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
                            d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4m4 0h4a1 1 0 001-1V10M9 21v-6a3 3 0 016 0v6"
                        />
                    </svg>
                </span>

                <span class="text-xl font-extrabold tracking-tight text-slate-900">
                    Stay<span class="text-indigo-600">Hub</span>
                </span>
            </a>

            <!-- Back to Home -->
            <a
                href="{{ url('/') }}"
                class="hidden items-center gap-2 text-sm font-semibold text-slate-600 transition hover:text-indigo-600 sm:inline-flex"
            >
                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                Back to home
            </a>

        </div>
    </header>

    {{$slot}}

</body>
</html>