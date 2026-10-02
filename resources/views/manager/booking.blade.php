<x-mdLayout>

<div
    class="min-h-screen bg-slate-50"
    x-data="{
        activeStatus: 'all',
        selectedBuilding: 'all',
        startDate: '',
        endDate: '',


    showStatusModal: false,
    selectedBookingId: '',
    selectedStatus: '',

    openStatusModal(id, status) {
        this.selectedBookingId = id;
        this.selectedStatus = status;
        this.showStatusModal = true;
    },

    closeStatusModal() {
        this.showStatusModal = false;
        this.selectedBookingId = '';
        this.selectedStatus = '';
    },

    resetFilters() {
        this.activeStatus = 'all';
        this.selectedBuilding = 'all';
        this.startDate = '';
        this.endDate = '';
    },

    matchesBooking(status, buildingId, startDate, endDate) {
        if (
            this.activeStatus !== 'all' &&
            status !== this.activeStatus
        ) {
            return false;
        }

        if (
            this.selectedBuilding !== 'all' &&
            String(buildingId) !== String(this.selectedBuilding)
        ) {
            return false;
        }

        if (this.startDate && startDate < this.startDate) {
            return false;
        }

        if (this.endDate && endDate > this.endDate) {
            return false;
        }

        return true;
    }
}"
@keydown.escape.window="closeStatusModal()"


>


