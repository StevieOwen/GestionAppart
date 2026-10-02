
<x-authLayout>

    <!-- =========================================================
         MAIN AUTHENTICATION AREA
    ========================================================== -->
    <main class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-24 sm:px-6">

        <!-- Decorative background elements -->
        <div
            class="pointer-events-none absolute -left-32 top-20 h-72 w-72 rounded-full bg-indigo-100/70 blur-3xl"
            aria-hidden="true"
        ></div>

        <div
            class="pointer-events-none absolute -right-32 bottom-10 h-80 w-80 rounded-full bg-slate-200/80 blur-3xl"
            aria-hidden="true"
        ></div>


        <!-- =====================================================
             REGISTER CARD
        ====================================================== -->
        <div class="relative w-full max-w-md">

            <div
                class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-900/5"
            >

                <!-- Card Header -->
                <div class="px-6 pb-5 pt-8 text-center sm:px-8 sm:pt-10">

                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M18 9v6m3-3h-6M12 14a4 4 0 100-8 4 4 0 000 8zm-7 7a7 7 0 0114 0"
                            />
                        </svg>
                    </div>

                    <h1 class="mt-5 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                        Create Your Account
                    </h1>

                    <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-slate-500">
                        Join StayHub to discover apartments or manage properties
                        and bookings from one place.
                    </p>

                </div>


                <!-- =================================================
                     REGISTRATION FORM
                ================================================== -->
                <form
                    method="POST"
                    action="{{ route('register.store') }}"
                    class="space-y-5 px-6 pb-8 sm:px-8"
                >
                    @csrf


                    <!-- =============================================
                         ROLE SELECTION
                    ============================================== -->
                    <fieldset>
                        <legend class="mb-3 block text-sm font-semibold text-slate-800">
                            What are you looking to do?
                        </legend>

                        <div class="grid gap-3 sm:grid-cols-2">

                            <!-- Customer / Guest -->
                            <label
                                class="relative cursor-pointer"
                                @click="role = 'customer'"
                            >
                                <input
                                    type="radio"
                                    name="role"
                                    value="customer"
                                    x-model="role"
                                    class="peer sr-only"
                                    {{ old('role', 'customer') === 'customer' ? 'checked' : '' }}
                                >

                                <div
                                    class="h-full rounded-2xl border-2 border-slate-200 bg-white p-4 transition
                                           peer-checked:border-indigo-600
                                           peer-checked:bg-indigo-50/50
                                           hover:border-slate-300"
                                >

                                    <div class="flex items-start justify-between gap-3">

                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-600 peer-checked:bg-indigo-100 peer-checked:text-indigo-600">
                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.7"
                                                    d="M15 19a6 6 0 00-12 0m6-8a4 4 0 100-8 4 4 0 000 8zm6-5h6m-3-3v6"
                                                />
                                            </svg>
                                        </div>

                                        <!-- Selected indicator -->
                                        <span
                                            class="flex h-5 w-5 items-center justify-center rounded-full border border-slate-300 peer-checked:border-indigo-600 peer-checked:bg-indigo-600"
                                        >
                                            <svg
                                                class="h-3 w-3 text-white"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="3"
                                                    d="M5 12l4 4L19 6"
                                                />
                                            </svg>
                                        </span>

                                    </div>

                                    <div class="mt-3">
                                        <h3 class="text-sm font-bold text-slate-900">
                                            Customer / Guest
                                        </h3>

                                        <p class="mt-1 text-xs leading-5 text-slate-500">
                                            Looking to explore and book apartments.
                                        </p>
                                    </div>

                                </div>
                            </label>


                            <!-- Property Manager -->
                            <label
                                class="relative cursor-pointer"
                                @click="role = 'manager'"
                            >
                                <input
                                    type="radio"
                                    name="role"
                                    value="manager"
                                    x-model="role"
                                    class="peer sr-only"
                                    {{ old('role') === 'manager' ? 'checked' : '' }}
                                >

                                <div
                                    class="h-full rounded-2xl border-2 border-slate-200 bg-white p-4 transition
                                           peer-checked:border-indigo-600
                                           peer-checked:bg-indigo-50/50
                                           hover:border-slate-300"
                                >

                                    <div class="flex items-start justify-between gap-3">

                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-600">
                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.7"
                                                    d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-4h6v4M9 9h.01M12 9h.01M15 9h.01M9 13h.01M12 13h.01M15 13h.01"
                                                />
                                            </svg>
                                        </div>

                                        <span
                                            class="flex h-5 w-5 items-center justify-center rounded-full border border-slate-300"
                                        >
                                            <svg
                                                class="h-3 w-3 text-white"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="3"
                                                    d="M5 12l4 4L19 6"
                                                />
                                            </svg>
                                        </span>

                                    </div>

                                    <div class="mt-3">
                                        <h3 class="text-sm font-bold text-slate-900">
                                            Property Manager
                                        </h3>

                                        <p class="mt-1 text-xs leading-5 text-slate-500">
                                            Looking to list buildings and manage bookings.
                                        </p>
                                    </div>

                                </div>
                            </label>

                        </div>

                        @error('role')
                            <p class="mt-1 text-xs text-rose-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </fieldset>


                    <!-- =============================================
                         FULL NAME
                    ============================================== -->
                    <div>
                        <label
                            for="name"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Full Name
                        </label>

                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M15 19a6 6 0 00-12 0m6-8a4 4 0 100-8 4 4 0 000 8z"
                                    />
                                </svg>
                            </div>

                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                autocomplete="name"
                                required
                                autofocus
                                placeholder="John Doe"
                                class="block w-full rounded-xl border border-slate-300 bg-white py-3 pl-11 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 @error('name') border-rose-400 focus:border-rose-500 focus:ring-rose-500/10 @enderror"
                            >
                        </div>

                        @error('name')
                            <p class="mt-1 text-xs text-rose-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


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
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
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
                                placeholder="you@example.com"
                                class="block w-full rounded-xl border border-slate-300 bg-white py-3 pl-11 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 @error('email') border-rose-400 focus:border-rose-500 focus:ring-rose-500/10 @enderror"
                            >
                        </div>

                        @error('email')
                            <p class="mt-1 text-xs text-rose-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    <!-- =============================================
                         PHONE
                    ============================================== -->
                    <div>
                        <label
                            for="phone"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Mobile Phone Number
                        </label>

                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 011.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.04 11.04 0 005.502 5.502l1.13-2.257a1 1 0 011.21-.502l4.493 1.498A1 1 0 0121 15.72V19a2 2 0 01-2 2h-1C9.611 21 3 14.389 3 6V5z"
                                    />
                                </svg>
                            </div>

                            <input
                                id="phone"
                                name="phone"
                                type="tel"
                                value="{{ old('phone') }}"
                                autocomplete="tel"
                                required
                                placeholder="+250 7XX XXX XXX"
                                class="block w-full rounded-xl border border-slate-300 bg-white py-3 pl-11 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 @error('phone') border-rose-400 focus:border-rose-500 focus:ring-rose-500/10 @enderror"
                            >
                        </div>

                        @error('phone')
                            <p class="mt-1 text-xs text-rose-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    <!-- =============================================
                         PASSWORD
                    ============================================== -->
                    <div>
                        <div class="mb-2 flex items-center justify-between">
                            <label
                                for="password"
                                class="block text-sm font-semibold text-slate-700"
                            >
                                Password
                            </label>

                            <span class="text-xs text-slate-400">
                                Minimum 8 characters
                            </span>
                        </div>

                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 11h14a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2z"
                                    />
                                </svg>
                            </div>

                            <input
                                id="password"
                                name="password"
                                :type="showPassword ? 'text' : 'password'"
                                autocomplete="new-password"
                                required
                                placeholder="Create a secure password"
                                class="block w-full rounded-xl border border-slate-300 bg-white py-3 pl-11 pr-12 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 @error('password') border-rose-400 focus:border-rose-500 focus:ring-rose-500/10 @enderror"
                            >

                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 flex items-center px-3.5 text-slate-400 transition hover:text-slate-700"
                                :aria-label="showPassword ? 'Hide password' : 'Show password'"
                            >
                                <!-- Eye -->
                                <svg
                                    x-show="!showPassword"
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
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

                                <!-- Eye slash -->
                                <svg
                                    x-show="showPassword"
                                    x-cloak
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M3 3l18 18M10.584 10.587a2 2 0 002.829 2.828M9.88 4.091A9.955 9.955 0 0112 4c4.477 0 8.268 2.943 9.542 7a9.967 9.967 0 01-1.563 2.868M6.228 6.228C4.565 7.38 3.364 9.044 2.458 12 3.732 16.057 7.523 19 12 19c1.444 0 2.803-.309 4.032-.865"
                                    />
                                </svg>
                            </button>
                        </div>

                        @error('password')
                            <p class="mt-1 text-xs text-rose-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    <!-- =============================================
                         PASSWORD CONFIRMATION
                    ============================================== -->
                    <div>
                        <label
                            for="password_confirmation"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Confirm Password
                        </label>

                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 11h14a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2z"
                                    />
                                </svg>
                            </div>

                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                :type="showPasswordConfirmation ? 'text' : 'password'"
                                autocomplete="new-password"
                                required
                                placeholder="Repeat your password"
                                class="block w-full rounded-xl border border-slate-300 bg-white py-3 pl-11 pr-12 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10"
                            >

                            <button
                                type="button"
                                @click="showPasswordConfirmation = !showPasswordConfirmation"
                                class="absolute inset-y-0 right-0 flex items-center px-3.5 text-slate-400 transition hover:text-slate-700"
                                :aria-label="showPasswordConfirmation ? 'Hide password' : 'Show password'"
                            >
                                <svg
                                    x-show="!showPasswordConfirmation"
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
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

                                <svg
                                    x-show="showPasswordConfirmation"
                                    x-cloak
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M3 3l18 18M10.584 10.587a2 2 0 002.829 2.828M9.88 4.091A9.955 9.955 0 0112 4c4.477 0 8.268 2.943 9.542 7a9.967 9.967 0 01-1.563 2.868M6.228 6.228C4.565 7.38 3.364 9.044 2.458 12 3.732 16.057 7.523 19 12 19c1.444 0 2.803-.309 4.032-.865"
                                    />
                                </svg>
                            </button>
                        </div>

                        @error('password_confirmation')
                            <p class="mt-1 text-xs text-rose-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    <!-- =============================================
                         TERMS
                    ============================================== -->
                    <div class="rounded-xl bg-slate-50 p-3.5">
                        <p class="text-xs leading-5 text-slate-500">
                            By creating an account, you agree to our
                            <a
                                href="{{ url('/terms') }}"
                                class="font-semibold text-indigo-600 hover:text-indigo-700"
                            >
                                Terms of Service
                            </a>
                            and
                            <a
                                href="{{ url('/privacy') }}"
                                class="font-semibold text-indigo-600 hover:text-indigo-700"
                            >
                                Privacy Policy
                            </a>.
                        </p>
                    </div>


                    <!-- =============================================
                         SUBMIT
                    ============================================== -->
                    <button
                        type="submit"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 active:scale-[0.99]"
                    >
                        Create Account

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
                                d="M13 7l5 5m0 0l-5 5m5-5H6"
                            />
                        </svg>
                    </button>

                </form>


                <!-- =================================================
                     LOGIN LINK
                ================================================== -->
                <div class="border-t border-slate-100 bg-slate-50/70 px-6 py-5 text-center sm:px-8">

                    <p class="text-sm text-slate-500">
                        Already have an account?

                        <a
                            href="{{ route('login') }}"
                            class="font-bold text-indigo-600 transition hover:text-indigo-700"
                        >
                            Log in
                        </a>
                    </p>

                </div>

            </div>


            <!-- Mobile Home Link -->
            <div class="mt-5 text-center sm:hidden">
                <a
                    href="{{ url('/') }}"
                    class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-500 hover:text-indigo-600"
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

        </div>
    </main>


</div>

</x-authLayout>

