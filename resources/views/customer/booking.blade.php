<x-customerLayout>

<div
    x-data="bookingPage()"
    x-init="init()"
    class="min-h-screen bg-slate-50 py-6 sm:py-8"
>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">


    {{-- Breadcrumb --}}
    <nav class="mb-6 flex items-center gap-2 overflow-x-auto whitespace-nowrap text-sm text-slate-500">
        <a href="{{ url('/') }}" class="transition hover:text-indigo-600">
            Home
        </a>

        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5l7 7-7 7"/>
        </svg>

        <a href="{{ url('/apartments') }}" class="transition hover:text-indigo-600">
            Apartments
        </a>

        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5l7 7-7 7"/>
        </svg>

        <span class="max-w-[180px] truncate text-slate-700">
            {{ $appartment->appart_designation }}
        </span>

        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5l7 7-7 7"/>
        </svg>

        <span class="font-medium text-slate-900">
            Reserve
        </span>
    </nav>

    {{-- Page Heading --}}
    <div class="mb-8">
        <p class="mb-2 text-sm font-semibold uppercase tracking-wider text-indigo-600">
            Reservation
        </p>

        <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
            Complete Your Reservation
        </h1>

        <p class="mt-2 max-w-2xl text-sm text-slate-500 sm:text-base">
            Select your preferred dates and review the reservation details before submitting your request.
        </p>
     {{-- Success, Warning & Error Alerts --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            @if (session('success'))
                <div x-data="{ show: true }" 
                    x-show="show" 
                    x-transition
                    x-init="setTimeout(() => show = false, 6000)" 
                    class="mb-6 rounded-lg bg-emerald-50 border border-emerald-200 p-4 text-emerald-800 flex items-center justify-between shadow-sm">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                    <button @click="show = false" type="button" class="text-emerald-500 hover:text-emerald-700 font-bold p-1">
                        <span class="sr-only">Close</span>
                        &times;
                    </button>
                </div>
            @endif

            @if (session('warning'))
                <div x-data="{ show: true }" 
                    x-show="show" 
                    x-transition
                    class="mb-6 rounded-lg bg-amber-50 border border-amber-200 p-4 text-amber-800 flex items-center justify-between shadow-sm">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="text-sm font-medium">{{ session('warning') }}</p>
                    </div>
                    <button @click="show = false" type="button" class="text-amber-500 hover:text-amber-700 font-bold p-1">
                        <span class="sr-only">Close</span>
                        &times;
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div x-data="{ show: true }" 
                    x-show="show" 
                    x-transition
                    class="mb-6 rounded-lg bg-rose-50 border border-rose-200 p-4 text-rose-800 flex items-center justify-between shadow-sm">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                    <button @click="show = false" type="button" class="text-rose-500 hover:text-rose-700 font-bold p-1">
                        <span class="sr-only">Close</span>
                        &times;
                    </button>
                </div>
            @endif
        </div>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-rose-800">
            <div class="flex items-start gap-3">
                <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4m0 4h.01M10.29 3.86l-8.18 14A2 2 0 003.84 21h16.32a2 2 0 001.73-3.14l-8.18-14a2 2 0 00-3.42 0z"/>
                </svg>

                <div>
                    <p class="font-semibold">Please correct the following:</p>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 lg:items-start lg:gap-8">

        {{-- ==========================================================
             LEFT COLUMN — PROPERTY DETAILS
        =========================================================== --}}
        <div class="space-y-6 lg:col-span-7">

            {{-- Image Gallery --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                @if ($appartment->images && $appartment->images->count())
                    <div class="grid h-[320px] grid-cols-1 gap-1 sm:h-[400px] sm:grid-cols-2">

                        @foreach ($appartment->images->take(4) as $index => $image)
                            <div
                                class="relative overflow-hidden
                                {{ $index === 0 ? 'sm:row-span-2' : '' }}
                                {{ $index >= 3 ? 'hidden sm:block' : '' }}"
                            >
                                <img
                                    src="{{ asset('storage/' . $image->img) }}"
                                    alt="{{ $appartment->appart_designation }}"
                                    class="h-full w-full object-cover transition duration-500 hover:scale-105"
                                >

                                @if ($index === 0)
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                                @endif
                            </div>
                        @endforeach

                    </div>

                    @if ($appartment->images->count() > 4)
                        <div class="border-t border-slate-100 px-4 py-3 text-center text-sm text-slate-500">
                            +{{ $appartment->images->count() - 4 }} more photos
                        </div>
                    @endif

                @else
                    <div class="flex h-[320px] items-center justify-center bg-slate-100 sm:h-[400px]">
                        <div class="text-center">
                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-slate-200">
                                <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>

                            <p class="mt-3 text-sm font-medium text-slate-500">
                                No apartment images available
                            </p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Apartment Information --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">
                            {{ $appartment->appart_designation }}
                        </h2>

                        <div class="mt-3 flex flex-wrap items-center gap-2 text-sm text-slate-500">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1.5 font-medium text-indigo-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2m-2 0h-2M9 7h1m-1 4h1m4-4h1m-1 4h1"/>
                                </svg>

                                {{ $appartment->building->building_name }}
                            </span>

                            <span class="hidden text-slate-300 sm:inline">•</span>

                            <span class="inline-flex items-center gap-1.5">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>

                                {{ $appartment->building->address }}
                            </span>
                        </div>
                    </div>

                    <div class="shrink-0">
                        <span class="inline-flex items-baseline rounded-xl bg-slate-900 px-4 py-2 text-white">
                            <span class="text-lg font-bold">
                                {{\Illuminate\Support\Number::currency($appartment->price, 'USD')}}
                            </span>

                            <span class="ml-1 text-xs text-slate-300">
                                / night
                            </span>
                        </span>
                    </div>
                </div>

                {{-- Amenities --}}
                <div class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-4">

                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-3">
                        <p class="text-xs text-slate-500">Bedrooms</p>
                        <p class="mt-1 font-semibold text-slate-900">
                            {{ $appartment->bedroom }}
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-3">
                        <p class="text-xs text-slate-500">Bathrooms</p>
                        <p class="mt-1 font-semibold text-slate-900">
                            {{ $appartment->bathroom }}
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-3">
                        <p class="text-xs text-slate-500">Kitchen</p>
                        <p class="mt-1 font-semibold text-slate-900">
                            {{ $appartment->kitchen }}
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-3">
                        <p class="text-xs text-slate-500">Balcony</p>
                        <p class="mt-1 font-semibold text-slate-900">
                            {{ $appartment->balcon }}
                        </p>
                    </div>

                </div>
            </div>

            {{-- Policies --}}
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                {{-- Cancellation Policy --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50">
                            <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>

                        <h3 class="font-semibold text-slate-900">
                            Cancellation Policy
                        </h3>
                    </div>

                    <p class="mt-4 text-sm leading-6 text-slate-600">
                        Cancellation policies are subject to the property's reservation terms.
                        Please review the applicable conditions before submitting your request.
                    </p>
                </div>

                {{-- House Rules --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50">
                            <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 11c0 3.517-1.5 5-4 5s-4-1.483-4-5 1.5-5 4-5 4 1.483 4 5zm0 0c0-3.517 1.5-5 4-5s4 1.483 4 5-1.5 5-4 5-4-1.483-4-5zm-4 5v3m8-3v3"/>
                            </svg>
                        </div>

                        <h3 class="font-semibold text-slate-900">
                            House Rules
                        </h3>
                    </div>

                    <p class="mt-4 text-sm leading-6 text-slate-600">
                        Guests are expected to respect the property, its facilities,
                        and other residents throughout their stay.
                    </p>
                </div>

            </div>
        </div>
        
        {{-- ==========================================================
             RIGHT COLUMN — BOOKING CHECKOUT
        =========================================================== --}}
        

        <div class="lg:col-span-5">
            <div class="lg:sticky lg:top-6">

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg">

                    {{-- Checkout Header --}}
                    <div class="border-b border-slate-100 p-5 sm:p-6">

                        <div class="flex items-center justify-between gap-4">

                            <div>
                                <p class="text-sm font-medium text-slate-500">
                                    Nightly rate
                                </p>

                                <div class="mt-1 flex items-baseline gap-1">
                                    <span class="text-2xl font-bold text-slate-900">
                                        {{\Illuminate\Support\Number::currency($appartment->price, 'USD')}}
                                    </span>

                                    <span class="text-sm text-slate-500">
                                        / night
                                    </span>
                                </div>
                            </div>

                            <div class="rounded-xl bg-indigo-50 px-3 py-2 text-xs font-semibold text-indigo-700">
                                Secure booking
                            </div>

                        </div>
                    </div>

                    {{-- Booking Form --}}
                    <form
                        action="{{ route('bookings.store') }}"
                        method="POST"
                        @submit="prepareSubmission"
                        class="p-5 sm:p-6"
                    >
                        @csrf

                        <input type="hidden" name="appartment_id" value="{{ $appartment->id }}">
                        <input type="hidden" name="start_date" x-model="startDate">
                        <input type="hidden" name="end_date" x-model="endDate">
                        <input type="hidden" name="number_days" x-model="numberDays">
                        <input type="hidden" name="price" x-model="totalPrice">

                        {{-- Date Selection --}}
                        <div>
                            <div class="mb-3 flex items-center justify-between">
                                <label class="text-sm font-semibold text-slate-900">
                                    Select your dates
                                </label>

                                <span class="text-xs text-slate-500">
                                    Minimum 1 night
                                </span>
                            </div>

                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>

                                <input
                                    id="booking-date-range"
                                    type="text"
                                    placeholder="Select check-in and check-out"
                                    readonly
                                    class="w-full cursor-pointer rounded-xl border border-slate-300 bg-white py-3.5 pl-11 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10"
                                >
                            </div>

                            <div class="mt-3 flex items-start gap-2 rounded-xl bg-slate-50 p-3">
                                <svg class="mt-0.5 h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13 16h-1v-4h-1m1-8h.01M12 20a8 8 0 100-16 8 8 0 000 16z"/>
                                </svg>

                                <p class="text-xs leading-5 text-slate-500">
                                    Dates that are already reserved are unavailable and cannot be selected.
                                </p>
                            </div>
                        </div>

                        {{-- Selected Dates --}}
                        <div
                            x-show="startDate || endDate"
                            x-cloak
                            class="mt-5 grid grid-cols-2 gap-3"
                        >
                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-3">
                                <p class="text-xs text-slate-500">
                                    Check-in
                                </p>

                                <p
                                    class="mt-1 text-sm font-semibold text-slate-900"
                                    x-text="formatDisplayDate(startDate) || '—'"
                                ></p>
                            </div>

                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-3">
                                <p class="text-xs text-slate-500">
                                    Check-out
                                </p>

                                <p
                                    class="mt-1 text-sm font-semibold text-slate-900"
                                    x-text="formatDisplayDate(endDate) || '—'"
                                ></p>
                            </div>
                        </div>

                        {{-- Financial Summary --}}
                        <div class="my-6 border-t border-slate-100 pt-5">

                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500">
                                    Nightly rate
                                </span>

                                <span class="font-medium text-slate-900">
                                    {{\Illuminate\Support\Number::currency($appartment->price, 'USD')}}
                                </span>
                            </div>

                            <div class="mt-3 flex items-center justify-between text-sm">
                                <span class="text-slate-500">
                                    Rate × Nights
                                </span>

                                <span class="font-medium text-slate-900">
                                    <span x-text="formatMoney(nightlyRate)"></span>
                                    ×
                                    <span x-text="numberDays"></span>
                                </span>
                            </div>

                            <div class="mt-5 border-t border-slate-100 pt-4">
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-slate-900">
                                        Total Price
                                    </span>

                                    <span class="text-xl font-bold text-indigo-600">
                                        <span x-text="formatMoney(totalPrice)"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <button
                            type="submit"
                            :disabled="!isValid"
                            :class="isValid
                                ? 'bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500'
                                : 'cursor-not-allowed bg-slate-300'"
                            class="flex w-full items-center justify-center gap-2 rounded-xl px-5 py-3.5 text-sm font-semibold text-white shadow-sm transition focus:outline-none focus:ring-4 disabled:opacity-70"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>

                            Confirm & Request Reservation
                        </button>
                        

                        <p class="mt-3 text-center text-xs leading-5 text-slate-400">
                            Your reservation request will be submitted for processing.
                        </p>

                    </form>
                </div>

            </div>
        </div>

    </div>
</div>


</div>

{{-- Flatpickr CSS --}} <link
     rel="stylesheet"
     href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"
 >


<style>
    [x-cloak] {
        display: none !important;
    }

    .flatpickr-calendar {
        border-radius: 1rem;
        border: 1px solid #e2e8f0;
        box-shadow:
            0 20px 25px -5px rgb(15 23 42 / 0.10),
            0 8px 10px -6px rgb(15 23 42 / 0.10);
        overflow: hidden;
    }

    .flatpickr-day.disabled,
    .flatpickr-day.disabled:hover {
        color: #cbd5e1 !important;
        background: #f8fafc !important;
        text-decoration: line-through;
        cursor: not-allowed;
    }

    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange {
        background: #4f46e5 !important;
        border-color: #4f46e5 !important;
    }

    .flatpickr-day.inRange {
        background: #eef2ff !important;
        border-color: #eef2ff !important;
        color: #3730a3 !important;
        box-shadow: -5px 0 0 #eef2ff, 5px 0 0 #eef2ff;
    }

    .flatpickr-current-month,
    .flatpickr-weekdays {
        background: white;
    }

    .flatpickr-months .flatpickr-month {
        height: 48px;
    }

    .flatpickr-weekday {
        color: #64748b;
        font-weight: 600;
    }
</style>





{{-- Flatpickr JS --}} <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    function bookingPage() {
        return {
            nightlyRate: Number(@json($appartment->price)) || 0,

            startDate: '',
            endDate: '',
            numberDays: 0,
            totalPrice: 0,

            disabledDates: @json($disabledDates ?? []),

            datePicker: null,

            init() {
                this.$nextTick(() => {
                    this.initializeDatePicker();
                });
            },

            initializeDatePicker() {
                const input = document.getElementById('booking-date-range');

                if (!input) {
                    return;
                }

                this.datePicker = flatpickr(input, {
                    mode: 'range',

                    dateFormat: 'Y-m-d',

                    minDate: 'today',

                    disable: this.disabledDates,

                    showMonths: window.innerWidth >= 768 ? 2 : 1,

                    allowInput: false,

                    clickOpens: true,

                    onChange: (selectedDates) => {
                        if (selectedDates.length === 2) {
                            this.startDate = this.toLocalDate(selectedDates[0]);
                            this.endDate = this.toLocalDate(selectedDates[1]);

                            this.calculateTotal();
                        } else {
                            this.startDate = '';
                            this.endDate = '';
                            this.numberDays = 0;
                            this.totalPrice = 0;
                        }
                    }
                });
            },

            toLocalDate(date) {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');

                return `${year}-${month}-${day}`;
            },

            calculateTotal() {
                if (!this.startDate || !this.endDate) {
                    this.numberDays = 0;
                    this.totalPrice = 0;
                    return;
                }

                const start = this.parseDate(this.startDate);
                const end = this.parseDate(this.endDate);

                const difference = end.getTime() - start.getTime();

                this.numberDays = Math.ceil(
                    difference / (1000 * 60 * 60 * 24)
                );

                if (this.numberDays < 1) {
                    this.numberDays = 0;
                    this.totalPrice = 0;
                    return;
                }

                this.totalPrice = this.numberDays * this.nightlyRate;
            },

            parseDate(dateString) {
                const [year, month, day] = dateString
                    .split('-')
                    .map(Number);

                return new Date(year, month - 1, day);
            },

            formatDisplayDate(dateString) {
                if (!dateString) {
                    return '';
                }

                const date = this.parseDate(dateString);

                return new Intl.DateTimeFormat('en-US', {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric'
                }).format(date);
            },

            formatMoney(value) {
                const amount = Number(value) || 0;

                return new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD',
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(amount);
            },

            get isValid() {
                return Boolean(
                    this.startDate &&
                    this.endDate &&
                    this.numberDays >= 1 &&
                    this.totalPrice > 0
                );
            },

            prepareSubmission(event) {
                this.calculateTotal();

                if (!this.isValid) {
                    event.preventDefault();
                    return;
                }
            }
        };
    }
</script>


</x-customerLayout>