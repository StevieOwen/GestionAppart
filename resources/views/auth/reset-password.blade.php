
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
             RESET PASSWORD CARD
        ====================================================== -->
        <div
            class="relative w-full max-w-md"
            x-data="{
                showPass: false,
                showConfirm: false
            }"
        >

            <div
                class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-900/5"
            >

                <!-- =================================================
                     CARD HEADER
                ================================================== -->
                <div class="px-6 pb-6 pt-8 text-center sm:px-8 sm:pt-10">

                    <!-- Shield / Lock Icon -->
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
                                d="M12 3l8 4v5c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V7l8-4z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M9.5 12l1.7 1.7 3.5-3.5"
                            />
                        </svg>
                    </div>


                    <h1
                        class="mt-6 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl"
                    >
                        Reset Your Password
                    </h1>


                    <p
                        class="mx-auto mt-3 max-w-sm text-sm leading-6 text-slate-500"
                    >
                        Please enter your account email and choose a strong
                        new password.
                    </p>

                </div>


                <!-- =================================================
                     FORM
                ================================================== -->
                <form
                    method="POST"
                    action="{{ route('password.update') }}"
                    class="px-6 pb-8 sm:px-8"
                >
                    @csrf


                    <!-- RESET TOKEN -->
                    <input
                        type="hidden"
                        name="token"
                        value="{{ $request->route('token') }}"
                    >


                    <!-- =================================================
                         GLOBAL TOKEN / RESET ERROR
                    ================================================== -->
                    @if($errors->any() && !$errors->has('email') && !$errors->has('password'))

                        <div
                            class="mb-5 flex items-start gap-3 rounded-xl border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700"
                            role="alert"
                            aria-live="assertive"
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
                                    Password reset failed
                                </p>

                                <p class="mt-0.5">
                                    {{ $errors->first() }}
                                </p>
                            </div>

                        </div>

                    @endif


                    <!-- =================================================
                         EMAIL
                    ================================================== -->
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
                                value="{{ old('email', $request->email) }}"
                                autocomplete="email"
                                required
                                readonly
                                aria-describedby="@error('email') email-error @enderror"
                                class="block w-full cursor-not-allowed rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm text-slate-600 outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10"
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


                    <!-- =================================================
                         NEW PASSWORD
                    ================================================== -->
                    <div class="mt-5">

                        <label
                            for="password"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            New Password
                        </label>

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
                                :type="showPass ? 'text' : 'password'"
                                autocomplete="new-password"
                                required
                                placeholder="Create a new password"
                                aria-describedby="password-hint @error('password') password-error @enderror"
                                class="block w-full rounded-xl border border-slate-300 bg-white py-3 pl-11 pr-12 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 @error('password') border-rose-400 focus:border-rose-500 focus:ring-rose-500/10 @enderror"
                            >


                            <!-- =================================================
                                 SHOW / HIDE PASSWORD BUTTON
                            ================================================== -->
                            <button
                                type="button"
                                @click="showPass = !showPass"
                                class="absolute inset-y-0 right-0 flex items-center px-3.5 text-slate-400 transition hover:text-slate-700 focus:outline-none focus:text-indigo-600"
                                :aria-label="showPass ? 'Hide password' : 'Show password'"
                                :aria-pressed="showPass"
                            >

                                <!-- Show Password / Eye -->
                                <svg
                                    x-show="!showPass"
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


                                <!-- Hide Password / Eye Slash -->
                                <svg
                                    x-show="showPass"
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


                        <!-- Password Requirements -->
                        <div
                            id="password-hint"
                            class="mt-2 flex flex-wrap gap-x-4 gap-y-1 text-xs text-slate-400"
                        >
                            <span class="inline-flex items-center gap-1">
                                <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                                Minimum 8 characters
                            </span>

                            <span class="inline-flex items-center gap-1">
                                <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                                Letters & numbers
                            </span>
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


                    <!-- =================================================
                         CONFIRM PASSWORD
                    ================================================== -->
                    <div class="mt-5">

                        <label
                            for="password_confirmation"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Confirm New Password
                        </label>

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


                            <!-- Confirmation Input -->
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                :type="showConfirm ? 'text' : 'password'"
                                autocomplete="new-password"
                                required
                                placeholder="Confirm your new password"
                                aria-describedby="@error('password_confirmation') password-confirmation-error @enderror"
                                class="block w-full rounded-xl border border-slate-300 bg-white py-3 pl-11 pr-12 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 @error('password_confirmation') border-rose-400 focus:border-rose-500 focus:ring-rose-500/10 @enderror"
                            >


                            <!-- =================================================
                                 SHOW / HIDE CONFIRMATION BUTTON
                            ================================================== -->
                            <button
                                type="button"
                                @click="showConfirm = !showConfirm"
                                class="absolute inset-y-0 right-0 flex items-center px-3.5 text-slate-400 transition hover:text-slate-700 focus:outline-none focus:text-indigo-600"
                                :aria-label="showConfirm ? 'Hide password confirmation' : 'Show password confirmation'"
                                :aria-pressed="showConfirm"
                            >

                                <!-- Show Confirmation / Eye -->
                                <svg
                                    x-show="!showConfirm"
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


                                <!-- Hide Confirmation / Eye Slash -->
                                <svg
                                    x-show="showConfirm"
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


                        @error('password_confirmation')
                            <p
                                id="password-confirmation-error"
                                class="mt-1 text-xs text-rose-500"
                            >
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <!-- =================================================
                         SUBMIT BUTTON
                    ================================================== -->
                    <button
                        type="submit"
                        class="mt-7 flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 active:scale-[0.99]"
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
                                d="M12 15v2m-6 4h12a2 2 0 002-2V9a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M8 7V5a4 4 0 018 0v2"
                            />
                        </svg>

                        Reset Password

                    </button>

                </form>


                <!-- =================================================
                     SECURITY NOTE
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
                                Keep your account secure
                            </p>

                            <p class="mt-1 text-xs leading-5 text-slate-500">
                                Choose a unique password that you don't use
                                for other accounts.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     BACK TO LOGIN
                ================================================== -->
                <div
                    class="border-t border-slate-100 px-6 py-5 text-center sm:px-8"
                >

                    <p class="text-sm text-slate-500">

                        Remembered your password?

                        <a
                            href="{{ route('login') }}"
                            class="font-bold text-indigo-600 transition hover:text-indigo-700"
                        >
                            Back to Login
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

</x-authLayout>
