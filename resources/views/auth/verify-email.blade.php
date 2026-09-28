
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verify Email | StayHub</title>

    <meta
        name="description"
        content="Verify your email address to activate your StayHub account."
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

<div class="min-h-screen">

    <!-- =========================================================
         HEADER / BRAND
    ========================================================== -->
    <header class="absolute left-0 right-0 top-0 z-20">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-6 sm:px-6 lg:px-8">

            <!-- StayHub Logo -->
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
                        aria-hidden="true"
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

            <!-- Home Link -->
            <a
                href="{{ url('/') }}"
                class="hidden items-center gap-2 text-sm font-semibold text-slate-600 transition hover:text-indigo-600 sm:inline-flex"
            >
                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    aria-hidden="true"
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


    <!-- =========================================================
         MAIN CONTENT
    ========================================================== -->
    <main class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-24 sm:px-6">

        <!-- Decorative Background -->
        <div
            class="pointer-events-none absolute -left-32 top-20 h-72 w-72 rounded-full bg-indigo-100/70 blur-3xl"
            aria-hidden="true"
        ></div>

        <div
            class="pointer-events-none absolute -right-32 bottom-10 h-80 w-80 rounded-full bg-slate-200/80 blur-3xl"
            aria-hidden="true"
        ></div>


        <!-- =====================================================
             VERIFICATION CARD
        ====================================================== -->
        <div class="relative w-full max-w-md">

            <div
                class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-900/5"
            >

                <!-- Card Header -->
                <div class="px-6 pb-6 pt-8 text-center sm:px-8 sm:pt-10">

                    <!-- Envelope Icon -->
                    <div
                        class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-indigo-100 text-indigo-600 ring-8 ring-indigo-50"
                    >
                        <svg
                            class="h-7 w-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                            />
                        </svg>
                    </div>

                    <h1 class="mt-6 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                        Verify Your Email Address
                    </h1>

                    <p class="mx-auto mt-3 max-w-sm text-sm leading-6 text-slate-500">
                        We've sent a verification link to your email address.
                        Please click the link in that email to activate your account.
                    </p>

                </div>


                <!-- =================================================
                     EMAIL CALLOUT
                ================================================== -->
                <div class="px-6 sm:px-8">

                    <div class="rounded-xl border border-indigo-100 bg-indigo-50 p-4">

                        <p class="text-xs font-medium uppercase tracking-wide text-indigo-600">
                            Verification email sent to
                        </p>

                        <div class="mt-2 break-all rounded-lg border border-indigo-100 bg-white px-3 py-2 text-sm font-semibold text-indigo-900">
                            {{ auth()->user()->email }}
                        </div>

                    </div>

                </div>


                <!-- =================================================
                     SUCCESS STATUS
                ================================================== -->
                <div class="px-6 pt-4 sm:px-8">

                    @if (session('status') == 'verification-link-sent')

                        <div
                            class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-3 text-xs font-medium text-emerald-700"
                            role="alert"
                        >
                            <svg
                                class="mt-0.5 h-4 w-4 shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                            <span>
                                A new verification link has been sent to the email address you provided.
                            </span>
                        </div>

                    @endif

                </div>


                <!-- =================================================
                     ACTIONS
                ================================================== -->
                <div class="px-6 py-7 sm:px-8">

                    <!-- Resend Verification Email -->
                    <form
                        method="POST"
                        action="{{ route('verification.send') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 active:scale-[0.99]"
                        >
                            <svg
                                class="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                />
                            </svg>

                            Resend Verification Email
                        </button>
                    </form>


                    <!-- Help Text -->
                    <div class="mt-5 rounded-xl bg-slate-50 p-4">

                        <div class="flex items-start gap-3">

                            <svg
                                class="mt-0.5 h-5 w-5 shrink-0 text-slate-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M8.228 9c.549-1.165 1.9-2 3.772-2 2.21 0 4 1.343 4 3 0 1.5-1.5 2.5-3 3-1.5.5-3 1.5-3 3m0 4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"
                                />
                            </svg>

                            <div>
                                <p class="text-sm font-semibold text-slate-700">
                                    Didn't receive the email?
                                </p>

                                <p class="mt-1 text-xs leading-5 text-slate-500">
                                    Check your spam or junk folder. If you still
                                    can't find it, use the button above to send
                                    another verification link.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     LOGOUT
                ================================================== -->
                <div class="border-t border-slate-100 bg-slate-50/70 px-6 py-5 text-center sm:px-8">

                    <p class="text-sm text-slate-500">
                        Signed in as

                        <span class="font-semibold text-slate-700">
                            {{ auth()->user()->email }}
                        </span>
                    </p>

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                        class="mt-3"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="text-sm font-semibold text-indigo-600 transition hover:text-indigo-700"
                        >
                            Log out
                        </button>
                    </form>

                </div>

            </div>


            <!-- Mobile Home Link -->
            <div class="mt-5 text-center sm:hidden">

                <a
                    href="{{ url('/') }}"
                    class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-500 transition hover:text-indigo-600"
                >
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
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

        </div>
    </main>


    <!-- =========================================================
         FOOTER
    ========================================================== -->
    <footer class="border-t border-slate-200 bg-white">

        <div class="mx-auto max-w-7xl px-4 py-5 text-center sm:px-6 lg:px-8">

            <p class="text-xs text-slate-400">
                © {{ date('Y') }} StayHub. All rights reserved.
            </p>

        </div>

    </footer>

</div>

</body>
</html>

