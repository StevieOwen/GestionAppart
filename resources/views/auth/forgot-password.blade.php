<x-authLayout>

    <!-- =========================================================
         MAIN CONTENT
    ========================================================== -->
    <main
        class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-24 sm:px-6"
    >

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
             PASSWORD RESET CARD
        ====================================================== -->
        <div class="relative w-full max-w-md">

            <div
                class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-900/5"
            >

                <!-- =================================================
                     CARD HEADER
                ================================================== -->
                <div
                    class="px-6 pb-6 pt-8 text-center sm:px-8 sm:pt-10"
                >

                    <!-- Lock / Reset Icon -->
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
                                d="M16 11V7a4 4 0 00-8 0v4M5 11h14a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M12 15v2"
                            />
                        </svg>
                    </div>


                    <h1
                        class="mt-6 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl"
                    >
                        Forgot Your Password?
                    </h1>


                    <p
                        class="mx-auto mt-3 max-w-sm text-sm leading-6 text-slate-500"
                    >
                        No worries. Enter the email address associated with
                        your StayHub account and we'll send you a secure link
                        to reset your password.
                    </p>

                </div>


                <!-- =================================================
                     FORM AREA
                ================================================== -->
                <div class="px-6 pb-8 sm:px-8">


                    <!-- =================================================
                         SUCCESS STATUS
                    ================================================== -->
                    @if (session('status'))

                        <div
                            class="mb-5 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-3 text-xs font-medium text-emerald-700"
                            role="alert"
                            aria-live="polite"
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
                                {{ session('status') }}
                            </span>

                        </div>

                    @endif


                    <!-- =================================================
                         PASSWORD RESET FORM
                    ================================================== -->
                    <form
                        method="POST"
                        action="{{ route('password.email') }}"
                    >
                        @csrf


                        <!-- Email -->
                        <div>

                            <label
                                for="email"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Email Address
                            </label>


                            <div class="relative">

                                <!-- Email Icon -->
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
                                    autofocus
                                    required
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


                            <!-- Validation Error -->
                            @error('email')
                                <p
                                    id="email-error"
                                    class="mt-1 text-xs text-rose-500"
                                >
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <!-- Submit -->
                        <button
                            type="submit"
                            class="mt-6 flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 active:scale-[0.99]"
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
                                    d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002-2z"
                                />
                            </svg>

                            Send Password Reset Link

                        </button>

                    </form>


                    <!-- =================================================
                         BACK TO LOGIN
                    ================================================== -->
                    <div class="mt-6 text-center">

                        <a
                            href="{{ route('login') }}"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 transition hover:text-indigo-700"
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
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"
                                />
                            </svg>

                            Back to Login

                        </a>

                    </div>

                </div>


                <!-- =================================================
                     HELP / SECURITY NOTE
                ================================================== -->
                <div
                    class="border-t border-slate-100 bg-slate-50/70 px-6 py-5 sm:px-8"
                >

                    <div class="flex items-start gap-3">

                        <div
                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white text-slate-400 shadow-sm ring-1 ring-slate-200"
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
                                    stroke-width="1.7"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2V9a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M8 7V5a4 4 0 018 0v2"
                                />
                            </svg>
                        </div>


                        <div>

                            <p class="text-sm font-semibold text-slate-700">
                                Your account is secure
                            </p>

                            <p class="mt-1 text-xs leading-5 text-slate-500">
                                For your security, the password reset link will
                                only be sent to the email address registered
                                with your StayHub account.
                            </p>

                        </div>

                    </div>

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


   

</div>

</x-authLayout>
