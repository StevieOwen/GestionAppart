
<x-authLayout>

    <!-- =========================================================
         MAIN LOGIN AREA
    ========================================================== -->
    <main class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-24 sm:px-6">

        <!-- Decorative background -->
        <div
            class="pointer-events-none absolute -left-32 top-20 h-72 w-72 rounded-full bg-indigo-100/70 blur-3xl"
            aria-hidden="true"
        ></div>

        <div
            class="pointer-events-none absolute -right-32 bottom-10 h-80 w-80 rounded-full bg-slate-200/80 blur-3xl"
            aria-hidden="true"
        ></div>


        <!-- =====================================================
             LOGIN CARD
        ====================================================== -->
        <div class="relative w-full max-w-md">

            <div
                class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-900/5"
            >

                <!-- Card Header -->
                <div class="px-6 pb-6 pt-8 text-center sm:px-8 sm:pt-10">

                    <!-- Login Icon -->
                    <div
                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600"
                    >
                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5m0 0l-5-5m5 5H3"
                            />
                        </svg>
                    </div>

                    <h1 class="mt-5 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                        Welcome Back
                    </h1>

                    <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-slate-500">
                        Log in to manage your properties or view your bookings.
                    </p>

                </div>


                <!-- =================================================
                     FORM
                ================================================== -->
                <form
                    method="POST"
                    action="{{ route('login') }}"
                    class="px-6 pb-8 sm:px-8"
                >
                    @csrf


                    <!-- =============================================
                         GLOBAL AUTHENTICATION / STATUS ALERT
                    ============================================== -->

                    @if(session('status'))
                        <div
                            class="mb-5 flex items-start gap-3 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700"
                            role="alert"
                        >
                            <svg
                                class="mt-0.5 h-5 w-5 shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"
                                />
                            </svg>

                            <div>
                                <p class="font-semibold">
                                    Authentication notice
                                </p>

                                <p class="mt-0.5">
                                    {{ session('status') }}
                                </p>
                            </div>
                        </div>
                    @endif


                    {{-- General authentication failure.
                         If your Laravel LoginRequest places credential
                         failures on the email field, this displays it
                         prominently above the fields. --}}
                    @if($errors->has('email') && old('email'))
                        <div
                            class="mb-5 flex items-start gap-3 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700"
                            role="alert"
                        >
                            <svg
                                class="mt-0.5 h-5 w-5 shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"
                                />
                            </svg>

                            <div>
                                <p class="font-semibold">
                                    Unable to sign in
                                </p>

                                <p class="mt-0.5">
                                    {{ $errors->first('email') }}
                                </p>
                            </div>
                        </div>
                    @endif


                    <!-- =============================================
                         EMAIL
                    ============================================== -->
                    <div>
                        <label
                            for="email"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Email Address
                        </label>

                        <div class="relative">

                            <!-- Icon -->
                            <div
                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400"
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
                                        stroke-width="1.7"
                                        d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                    />
                                </svg>
                            </div>

                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                autocomplete="email"
                                required
                                autofocus
                                placeholder="you@example.com"
                                aria-describedby="@error('email') email-error @enderror"
                                class="block w-full rounded-xl border bg-white py-3 pl-11 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10
                                @error('email')
                                    border-rose-400 focus:border-rose-500 focus:ring-rose-500/10
                                @else
                                    border-slate-300
                                @enderror"
                            >
                        </div>

                        @error('email')
                            <p
                                id="email-error"
                                class="mt-1 text-xs text-rose-500"
                            >
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    <!-- =============================================
                         PASSWORD
                    ============================================== -->
                    <div class="mt-5">

                        <div class="mb-2 flex items-center justify-between">

                            <label
                                for="password"
                                class="block text-sm font-semibold text-slate-700"
                            >
                                Password
                            </label>

                            @if(Route::has('password.request'))
                                <a
                                    href="{{ route('password.request') }}"
                                    class="text-xs font-semibold text-indigo-600 transition hover:text-indigo-700"
                                >
                                    Forgot Password?
                                </a>
                            @endif

                        </div>


                        <div class="relative">

                            <!-- Lock Icon -->
                            <div
                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400"
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
                                        stroke-width="1.7"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 11h14a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2z"
                                    />
                                </svg>
                            </div>


                            <!-- Password Input -->
                            <input
                                id="password"
                                name="password"
                                :type="showPassword ? 'text' : 'password'"
                                autocomplete="current-password"
                                required
                                placeholder="Enter your password"
                                aria-describedby="@error('password') password-error @enderror"
                                class="block w-full rounded-xl border bg-white py-3 pl-11 pr-12 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10
                                @error('password')
                                    border-rose-400 focus:border-rose-500 focus:ring-rose-500/10
                                @else
                                    border-slate-300
                                @enderror"
                            >


                            <!-- Show / Hide Password -->
                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 flex items-center px-3.5 text-slate-400 transition hover:text-slate-700"
                                :aria-label="showPassword ? 'Hide password' : 'Show password'"
                                :aria-pressed="showPassword"
                            >

                                <!-- Eye -->
                                <svg
                                    x-show="!showPassword"
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M12 15a3 3 0 100-6 3 3 0 000 6z"
                                    />
                                </svg>


                                <!-- Eye Slash -->
                                <svg
                                    x-show="showPassword"
                                    x-cloak
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M3 3l18 18"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M10.584 10.587a2 2 0 002.829 2.828"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M9.88 4.091A9.955 9.955 0 0112 4c4.477 0 8.268 2.943 9.542 7a9.967 9.967 0 01-1.563 2.868"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M6.228 6.228C4.565 7.38 3.364 9.044 2.458 12 3.732 16.057 7.523 19 12 19c1.444 0 2.803-.309 4.032-.865"
                                    />
                                </svg>

                            </button>

                        </div>

                        @error('password')
                            <p
                                id="password-error"
                                class="mt-1 text-xs text-rose-500"
                            >
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <!-- =============================================
                         REMEMBER ME
                    ============================================== -->
                    <div class="mt-5 flex items-center">

                        <label class="inline-flex cursor-pointer items-center gap-2.5">

                            <input
                                id="remember"
                                name="remember"
                                type="checkbox"
                                value="1"
                                {{ old('remember') ? 'checked' : '' }}
                                class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-2 focus:ring-indigo-500/20"
                            >

                            <span class="text-sm text-slate-600">
                                Remember me
                            </span>

                        </label>

                    </div>


                    <!-- =============================================
                         SUBMIT BUTTON
                    ============================================== -->
                    <button
                        type="submit"
                        class="mt-6 flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 active:scale-[0.99]"
                    >
                        Log In

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
                                d="M13 7l5 5m0 0l-5 5m5-5H6"
                            />
                        </svg>
                    </button>

                </form>


                <!-- =================================================
                     REGISTER LINK
                ================================================== -->
                <div class="border-t border-slate-100 bg-slate-50/70 px-6 py-5 text-center sm:px-8">

                    <p class="text-sm text-slate-500">
                        Don't have an account?

                        <a
                            href="{{ route('register') }}"
                            class="font-bold text-indigo-600 transition hover:text-indigo-700"
                        >
                            Sign up
                        </a>
                    </p>

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


</x-authLayout>