<div class="mx-auto max-w-[1800px] px-4 py-6 sm:px-6 lg:px-8">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="mb-8">

        <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
            Reservation & Booking Management
        </h1>

        <p class="mt-1 max-w-3xl text-sm text-slate-500 sm:text-base">
            Monitor property bookings, filter by date or building, and update reservation statuses.
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

                <svg
                    class="mt-0.5 h-5 w-5 shrink-0 text-emerald-600"
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

                <p class="text-sm font-medium">
                    {{ session('success') }}
                </p>

            </div>

            <button
                type="button"
                @click="show = false"
                class="rounded-lg p-1 text-emerald-600 transition hover:bg-emerald-100"
                aria-label="Dismiss success message"
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
    @if(session('error') || $errors->any())

        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition
            role="alert"
            class="mb-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-rose-800"
        >

            <div class="flex items-start justify-between gap-4">

                <div class="flex items-start gap-3">

                    <svg
                        class="mt-0.5 h-5 w-5 shrink-0 text-rose-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 2.98h15.58a2 2 0 001.74-2.98l-7.82-14a2 2 0 00-3.42 0z"
                        />
                    </svg>

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
                    aria-label="Dismiss error message"
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
        SUMMARY METRICS
    ========================================================== --}}
    @php
        $confirmedCount = $bookings->where('status', 'confirmed')->count();
        $processingCount = $bookings->where('status', 'processing')->count();
        $cancelledCount = $bookings->where('status', 'cancelled')->count();
        $confirmedRevenue = $bookings
            ->where('status', 'confirmed')
            ->sum('price');
    @endphp

    <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">

        {{-- Total Reservations --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Reservations
                    </p>

                    <p class="mt-2 text-2xl font-bold text-slate-900">
                        {{ $bookings->count() }}
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
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
                            d="M8 7V3m8 4V3m-9 8h10M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"
                        />
                    </svg>
                </div>

            </div>

        </div>


        {{-- Confirmed --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Confirmed
                    </p>

                    <p class="mt-2 text-2xl font-bold text-emerald-700">
                        {{ $confirmedCount }}
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
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
                            d="M5 13l4 4L19 7"
                        />
                    </svg>
                </div>

            </div>

        </div>


        {{-- Processing --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Pending Processing
                    </p>

                    <p class="mt-2 text-2xl font-bold text-amber-600">
                        {{ $processingCount }}
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
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
                            d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                </div>

            </div>

        </div>


        {{-- Revenue --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Revenue
                    </p>

                    <p class="mt-2 text-2xl font-bold text-slate-900">
                        ${{ number_format($confirmedRevenue, 2) }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Confirmed bookings
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
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
                            d="M12 8c-2.21 0-4 1.12-4 2.5S9.79 13 12 13s4 1.12 4 2.5S14.21 18 12 18m0-10V6m0 12v-2M19 12a7 7 0 11-14 0 7 7 0 0114 0z"
                        />
                    </svg>
                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        FILTER TOOLBAR
    ========================================================== --}}
    <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-5 py-4 sm:px-6">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                {{-- Status Pills --}}
                <div class="flex flex-wrap gap-2">

                    <button
                        type="button"
                        @click="activeStatus = 'all'"
                        :class="activeStatus === 'all'
                            ? 'bg-indigo-600 text-white shadow-sm'
                            : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                        class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-xs font-semibold transition"
                    >
                        All
                        <span
                            class="rounded-full px-1.5 py-0.5 text-[10px]"
                            :class="activeStatus === 'all'
                                ? 'bg-white/20 text-white'
                                : 'bg-white text-slate-500'"
                        >
                            {{ $bookings->count() }}
                        </span>
                    </button>


                    <button
                        type="button"
                        @click="activeStatus = 'confirmed'"
                        :class="activeStatus === 'confirmed'
                            ? 'bg-emerald-600 text-white shadow-sm'
                            : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                        class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-xs font-semibold transition"
                    >
                        Confirmed

                        <span
                            class="rounded-full px-1.5 py-0.5 text-[10px]"
                            :class="activeStatus === 'confirmed'
                                ? 'bg-white/20 text-white'
                                : 'bg-white text-slate-500'"
                        >
                            {{ $confirmedCount }}
                        </span>
                    </button>


                    <button
                        type="button"
                        @click="activeStatus = 'processing'"
                        :class="activeStatus === 'processing'
                            ? 'bg-amber-500 text-white shadow-sm'
                            : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                        class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-xs font-semibold transition"
                    >
                        Processing

                        <span
                            class="rounded-full px-1.5 py-0.5 text-[10px]"
                            :class="activeStatus === 'processing'
                                ? 'bg-white/20 text-white'
                                : 'bg-white text-slate-500'"
                        >
                            {{ $processingCount }}
                        </span>
                    </button>


                    <button
                        type="button"
                        @click="activeStatus = 'cancelled'"
                        :class="activeStatus === 'cancelled'
                            ? 'bg-rose-600 text-white shadow-sm'
                            : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                        class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-xs font-semibold transition"
                    >
                        Cancelled

                        <span
                            class="rounded-full px-1.5 py-0.5 text-[10px]"
                            :class="activeStatus === 'cancelled'
                                ? 'bg-white/20 text-white'
                                : 'bg-white text-slate-500'"
                        >
                            {{ $cancelledCount }}
                        </span>
                    </button>

                </div>

            </div>

        </div>


        {{-- Filters --}}
        <div class="grid grid-cols-1 gap-4 p-5 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Building --}}
            <div>
                <label
                    for="buildingFilter"
                    class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500"
                >
                    Building
                </label>

                <select
                    id="buildingFilter"
                    x-model="selectedBuilding"
                    class="block w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                >
                    <option value="all">
                        All Buildings
                    </option>

                    @foreach($buildings as $building)
                        <option value="{{ $building->id }}">
                            {{ $building->building_name }}
                        </option>
                    @endforeach

                </select>
            </div>


            {{-- Start Date --}}
            <div>
                <label
                    for="startDateFilter"
                    class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500"
                >
                    Start Date
                </label>

                <input
                    id="startDateFilter"
                    type="date"
                    x-model="startDate"
                    class="block w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                >
            </div>


            {{-- End Date --}}
            <div>
                <label
                    for="endDateFilter"
                    class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500"
                >
                    End Date
                </label>

                <input
                    id="endDateFilter"
                    type="date"
                    x-model="endDate"
                    class="block w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                >
            </div>


            {{-- Reset --}}
            <div class="flex items-end">

                <button
                    type="button"
                    @click="resetFilters()"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
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
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9M4.582 9H9m11 11v-5h-.582m0 0a8.003 8.003 0 01-15.356-2M19.418 15H15"
                        />
                    </svg>

                    Reset Filters
                </button>

            </div>

        </div>

    </div>


    {{-- =========================================================
        BOOKINGS TABLE
    ========================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="flex flex-col gap-2 border-b border-slate-200 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">

            <div>
                <h2 class="text-lg font-bold text-slate-900">
                    Reservations
                </h2>

                <p class="text-sm text-slate-500">
                    Manage and update your property reservations.
                </p>
            </div>

            <div class="text-sm text-slate-500">
                {{ $bookings->count() }}
                {{ $bookings->count() === 1 ? 'reservation' : 'reservations' }}
            </div>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full min-w-[1250px] text-left text-sm">

                <thead class="bg-slate-50">

                    <tr class="border-b border-slate-200">

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Booking ID
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Customer Info
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Property & Building
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Dates & Duration
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Total Price
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Status
                        </th>

                        <th class="px-5 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($bookings as $booking)

                        @php
                            $bookingStatus = strtolower($booking->status ?? '');
                            $buildingId = $booking->appartment?->building?->id;

                            $startDateValue = $booking->start_date
                                ? \Carbon\Carbon::parse($booking->start_date)->format('Y-m-d')
                                : '';

                            $endDateValue = $booking->end_date
                                ? \Carbon\Carbon::parse($booking->end_date)->format('Y-m-d')
                                : '';
                        @endphp

                        <tr
                            x-show="matchesBooking(
                                @js($bookingStatus),
                                @js($buildingId),
                                @js($startDateValue),
                                @js($endDateValue)
                            )"
                            x-transition
                            class="transition hover:bg-slate-50"
                        >

                            {{-- =========================================
                                BOOKING ID
                            ========================================== --}}
                            <td class="whitespace-nowrap px-5 py-5 align-middle">

                                <span class="font-bold text-indigo-600">
                                    #BK-{{ $booking->id }}
                                </span>

                                <p class="mt-1 text-xs text-slate-400">
                                    {{ $booking->created_at?->format('M d, Y') }}
                                </p>

                            </td>


                            {{-- =========================================
                                CUSTOMER
                            ========================================== --}}
                            <td class="px-5 py-5 align-middle">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-bold text-indigo-700">
                                        {{ strtoupper(substr($booking->user?->name ?? 'U', 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">

                                        <p class="font-semibold text-slate-900">
                                            {{ $booking->user?->name ?? 'Unknown Customer' }}
                                        </p>

                                        <p class="max-w-[230px] truncate text-xs text-slate-500">
                                            {{ $booking->user?->email ?? 'No email' }}
                                        </p>

                                        @if($booking->user?->phone)
                                            <p class="text-xs text-slate-400">
                                                {{ $booking->user->phone }}
                                            </p>
                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- =========================================
                                PROPERTY
                            ========================================== --}}
                            <td class="px-5 py-5 align-middle">

                                <p class="font-semibold text-slate-900">
                                    {{ $booking->appartment?->appart_designation ?? 'Unknown Apartment' }}
                                </p>

                                <span class="mt-1 inline-flex items-center rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">
                                    <svg
                                        class="mr-1 h-3.5 w-3.5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5M9 9h.01M15 9h.01M9 12h.01M15 12h.01"
                                        />
                                    </svg>

                                    {{ $booking->appartment?->building?->building_name ?? 'Unknown Building' }}
                                </span>

                            </td>


                            {{-- =========================================
                                DATES
                            ========================================== --}}
                            <td class="px-5 py-5 align-middle">

                                <div class="flex items-center gap-2 text-sm font-medium text-slate-700">

                                    <span>
                                        {{ $booking->start_date }}
                                    </span>

                                    <svg
                                        class="h-4 w-4 text-slate-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5l7 7-7 7"
                                        />
                                    </svg>

                                    <span>
                                        {{ $booking->end_date }}
                                    </span>

                                </div>

                                <span class="mt-2 inline-flex rounded-lg bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-700">
                                    {{ $booking->number_days }} Days
                                </span>

                            </td>


                            {{-- =========================================
                                PRICE
                            ========================================== --}}
                            <td class="whitespace-nowrap px-5 py-5 align-middle">

                                <span class="text-base font-bold text-slate-900">
                                    ${{ number_format((float) $booking->price, 2) }}
                                </span>

                            </td>


                            {{-- =========================================
                                STATUS
                            ========================================== --}}
                            <td class="px-5 py-5 align-middle">

                                @if($bookingStatus === 'confirmed')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-3 py-1.5 text-xs font-semibold text-emerald-800">

                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                        Confirmed
                                    </span>

                                @elseif($bookingStatus === 'processing')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1.5 text-xs font-semibold text-amber-800">

                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                        Processing
                                    </span>

                                @elseif($bookingStatus === 'cancelled')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-100 px-3 py-1.5 text-xs font-semibold text-rose-800">

                                        <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>

                                        Cancelled
                                    </span>

                                @else

                                    <span class="inline-flex rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-700">
                                        {{ ucfirst($bookingStatus ?: 'Unknown') }}
                                    </span>

                                @endif

                            </td>


                            {{-- =========================================
                                ACTIONS
                            ========================================== --}}
                            <td class="px-5 py-5 align-middle">

                                <div class="flex items-center justify-end">

                                    <div
                                        x-data="{ open: false }"
                                        class="relative"
                                    >

                                        <button
                                            type="button"
                                            @click="open = !open"
                                            @keydown.escape="open = false"
                                            class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-3 py-2 text-xs font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                        >
                                            Update Status

                                            <svg
                                                class="h-4 w-4 transition"
                                                :class="open ? 'rotate-180' : ''"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 9l-7 7-7-7"
                                                />
                                            </svg>

                                        </button>


                                        {{-- Status Dropdown --}}
                                        <div
                                            x-show="open"
                                            x-cloak
                                            x-transition
                                            @click.outside="open = false"
                                            class="absolute right-0 z-30 mt-2 w-48 overflow-hidden rounded-xl border border-slate-200 bg-white py-1 shadow-xl"
                                        >

                                            @if($bookingStatus !== 'processing')
                                                <button
                                                    type="button"
                                                    @click="
                                                        open = false;
                                                        openStatusModal('{{ $booking->id }}', 'processing')
                                                    "
                                                    class="flex w-full items-center gap-2 px-4 py-2.5 text-left text-sm text-amber-700 transition hover:bg-amber-50"
                                                >
                                                    <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                                                    Set Processing
                                                </button>
                                            @endif


                                            @if($bookingStatus !== 'confirmed')
                                                <button
                                                    type="button"
                                                    @click="
                                                        open = false;
                                                        openStatusModal('{{ $booking->id }}', 'confirmed')
                                                    "
                                                    class="flex w-full items-center gap-2 px-4 py-2.5 text-left text-sm text-emerald-700 transition hover:bg-emerald-50"
                                                >
                                                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                                    Confirm Booking
                                                </button>
                                            @endif


                                            @if($bookingStatus !== 'cancelled')
                                                <button
                                                    type="button"
                                                    @click="
                                                        open = false;
                                                        openStatusModal('{{ $booking->id }}', 'cancelled')
                                                    "
                                                    class="flex w-full items-center gap-2 px-4 py-2.5 text-left text-sm text-rose-700 transition hover:bg-rose-50"
                                                >
                                                    <span class="h-2 w-2 rounded-full bg-rose-500"></span>
                                                    Cancel Booking
                                                </button>
                                            @endif

                                        </div>

                                    </div>

                                </div>

                            </td>

                        </tr>

                    @empty

                        {{-- Empty Database State --}}
                        <tr>
                            <td
                                colspan="7"
                                class="px-6 py-16 text-center"
                            >

                                <div class="mx-auto flex max-w-md flex-col items-center">

                                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 text-slate-400">

                                        <svg
                                            class="h-8 w-8"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M8 7V3m8 4V3m-9 4h10a2 2 0 012 2v11a2 2 0 01-2 2H7a2 2 0 01-2-2V9a2 2 0 012-2zm0 5h10M8 17h3"
                                            />
                                        </svg>

                                    </div>

                                    <h3 class="mt-5 text-base font-semibold text-slate-900">
                                        No reservations yet
                                    </h3>

                                    <p class="mt-2 text-sm leading-6 text-slate-500">
                                        There are currently no bookings associated with your properties.
                                    </p>

                                </div>

                            </td>
                        </tr>

                    @endforelse


                    {{-- Client-side Filter Empty State --}}
                    @if($bookings->count() > 0)

                        <tr
                            x-show="!Array.from($el.parentElement.querySelectorAll('tr[data-booking-row]')).some(row => row.offsetParent !== null)"
                            x-cloak
                            data-filter-empty="true"
                        >
                            <td
                                colspan="7"
                                class="px-6 py-14 text-center"
                            >
                                <div class="flex flex-col items-center">

                                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-400">

                                        <svg
                                            class="h-7 w-7"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                                            />
                                        </svg>

                                    </div>

                                    <h3 class="mt-4 font-semibold text-slate-900">
                                        No matching reservations
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Try changing or resetting your filters.
                                    </p>

                                    <button
                                        type="button"
                                        @click="resetFilters()"
                                        class="mt-4 rounded-xl bg-indigo-50 px-4 py-2 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-100"
                                    >
                                        Reset Filters
                                    </button>

                                </div>
                            </td>
                        </tr>

                    @endif

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- =============================================================
    UPDATE STATUS MODAL
============================================================== --}}
<div
    x-show="showStatusModal"
    x-cloak
    x-transition.opacity
    class="fixed inset-0 z-[60] overflow-y-auto"
    role="dialog"
    aria-modal="true"
    aria-labelledby="status-modal-title"
>

    {{-- Backdrop --}}
    <div
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
        @click="closeStatusModal()"
    ></div>


    <div class="flex min-h-full items-center justify-center p-4 sm:p-6">

        <div
            x-show="showStatusModal"
            x-transition
            @click.stop
            class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl"
        >

            <div class="p-6">

                {{-- Close --}}
                <button
                    type="button"
                    @click="closeStatusModal()"
                    class="absolute right-4 top-4 rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    aria-label="Close modal"
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


                {{-- Dynamic Icon --}}
                <div
                    class="flex h-12 w-12 items-center justify-center rounded-xl"
                    :class="{
                        'bg-emerald-100 text-emerald-600': selectedStatus === 'confirmed',
                        'bg-amber-100 text-amber-600': selectedStatus === 'processing',
                        'bg-rose-100 text-rose-600': selectedStatus === 'cancelled'
                    }"
                >

                    {{-- Confirm Icon --}}
                    <svg
                        x-show="selectedStatus === 'confirmed'"
                        class="h-6 w-6"
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


                    {{-- Processing Icon --}}
                    <svg
                        x-show="selectedStatus === 'processing'"
                        class="h-6 w-6"
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


                    {{-- Cancel Icon --}}
                    <svg
                        x-show="selectedStatus === 'cancelled'"
                        class="h-6 w-6"
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

                </div>


                <h2
                    id="status-modal-title"
                    class="mt-5 text-lg font-bold text-slate-900"
                >
                    Update Booking Status
                </h2>


                {{-- Dynamic Message --}}
                <div class="mt-3">

                    <p
                        x-show="selectedStatus === 'confirmed'"
                        class="text-sm leading-6 text-slate-500"
                    >
                        Confirming this reservation will reserve the apartment for the selected dates.
                    </p>

                    <p
                        x-show="selectedStatus === 'processing'"
                        class="text-sm leading-6 text-slate-500"
                    >
                        This booking will be moved to processing and will remain pending confirmation.
                    </p>

                    <p
                        x-show="selectedStatus === 'cancelled'"
                        class="text-sm leading-6 text-slate-500"
                    >
                        Are you sure you want to cancel this booking?
                    </p>

                </div>


                {{-- Booking Information --}}
                <div class="mt-5 rounded-xl border border-slate-200 bg-slate-50 p-4">

                    <div class="flex items-center justify-between text-sm">

                        <span class="text-slate-500">
                            Booking
                        </span>

                        <span class="font-semibold text-slate-900">
                            #BK-<span x-text="selectedBookingId"></span>
                        </span>

                    </div>

                    <div class="mt-2 flex items-center justify-between text-sm">

                        <span class="text-slate-500">
                            New Status
                        </span>

                        <span
                            class="font-semibold capitalize"
                            :class="{
                                'text-emerald-700': selectedStatus === 'confirmed',
                                'text-amber-700': selectedStatus === 'processing',
                                'text-rose-700': selectedStatus === 'cancelled'
                            }"
                            x-text="selectedStatus"
                        ></span>

                    </div>

                </div>


                {{-- Form --}}
                <form
                    action="{{ route('bookings.update-status','id') }}"
                    method="POST"
                    class="mt-6"
                >

                    @csrf
                    @method('PATCH')

                    <input
                        type="hidden"
                        name="booking_id"
                        :value="selectedBookingId"
                    >

                    <input
                        type="hidden"
                        name="status"
                        :value="selectedStatus"
                    >


                    {{-- Footer --}}
                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                        <button
                            type="button"
                            @click="closeStatusModal()"
                            class="inline-flex justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="inline-flex justify-center rounded-xl px-5 py-2.5 text-sm font-semibold text-white transition focus:outline-none focus:ring-2 focus:ring-offset-2"
                            :class="{
                                'bg-emerald-600 hover:bg-emerald-700 focus:ring-emerald-500': selectedStatus === 'confirmed',
                                'bg-amber-500 hover:bg-amber-600 focus:ring-amber-500': selectedStatus === 'processing',
                                'bg-rose-600 hover:bg-rose-700 focus:ring-rose-500': selectedStatus === 'cancelled'
                            }"
                        >
                            Confirm Status Update
                        </button>

                    </div>

                </form>

            </div>

        </div>

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