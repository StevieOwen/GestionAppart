<x-mdLayout>


<div
    x-data="{ activeTab: 'profile' }"
    class="min-h-screen bg-slate-50"
>


<div class="mx-auto max-w-[1400px] px-4 py-6 sm:px-6 lg:px-8">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="mb-8">

        <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
            Account & Portal Settings
        </h1>

        <p class="mt-1 max-w-3xl text-sm text-slate-500 sm:text-base">
            Manage your personal profile, global currency preferences, security credentials, and notifications.
        </p>

    </div>


    {{-- =========================================================
        SUCCESS ALERT
    ========================================================== --}}
    @if(session('success'))

        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition
            role="alert"
            class="mb-6 flex items-start justify-between gap-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800"
        >

            <div class="flex items-start gap-3">

                <div class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-emerald-100">
                    <svg
                        class="h-4 w-4 text-emerald-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>
                </div>

                <p class="pt-0.5 text-sm font-medium">
                    {{ session('success') }}
                </p>

            </div>

            <button
                type="button"
                @click="show = false"
                class="rounded-lg p-1 text-emerald-600 transition hover:bg-emerald-100"
                aria-label="Dismiss notification"
            >
                <svg
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>

        </div>

    @endif


    {{-- =========================================================
        ERROR ALERT
    ========================================================== --}}
    @if($errors->any() || session('error'))

        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition
            role="alert"
            class="mb-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-rose-800"
        >

            <div class="flex items-start justify-between gap-4">

                <div class="flex items-start gap-3">

                    <div class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-rose-100">
                        <svg
                            class="h-4 w-4 text-rose-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-width="2"
                                d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 2.98h15.58a2 2 0 001.74-2.98l-7.82-14a2 2 0 00-3.42 0z"
                            />
                        </svg>
                    </div>

                    <div class="text-sm">

                        @if(session('error'))
                            <p class="font-medium">
                                {{ session('error') }}
                            </p>
                        @endif

                        @if($errors->any())
                            <ul class="mt-1 list-disc space-y-1 pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                    </div>

                </div>

                <button
                    type="button"
                    @click="show = false"
                    class="rounded-lg p-1 text-rose-600 transition hover:bg-rose-100"
                    aria-label="Dismiss error notification"
                >
                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>

            </div>

        </div>

    @endif


    {{-- =========================================================
        SETTINGS LAYOUT
    ========================================================== --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[250px_minmax(0,1fr)]">


        {{-- =====================================================
            NAVIGATION
        ====================================================== --}}
        <aside class="lg:sticky lg:top-6 lg:self-start">

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- Mobile Navigation --}}
                <div class="border-b border-slate-200 p-3 lg:hidden">

                    <div class="mb-2 px-2 text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Settings
                    </div>

                    <div class="flex gap-2 overflow-x-auto pb-1">

                        <button
                            type="button"
                            @click="activeTab = 'profile'"
                            :class="activeTab === 'profile'
                                ? 'bg-indigo-600 text-white'
                                : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                            class="flex shrink-0 items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold transition"
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
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                />
                            </svg>

                            Profile
                        </button>


                        <button
                            type="button"
                            @click="activeTab = 'security'"
                            :class="activeTab === 'security'
                                ? 'bg-indigo-600 text-white'
                                : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                            class="flex shrink-0 items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold transition"
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
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-5a2 2 0 00-2-2H6a2 2 0 00-2 2v5a2 2 0 002 2zm10-9V7a4 4 0 00-8 0v3h8z"
                                />
                            </svg>

                            Security
                        </button>


                        <button
                            type="button"
                            @click="activeTab = 'notifications'"
                            :class="activeTab === 'notifications'
                                ? 'bg-indigo-600 text-white'
                                : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                            class="flex shrink-0 items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold transition"
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
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                                />
                            </svg>

                            Notifications
                        </button>

                    </div>

                </div>


                {{-- Desktop Navigation --}}
                <nav class="hidden p-3 lg:block">

                    <div class="mb-3 px-3 pt-2 text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Account Settings
                    </div>


                    {{-- Profile --}}
                    <button
                        type="button"
                        @click="activeTab = 'profile'"
                        :class="activeTab === 'profile'
                            ? 'bg-indigo-50 text-indigo-700'
                            : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                        class="flex w-full items-start gap-3 rounded-xl px-3 py-3 text-left transition"
                    >

                        <div
                            :class="activeTab === 'profile'
                                ? 'bg-indigo-100 text-indigo-600'
                                : 'bg-slate-100 text-slate-500'"
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg"
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
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-semibold">
                                Profile & Preferences
                            </p>

                            <p class="mt-0.5 text-xs text-slate-400">
                                Personal information
                            </p>
                        </div>

                    </button>


                    {{-- Security --}}
                    <button
                        type="button"
                        @click="activeTab = 'security'"
                        :class="activeTab === 'security'
                            ? 'bg-indigo-50 text-indigo-700'
                            : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                        class="mt-1 flex w-full items-start gap-3 rounded-xl px-3 py-3 text-left transition"
                    >

                        <div
                            :class="activeTab === 'security'
                                ? 'bg-indigo-100 text-indigo-600'
                                : 'bg-slate-100 text-slate-500'"
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg"
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
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-5a2 2 0 00-2-2H6a2 2 0 00-2 2v5a2 2 0 002 2zm10-9V7a4 4 0 00-8 0v3h8z"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-semibold">
                                Security
                            </p>

                            <p class="mt-0.5 text-xs text-slate-400">
                                Password & 2FA
                            </p>
                        </div>

                    </button>


                    {{-- Notifications --}}
                    <button
                        type="button"
                        @click="activeTab = 'notifications'"
                        :class="activeTab === 'notifications'
                            ? 'bg-indigo-50 text-indigo-700'
                            : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                        class="mt-1 flex w-full items-start gap-3 rounded-xl px-3 py-3 text-left transition"
                    >

                        <div
                            :class="activeTab === 'notifications'
                                ? 'bg-indigo-100 text-indigo-600'
                                : 'bg-slate-100 text-slate-500'"
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg"
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
                        </div>

                        <div>
                            <p class="text-sm font-semibold">
                                Notifications
                            </p>

                            <p class="mt-0.5 text-xs text-slate-400">
                                Alerts & preferences
                            </p>
                        </div>

                    </button>

                </nav>

            </div>

        </aside>


        {{-- =====================================================
            TAB CONTENT
        ====================================================== --}}
        <main class="min-w-0">


            {{-- =================================================
                TAB 1: PROFILE
            ================================================== --}}
            <section
                x-show="activeTab === 'profile'"
                x-transition.opacity
                x-cloak
            >

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    {{-- Header --}}
                    <div class="border-b border-slate-200 px-5 py-5 sm:px-6">

                        <div class="flex items-start gap-4">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
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
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h2 class="text-lg font-bold text-slate-900">
                                    Profile & Regional Preferences
                                </h2>

                                <p class="mt-1 text-sm text-slate-500">
                                    Update your personal details and property portal preferences.
                                </p>
                            </div>

                        </div>

                    </div>


                    {{-- Profile Form --}}
                    <form
                        action="{{ route('manager.settings.profile.update') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf
                        @method('PUT')

                        <div class="space-y-8 p-5 sm:p-6">


                            {{-- Personal Information --}}
                            <div>

                                <h3 class="text-sm font-bold text-slate-900">
                                    Personal Information
                                </h3>

                                <p class="mt-1 text-xs text-slate-500">
                                    Keep your contact information up to date.
                                </p>


                                <div class="mt-5 grid grid-cols-1 gap-5 md:grid-cols-2">

                                    {{-- Name --}}
                                    <div>

                                        <label
                                            for="name"
                                            class="mb-2 block text-sm font-semibold text-slate-700"
                                        >
                                            Full Name
                                            <span class="text-rose-500">*</span>
                                        </label>

                                        <input
                                            id="name"
                                            type="text"
                                            name="name"
                                            value="{{ old('name', $user->name) }}"
                                            required
                                            autocomplete="name"
                                            class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                            placeholder="Enter your full name"
                                        >

                                        @error('name')
                                            <p class="mt-1.5 text-xs text-rose-600">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>


                                    {{-- Email --}}
                                    <div>

                                        <label
                                            for="email"
                                            class="mb-2 block text-sm font-semibold text-slate-700"
                                        >
                                            Email Address
                                            <span class="text-rose-500">*</span>
                                        </label>

                                        <input
                                            id="email"
                                            type="email"
                                            name="email"
                                            value="{{ old('email', $user->email) }}"
                                            required
                                            autocomplete="email"
                                            class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                            placeholder="you@example.com"
                                        >

                                        @error('email')
                                            <p class="mt-1.5 text-xs text-rose-600">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>


                                    {{-- Phone --}}
                                    <div>

                                        <label
                                            for="phone"
                                            class="mb-2 block text-sm font-semibold text-slate-700"
                                        >
                                            Phone Number
                                        </label>

                                        <input
                                            id="phone"
                                            type="tel"
                                            name="phone"
                                            value="{{ old('phone', $user->phone) }}"
                                            autocomplete="tel"
                                            class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                            placeholder="+250 7XX XXX XXX"
                                        >

                                        @error('phone')
                                            <p class="mt-1.5 text-xs text-rose-600">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>


                                    {{-- Currency --}}
                                    <div>

                                        <label
                                            for="currency"
                                            class="mb-2 block text-sm font-semibold text-slate-700"
                                        >
                                            Preferred Currency
                                        </label>

                                        <select
                                            id="currency"
                                            name="currency"
                                            class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                        >

                                            <option
                                                value="USD"
                                                @selected(old('currency', $user->currency ?? 'USD') === 'USD')
                                            >
                                                USD ($)
                                            </option>

                                            <option
                                                value="EUR"
                                                @selected(old('currency', $user->currency ?? '') === 'EUR')
                                            >
                                                EUR (€)
                                            </option>

                                            <option
                                                value="GBP"
                                                @selected(old('currency', $user->currency ?? '') === 'GBP')
                                            >
                                                GBP (£)
                                            </option>

                                            <option
                                                value="RWF"
                                                @selected(old('currency', $user->currency ?? '') === 'RWF')
                                            >
                                                RWF (FRw)
                                            </option>

                                        </select>

                                        <p class="mt-2 text-xs leading-5 text-slate-500">
                                            This currency symbol will be applied across all your property pricing and booking reports.
                                        </p>

                                        @error('currency')
                                            <p class="mt-1.5 text-xs text-rose-600">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>

                                </div>

                            </div>


                            {{-- Identity Document --}}
                            <div class="border-t border-slate-200 pt-8">

                                <h3 class="text-sm font-bold text-slate-900">
                                    Identity Document
                                </h3>

                                <p class="mt-1 text-xs text-slate-500">
                                    Update your national ID or passport document when necessary.
                                </p>


                                <div class="mt-5">

                                    <label
                                        for="id_document"
                                        class="mb-2 block text-sm font-semibold text-slate-700"
                                    >
                                        National ID / Passport
                                    </label>

                                    <input
                                        id="id_document"
                                        type="file"
                                        name="id_document"
                                        accept=".pdf,.jpg,.jpeg,.png"
                                        class="block w-full cursor-pointer rounded-xl border border-slate-300 bg-white text-sm text-slate-600 file:mr-4 file:border-0 file:border-r file:border-slate-200 file:bg-slate-50 file:px-4 file:py-3 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-100"
                                    >

                                    <p class="mt-2 text-xs text-slate-400">
                                        Accepted formats: PDF, JPG, JPEG, PNG.
                                    </p>


                                    @if(!empty($user->id_document))

                                        <div class="mt-4 flex flex-col gap-3 rounded-xl border border-indigo-100 bg-indigo-50 p-4 sm:flex-row sm:items-center sm:justify-between">

                                            <div class="flex items-center gap-3">

                                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-white text-indigo-600 shadow-sm">
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
                                                            d="M7 21h10a2 2 0 002-2V9l-6-6H7a2 2 0 00-2 2v14a2 2 0 002 2z"
                                                        />
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M13 3v6h6"
                                                        />
                                                    </svg>
                                                </div>

                                                <div>
                                                    <p class="text-sm font-semibold text-slate-800">
                                                        Existing identity document
                                                    </p>

                                                    <p class="text-xs text-slate-500">
                                                        Your current uploaded document
                                                    </p>
                                                </div>

                                            </div>


                                            <a
                                                href="{{ asset('storage/' . $user->id_document) }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-white px-4 py-2 text-sm font-semibold text-indigo-700 shadow-sm ring-1 ring-indigo-100 transition hover:bg-indigo-50"
                                            >
                                                View Document

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
                                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4m-5-5l5-5m0 0v4m0-4h-4"
                                                    />
                                                </svg>

                                            </a>

                                        </div>

                                    @endif


                                    @error('id_document')
                                        <p class="mt-1.5 text-xs text-rose-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>

                            </div>

                        </div>


                        {{-- Form Footer --}}
                        <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-5 py-4 sm:flex-row sm:justify-end sm:px-6">

                            <button
                                type="reset"
                                class="rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                            >
                                Reset
                            </button>

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
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
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>

                                Save Profile Changes

                            </button>

                        </div>

                    </form>

                </div>

            </section>


            {{-- =================================================
                TAB 2: SECURITY
            ================================================== --}}
            <section
                x-show="activeTab === 'security'"
                x-transition.opacity
                x-cloak
            >

                <div class="space-y-6">


                    {{-- Password Card --}}
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                        <div class="border-b border-slate-200 px-5 py-5 sm:px-6">

                            <div class="flex items-start gap-4">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
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
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-5a2 2 0 00-2-2H6a2 2 0 00-2 2v5a2 2 0 002 2zm10-9V7a4 4 0 00-8 0v3h8z"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="text-lg font-bold text-slate-900">
                                        Security & Credentials
                                    </h2>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Update your password and strengthen account security.
                                    </p>
                                </div>

                            </div>

                        </div>


                        <form
                            action="{{ route('manager.settings.password.update') }}"
                            method="POST"
                            x-data="{
                                showCurrent: false,
                                showPassword: false,
                                showConfirmation: false
                            }"
                        >

                            @csrf
                            @method('PUT')


                            <div class="space-y-5 p-5 sm:p-6">

                                {{-- Current Password --}}
                                <div>

                                    <label
                                        for="current_password"
                                        class="mb-2 block text-sm font-semibold text-slate-700"
                                    >
                                        Current Password
                                    </label>

                                    <div class="relative">

                                        <input
                                            id="current_password"
                                            :type="showCurrent ? 'text' : 'password'"
                                            name="current_password"
                                            autocomplete="current-password"
                                            class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 pr-12 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                            placeholder="Enter your current password"
                                        >

                                        <button
                                            type="button"
                                            @click="showCurrent = !showCurrent"
                                            class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 hover:text-slate-600"
                                            :aria-label="showCurrent ? 'Hide password' : 'Show password'"
                                        >
                                            <svg
                                                x-show="!showCurrent"
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                />
                                            </svg>

                                            <svg
                                                x-show="showCurrent"
                                                x-cloak
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 013.044-4.416M6.24 6.24A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.97 9.97 0 01-3.04 4.41M3 3l18 18"
                                                />
                                            </svg>
                                        </button>

                                    </div>

                                    @error('current_password')
                                        <p class="mt-1.5 text-xs text-rose-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- New Password --}}
                                <div>

                                    <label
                                        for="password"
                                        class="mb-2 block text-sm font-semibold text-slate-700"
                                    >
                                        New Password
                                    </label>

                                    <div class="relative">

                                        <input
                                            id="password"
                                            :type="showPassword ? 'text' : 'password'"
                                            name="password"
                                            autocomplete="new-password"
                                            class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 pr-12 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                            placeholder="Enter a new password"
                                        >

                                        <button
                                            type="button"
                                            @click="showPassword = !showPassword"
                                            class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 hover:text-slate-600"
                                            :aria-label="showPassword ? 'Hide password' : 'Show password'"
                                        >
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
                                                    stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                />
                                            </svg>

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
                                                    stroke-width="2"
                                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 013.044-4.416M6.24 6.24A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7 9.97 0 8.268 2.943 9.542 7a9.97 9.97 0 01-3.04 4.41M3 3l18 18"
                                                />
                                            </svg>
                                        </button>

                                    </div>

                                    @error('password')
                                        <p class="mt-1.5 text-xs text-rose-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- Confirm Password --}}
                                <div>

                                    <label
                                        for="password_confirmation"
                                        class="mb-2 block text-sm font-semibold text-slate-700"
                                    >
                                        Confirm New Password
                                    </label>

                                    <div class="relative">

                                        <input
                                            id="password_confirmation"
                                            :type="showConfirmation ? 'text' : 'password'"
                                            name="password_confirmation"
                                            autocomplete="new-password"
                                            class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 pr-12 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                            placeholder="Confirm your new password"
                                        >

                                        <button
                                            type="button"
                                            @click="showConfirmation = !showConfirmation"
                                            class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 hover:text-slate-600"
                                            :aria-label="showConfirmation ? 'Hide password' : 'Show password'"
                                        >
                                            <svg
                                                x-show="!showConfirmation"
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                />
                                            </svg>

                                            <svg
                                                x-show="showConfirmation"
                                                x-cloak
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 013.044-4.416M6.24 6.24A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7 9.97 0 8.268 2.943 9.542 7a9.97 9.97 0 01-3.04 4.41M3 3l18 18"
                                                />
                                            </svg>
                                        </button>

                                    </div>

                                    @error('password_confirmation')
                                        <p class="mt-1.5 text-xs text-rose-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- Security Guidance --}}
                                <div class="rounded-xl border border-indigo-100 bg-indigo-50 p-4">

                                    <div class="flex items-start gap-3">

                                        <svg
                                            class="mt-0.5 h-5 w-5 shrink-0 text-indigo-600"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M12 22a10 10 0 100-20 10 10 0 000 20z"
                                            />
                                        </svg>

                                        <div>
                                            <p class="text-sm font-semibold text-indigo-900">
                                                Password security
                                            </p>

                                            <p class="mt-1 text-xs leading-5 text-indigo-700">
                                                Use a strong password that is unique to this account and avoid sharing your credentials.
                                            </p>
                                        </div>

                                    </div>

                                </div>

                            </div>


                            <div class="flex justify-end border-t border-slate-200 bg-slate-50 px-5 py-4 sm:px-6">

                                <button
                                    type="submit"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
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
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-5a2 2 0 00-2-2H6a2 2 0 00-2 2v5a2 2 0 002 2z"
                                        />
                                    </svg>

                                    Update Password
                                </button>

                            </div>

                        </form>

                    </div>


                    {{-- =================================================
                        TWO FACTOR AUTHENTICATION
                    ================================================== --}}
                    <div
                        x-data="{ twoFactorEnabled: false }"
                        class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
                    >

                        <div class="p-5 sm:p-6">

                            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                                <div class="flex items-start gap-4">

                                    <div
                                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl"
                                        :class="twoFactorEnabled
                                            ? 'bg-emerald-50 text-emerald-600'
                                            : 'bg-slate-100 text-slate-500'"
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
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-5a2 2 0 00-2-2H6a2 2 0 00-2 2v5a2 2 0 002 2zm10-9V7a4 4 0 00-8 0v3h8z"
                                            />
                                        </svg>

                                    </div>

                                    <div>

                                        <div class="flex flex-wrap items-center gap-2">

                                            <h2 class="text-base font-bold text-slate-900">
                                                Two-Factor Authentication
                                            </h2>

                                            <span
                                                x-show="twoFactorEnabled"
                                                class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700"
                                            >
                                                Enabled
                                            </span>

                                            <span
                                                x-show="!twoFactorEnabled"
                                                class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600"
                                            >
                                                Disabled
                                            </span>

                                        </div>

                                        <p class="mt-1 max-w-2xl text-sm leading-6 text-slate-500">
                                            Add an additional layer of security by requiring a second verification step when accessing your account.
                                        </p>

                                    </div>

                                </div>


                                <button
                                    type="button"
                                    @click="twoFactorEnabled = !twoFactorEnabled"
                                    class="inline-flex shrink-0 items-center justify-center rounded-xl px-4 py-2.5 text-sm font-semibold transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    :class="twoFactorEnabled
                                        ? 'border border-rose-200 bg-rose-50 text-rose-700 hover:bg-rose-100'
                                        : 'bg-indigo-600 text-white hover:bg-indigo-700'"
                                >
                                    <span x-text="twoFactorEnabled ? 'Disable 2FA' : 'Enable 2FA'"></span>
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            {{-- =================================================
                TAB 3: NOTIFICATIONS
            ================================================== --}}
            <section
                x-show="activeTab === 'notifications'"
                x-transition.opacity
                x-cloak
            >

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    {{-- Header --}}
                    <div class="border-b border-slate-200 px-5 py-5 sm:px-6">

                        <div class="flex items-start gap-4">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

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
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                                    />
                                </svg>

                            </div>

                            <div>

                                <h2 class="text-lg font-bold text-slate-900">
                                    Notification Preferences
                                </h2>

                                <p class="mt-1 text-sm text-slate-500">
                                    Choose which property and customer activity alerts you want to receive.
                                </p>

                            </div>

                        </div>

                    </div>


                    <form
                        action="{{ route('manager.settings.notifications.update') }}"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')


                        <div class="divide-y divide-slate-200">


                            {{-- New Reservations --}}
                            <div
                                x-data="{ enabled: {{ old('new_reservation_requests', $user->new_reservation_requests ?? true) ? 'true' : 'false' }} }"
                                class="p-5 sm:p-6"
                            >

                                <div class="flex items-start justify-between gap-5">

                                    <div class="flex gap-4">

                                        <div class="hidden h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 sm:flex">

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
                                                    d="M8 7V3m8 4V3m-9 4h10M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"
                                                />
                                            </svg>

                                        </div>

                                        <div>

                                            <h3 class="text-sm font-bold text-slate-900">
                                                New Reservation Requests
                                            </h3>

                                            <p class="mt-1 max-w-xl text-sm leading-6 text-slate-500">
                                                Receive email alert when a customer books an apartment.
                                            </p>

                                        </div>

                                    </div>


                                    <label class="relative inline-flex shrink-0 cursor-pointer items-center">

                                        <input
                                            type="checkbox"
                                            name="new_reservation_requests"
                                            value="1"
                                            x-model="enabled"
                                            class="peer sr-only"
                                        >

                                        <div
                                            class="h-6 w-11 rounded-full bg-slate-200 transition peer-checked:bg-indigo-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-100"
                                        ></div>

                                        <div
                                            class="absolute left-0.5 top-0.5 h-5 w-5 rounded-full bg-white shadow-sm transition-transform peer-checked:translate-x-5"
                                        ></div>

                                    </label>

                                </div>

                            </div>


                            {{-- Booking Status Changes --}}
                            <div
                                x-data="{ enabled: {{ old('booking_status_changes', $user->booking_status_changes ?? true) ? 'true' : 'false' }} }"
                                class="p-5 sm:p-6"
                            >

                                <div class="flex items-start justify-between gap-5">

                                    <div class="flex gap-4">

                                        <div class="hidden h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-amber-50 text-amber-600 sm:flex">

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
                                                    d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                />
                                            </svg>

                                        </div>

                                        <div>

                                            <h3 class="text-sm font-bold text-slate-900">
                                                Booking Status Changes
                                            </h3>

                                            <p class="mt-1 max-w-xl text-sm leading-6 text-slate-500">
                                                Receive notification when a booking is confirmed or cancelled.
                                            </p>

                                        </div>

                                    </div>


                                    <label class="relative inline-flex shrink-0 cursor-pointer items-center">

                                        <input
                                            type="checkbox"
                                            name="booking_status_changes"
                                            value="1"
                                            x-model="enabled"
                                            class="peer sr-only"
                                        >

                                        <div
                                            class="h-6 w-11 rounded-full bg-slate-200 transition peer-checked:bg-indigo-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-100"
                                        ></div>

                                        <div
                                            class="absolute left-0.5 top-0.5 h-5 w-5 rounded-full bg-white shadow-sm transition-transform peer-checked:translate-x-5"
                                        ></div>

                                    </label>

                                </div>

                            </div>


                            {{-- Customer Reviews --}}
                            <div
                                x-data="{ enabled: {{ old('customer_reviews', $user->customer_reviews ?? true) ? 'true' : 'false' }} }"
                                class="p-5 sm:p-6"
                            >

                                <div class="flex items-start justify-between gap-5">

                                    <div class="flex gap-4">

                                        <div class="hidden h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600 sm:flex">

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
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.802 2.036a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.539 1.118l-2.802-2.036a1 1 0 00-1.176 0l-2.802 2.036c-.783.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L5.87 8.72c-.783-.57-.38-1.81.588-1.81H9.92a1 1 0 00.95-.69l1.07-3.292z"
                                                />
                                            </svg>

                                        </div>

                                        <div>

                                            <h3 class="text-sm font-bold text-slate-900">
                                                Customer Reviews
                                            </h3>

                                            <p class="mt-1 max-w-xl text-sm leading-6 text-slate-500">
                                                Receive notification when a customer submits a new review.
                                            </p>

                                        </div>

                                    </div>


                                    <label class="relative inline-flex shrink-0 cursor-pointer items-center">

                                        <input
                                            type="checkbox"
                                            name="customer_reviews"
                                            value="1"
                                            x-model="enabled"
                                            class="peer sr-only"
                                        >

                                        <div
                                            class="h-6 w-11 rounded-full bg-slate-200 transition peer-checked:bg-indigo-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-100"
                                        ></div>

                                        <div
                                            class="absolute left-0.5 top-0.5 h-5 w-5 rounded-full bg-white shadow-sm transition-transform peer-checked:translate-x-5"
                                        ></div>

                                    </label>

                                </div>

                            </div>

                        </div>


                        {{-- Notification Form Footer --}}
                        <div class="flex justify-end border-t border-slate-200 bg-slate-50 px-5 py-4 sm:px-6">

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
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
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>

                                Save Notification Settings

                            </button>

                        </div>

                    </form>

                </div>

            </section>

        </main>

    </div>

</div>


{{-- =============================================================
    ALPINE CLOAK
============================================================== --}}
<style>
    [x-cloak] {
        display: none !important;
    }
</style>


</div>


</x-mdLayout>