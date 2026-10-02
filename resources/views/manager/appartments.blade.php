<x-mdLayout>


<div
    class="min-h-screen bg-slate-50"
    x-data="{
        showAddModal: false,
        showSaveModal: false,
        showDeleteModal: false,


    saveApartment: {
        id: '',
        designation: '',
        building_id: '',
        bedroom: 0,
        bathroom: 0,
        livingroom: 0,
        kitchen: 0,
        balcon: 0,
        price: '',
        available: 'yes'
    },

    deleteApartmentId: '',

    openSaveModal(detail) {
        this.saveApartment = {
            id: detail.id,
            designation: detail.designation,
            building_id: detail.building_id,
            bedroom: detail.bedroom,
            bathroom: detail.bathroom,
            livingroom: detail.livingroom,
            kitchen: detail.kitchen,
            balcon: detail.balcon,
            price: detail.price,
            available: detail.available
        };

        this.showSaveModal = true;
    },

    closeSaveModal() {
        this.showSaveModal = false;

        this.$dispatch('cancel-apartment-edit', {
            id: this.saveApartment.id
        });

        this.saveApartment = {
            id: '',
            designation: '',
            building_id: '',
            bedroom: 0,
            bathroom: 0,
            livingroom: 0,
            kitchen: 0,
            balcon: 0,
            price: '',
            available: 'yes'
        };
    },

    openDeleteModal(id) {
        this.deleteApartmentId = id;
        this.showDeleteModal = true;
    },

    closeDeleteModal() {
        this.showDeleteModal = false;
        this.deleteApartmentId = '';
    }
}"
@open-save-modal.window="openSaveModal($event.detail)"
@open-delete-modal.window="openDeleteModal($event.detail.id)"


>


<div class="mx-auto max-w-[1800px] px-4 py-6 sm:px-6 lg:px-8">


    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                Apartment Management
            </h1>

            <p class="mt-1 max-w-3xl text-sm text-slate-500 sm:text-base">
                Manage listings, update room features, set pricing, or add new units.
            </p>
        </div>

        <button
            type="button"
            @click="showAddModal = true"
            class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
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
                    d="M12 4v16m8-8H4"
                />
            </svg>

            Add Apartment
        </button>
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
                        stroke-linejoin="round"
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
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>

            </div>
        </div>
    @endif


    {{-- =========================================================
        APARTMENTS TABLE
    ========================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Table Header --}}
        <div class="border-b border-slate-200 px-5 py-5 sm:px-6">
            <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        Apartment Listings
                    </h2>

                    <p class="text-sm text-slate-500">
                        {{ $appartments->count() }}
                        {{ $appartments->count() === 1 ? 'apartment' : 'apartments' }}
                        registered.
                    </p>
                </div>

            </div>
        </div>


        {{-- Responsive Table --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[1450px] text-left text-sm">

                <thead class="bg-slate-50">
                    <tr class="border-b border-slate-200">

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            No
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Images
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Designation
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Building
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Room Specs
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Price / Night
                        </th>

                        <th class="px-5 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Availability
                        </th>

                        <th class="px-5 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Actions
                        </th>

                    </tr>
                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($appartments as $appartment)

                        @php
                            $firstImage = $appartment->images->first();
                            $imageCount = $appartment->images->count();
                        @endphp

                        <tr
                            x-data="{
                                isEditing: false,

                                originalDesignation: @js($appartment->appart_designation),
                                originalBuildingId: @js($appartment->building_id),
                                originalBedroom: @js($appartment->bedroom),
                                originalBathroom: @js($appartment->bathroom),
                                originalLivingroom: @js($appartment->livingroom),
                                originalKitchen: @js($appartment->kitchen),
                                originalBalcon: @js($appartment->balcon),
                                originalPrice: @js($appartment->price),
                                originalAvailable: @js($appartment->available),

                                designation: @js($appartment->appart_designation),
                                building_id: @js($appartment->building_id),
                                bedroom: @js($appartment->bedroom),
                                bathroom: @js($appartment->bathroom),
                                livingroom: @js($appartment->livingroom),
                                kitchen: @js($appartment->kitchen),
                                balcon: @js($appartment->balcon),
                                price: @js($appartment->price),
                                available: @js($appartment->available),

                                startEditing() {
                                    this.originalDesignation = this.designation;
                                    this.originalBuildingId = this.building_id;
                                    this.originalBedroom = this.bedroom;
                                    this.originalBathroom = this.bathroom;
                                    this.originalLivingroom = this.livingroom;
                                    this.originalKitchen = this.kitchen;
                                    this.originalBalcon = this.balcon;
                                    this.originalPrice = this.price;
                                    this.originalAvailable = this.available;

                                    this.isEditing = true;
                                },

                                cancelEditing() {
                                    this.designation = this.originalDesignation;
                                    this.building_id = this.originalBuildingId;
                                    this.bedroom = this.originalBedroom;
                                    this.bathroom = this.originalBathroom;
                                    this.livingroom = this.originalLivingroom;
                                    this.kitchen = this.originalKitchen;
                                    this.balcon = this.originalBalcon;
                                    this.price = this.originalPrice;
                                    this.available = this.originalAvailable;

                                    this.isEditing = false;
                                },

                                prepareSave() {
                                    if (!this.designation.trim()) {
                                        return;
                                    }

                                    if (!this.building_id) {
                                        return;
                                    }

                                    this.$dispatch('open-save-modal', {
                                        id: '{{ $appartment->id }}',
                                        designation: this.designation,
                                        building_id: this.building_id,
                                        bedroom: this.bedroom,
                                        bathroom: this.bathroom,
                                        livingroom: this.livingroom,
                                        kitchen: this.kitchen,
                                        balcon: this.balcon,
                                        price: this.price,
                                        available: this.available
                                    });
                                }
                            }"
                            @cancel-apartment-edit.window="
                                if ($event.detail.id == '{{ $appartment->id }}') {
                                    cancelEditing();
                                }
                            "
                            class="transition hover:bg-slate-50"
                        >

                            {{-- Hidden ID --}}
                            <input
                                type="hidden"
                                name="id"
                                value="{{ $appartment->id }}"
                            >


                            {{-- =================================================
                                NUMBER
                            ================================================== --}}
                            <td class="whitespace-nowrap px-5 py-5 align-middle">
                                <span class="font-medium text-slate-500">
                                    {{ $loop->iteration }}
                                </span>
                            </td>


                            {{-- =================================================
                                IMAGE THUMBNAIL
                            ================================================== --}}
                            <td class="px-5 py-5 align-middle">

                                @if($firstImage)

                                    <div class="relative h-16 w-24">

                                        <img
                                            src="{{ asset('storage/' . $firstImage->img) }}"
                                            alt="{{ $appartment->appart_designation }}"
                                            class="h-16 w-24 rounded-xl object-cover ring-1 ring-slate-200"
                                            loading="lazy"
                                        >

                                        @if($imageCount > 1)
                                            <span class="absolute bottom-1 right-1 rounded-md bg-slate-900/80 px-1.5 py-0.5 text-[10px] font-semibold text-white">
                                                +{{ $imageCount - 1 }} photos
                                            </span>
                                        @endif

                                    </div>

                                @else

                                    <div class="flex h-16 w-24 items-center justify-center rounded-xl bg-slate-100 text-slate-400 ring-1 ring-slate-200">
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
                                                d="M4 16l4-4a2 2 0 012.83 0L16 17m-1-1l1.17-1.17a2 2 0 012.83 0L20 15m-2-8h.01M5 20h14a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v14a1 1 0 001 1z"
                                            />
                                        </svg>
                                    </div>

                                @endif

                            </td>


                            {{-- =================================================
                                DESIGNATION
                            ================================================== --}}
                            <td class="px-5 py-5 align-middle">

                                <div x-show="!isEditing">
                                    <p
                                        class="font-semibold text-slate-900"
                                        x-text="designation"
                                    ></p>
                                </div>

                                <div x-show="isEditing" x-cloak>
                                    <label
                                        for="designation-{{ $appartment->id }}"
                                        class="sr-only"
                                    >
                                        Apartment designation
                                    </label>

                                    <input
                                        id="designation-{{ $appartment->id }}"
                                        type="text"
                                        x-model="designation"
                                        required
                                        class="w-48 rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                    >
                                </div>

                            </td>


                            {{-- =================================================
                                BUILDING
                            ================================================== --}}
                            <td class="px-5 py-5 align-middle">

                                <div x-show="!isEditing">
                                    <p class="max-w-xs font-medium text-slate-700">
                                        {{ $appartment->building?->building_name ?? 'No building assigned' }}
                                    </p>
                                </div>

                                <div x-show="isEditing" x-cloak>

                                    <label
                                        for="building-{{ $appartment->id }}"
                                        class="sr-only"
                                    >
                                        Building
                                    </label>

                                    <select
                                        id="building-{{ $appartment->id }}"
                                        x-model="building_id"
                                        class="w-52 rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                        required
                                    >
                                        <option value="">
                                            Select building
                                        </option>

                                        @foreach($buildings as $building)
                                            <option value="{{ $building->id }}">
                                                {{ $building->building_name }}
                                            </option>
                                        @endforeach

                                    </select>

                                </div>

                            </td>


                            {{-- =================================================
                                ROOM SPECS
                            ================================================== --}}
                            <td class="px-5 py-5 align-middle">

                                {{-- Normal View --}}
                                <div
                                    x-show="!isEditing"
                                    class="flex flex-wrap gap-1.5"
                                >

                                    <span class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-2 py-1 text-xs font-medium text-slate-700">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M3 7l3-3h12l3 3M3 7h18" />
                                        </svg>
                                        {{ $appartment->bedroom }} Bed
                                    </span>

                                    <span class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-2 py-1 text-xs font-medium text-slate-700">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 100-4h14a2 2 0 100 4M5 12a2 2 0 100 4h14a2 2 0 100-4" />
                                        </svg>
                                        {{ $appartment->bathroom }} Bath
                                    </span>

                                    <span class="inline-flex items-center rounded-lg bg-slate-100 px-2 py-1 text-xs font-medium text-slate-700">
                                        Living {{ $appartment->livingroom }}
                                    </span>

                                    <span class="inline-flex items-center rounded-lg bg-slate-100 px-2 py-1 text-xs font-medium text-slate-700">
                                        Kitchen {{ $appartment->kitchen }}
                                    </span>

                                    <span class="inline-flex items-center rounded-lg bg-slate-100 px-2 py-1 text-xs font-medium text-slate-700">
                                        Balcony {{ $appartment->balcon }}
                                    </span>

                                </div>


                                {{-- Editing View --}}
                                <div
                                    x-show="isEditing"
                                    x-cloak
                                    class="grid w-[340px] grid-cols-5 gap-2"
                                >

                                    <div>
                                        <label class="mb-1 block text-[10px] font-semibold uppercase text-slate-500">
                                            Beds
                                        </label>

                                        <input
                                            type="number"
                                            min="0"
                                            x-model.number="bedroom"
                                            class="w-full rounded-lg border border-slate-300 px-2 py-2 text-xs outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                        >
                                    </div>

                                    <div>
                                        <label class="mb-1 block text-[10px] font-semibold uppercase text-slate-500">
                                            Baths
                                        </label>

                                        <input
                                            type="number"
                                            min="0"
                                            x-model.number="bathroom"
                                            class="w-full rounded-lg border border-slate-300 px-2 py-2 text-xs outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                        >
                                    </div>

                                    <div>
                                        <label class="mb-1 block text-[10px] font-semibold uppercase text-slate-500">
                                            Living
                                        </label>

                                        <input
                                            type="number"
                                            min="0"
                                            x-model.number="livingroom"
                                            class="w-full rounded-lg border border-slate-300 px-2 py-2 text-xs outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                        >
                                    </div>

                                    <div>
                                        <label class="mb-1 block text-[10px] font-semibold uppercase text-slate-500">
                                            Kitchen
                                        </label>

                                        <input
                                            type="number"
                                            min="0"
                                            x-model.number="kitchen"
                                            class="w-full rounded-lg border border-slate-300 px-2 py-2 text-xs outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                        >
                                    </div>

                                    <div>
                                        <label class="mb-1 block text-[10px] font-semibold uppercase text-slate-500">
                                            Balcony
                                        </label>

                                        <input
                                            type="number"
                                            min="0"
                                            x-model.number="balcon"
                                            class="w-full rounded-lg border border-slate-300 px-2 py-2 text-xs outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                        >
                                    </div>

                                </div>

                            </td>


                            {{-- =================================================
                                PRICE
                            ================================================== --}}
                            <td class="px-5 py-5 align-middle">

                                <div x-show="!isEditing">
                                    <span class="font-semibold text-slate-900">
                                        ${{ number_format((float) $appartment->price, 2) }}
                                    </span>

                                    <span class="text-xs text-slate-400">
                                        / night
                                    </span>
                                </div>

                                <div x-show="isEditing" x-cloak>

                                    <label
                                        for="price-{{ $appartment->id }}"
                                        class="sr-only"
                                    >
                                        Price per night
                                    </label>

                                    <div class="relative w-32">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-medium text-slate-400">
                                            $
                                        </span>

                                        <input
                                            id="price-{{ $appartment->id }}"
                                            type="number"
                                            min="0"
                                            step="0.01"
                                            x-model="price"
                                            required
                                            class="w-full rounded-xl border border-slate-300 bg-white py-2 pl-7 pr-2 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                        >
                                    </div>

                                </div>

                            </td>


                            {{-- =================================================
                                AVAILABILITY
                            ================================================== --}}
                            <td class="px-5 py-5 align-middle">

                                <div x-show="!isEditing">

                                    <span
                                        @class([
                                            'inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold',
                                            'bg-emerald-100 text-emerald-800' => strtolower($appartment->available) === 'yes',
                                            'bg-rose-100 text-rose-800' => strtolower($appartment->available) !== 'yes',
                                        ])
                                    >
                                        {{ strtolower($appartment->available) === 'yes' ? 'Available' : 'Occupied' }}
                                    </span>

                                </div>

                                <div x-show="isEditing" x-cloak>

                                    <label
                                        for="available-{{ $appartment->id }}"
                                        class="sr-only"
                                    >
                                        Availability
                                    </label>

                                    <select
                                        id="available-{{ $appartment->id }}"
                                        x-model="available"
                                        class="w-32 rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                    >
                                        <option value="yes">
                                            Yes / Available
                                        </option>

                                        <option value="no">
                                            No / Occupied
                                        </option>
                                    </select>

                                </div>

                            </td>


                            {{-- =================================================
                                ACTIONS
                            ================================================== --}}
                            <td class="px-5 py-5 align-middle">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- Edit --}}
                                    <button
                                        type="button"
                                        @click="startEditing()"
                                        :disabled="isEditing"
                                        :class="isEditing
                                            ? 'cursor-not-allowed bg-slate-100 text-slate-400'
                                            : 'bg-indigo-50 text-indigo-700 hover:bg-indigo-100'"
                                        class="inline-flex items-center gap-1.5 rounded-lg px-3 py-2 text-xs font-semibold transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1"
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
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 013 3L12 14l-4 1 1-4 7.5-7.5z"
                                            />
                                        </svg>

                                        Edit
                                    </button>


                                    {{-- Save --}}
                                    <button
                                        type="button"
                                        @click="prepareSave()"
                                        :disabled="!isEditing"
                                        :class="!isEditing
                                            ? 'cursor-not-allowed bg-slate-100 text-slate-400'
                                            : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100'"
                                        class="inline-flex items-center gap-1.5 rounded-lg px-3 py-2 text-xs font-semibold transition focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-1"
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

                                        Save
                                    </button>


                                    {{-- Delete --}}
                                    <button
                                        type="button"
                                        @click="$dispatch('open-delete-modal', {
                                            id: '{{ $appartment->id }}'
                                        })"
                                        class="inline-flex items-center gap-1.5 rounded-lg bg-rose-50 px-3 py-2 text-xs font-semibold text-rose-700 transition hover:bg-rose-100 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-1"
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
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"
                                            />
                                        </svg>

                                        Delete
                                    </button>

                                </div>

                            </td>

                        </tr>

                    @empty

                        {{-- Empty State --}}
                        <tr>
                            <td
                                colspan="8"
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
                                                d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5M9 9h.01M15 9h.01M9 12h.01M15 12h.01"
                                            />
                                        </svg>
                                    </div>

                                    <h3 class="mt-5 text-base font-semibold text-slate-900">
                                        No apartments registered
                                    </h3>

                                    <p class="mt-2 text-sm leading-6 text-slate-500">
                                        You have not added any apartment listings yet. Add your first apartment to start managing your units.
                                    </p>

                                    <button
                                        type="button"
                                        @click="showAddModal = true"
                                        class="mt-5 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
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
                                                d="M12 4v16m8-8H4"
                                            />
                                        </svg>

                                        Add Apartment
                                    </button>

                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>
</div>


{{-- =============================================================
    ADD APARTMENT MODAL
============================================================== --}}
<div
    x-show="showAddModal"
    x-cloak
    x-transition.opacity
    class="fixed inset-0 z-50 overflow-y-auto"
    role="dialog"
    aria-modal="true"
    aria-labelledby="add-apartment-title"
    @keydown.escape.window="showAddModal = false"
>

    <div
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
        @click="showAddModal = false"
    ></div>

    <div class="flex min-h-full items-center justify-center p-4 sm:p-6">

        <div
            x-show="showAddModal"
            x-transition
            @click.stop
            class="relative w-full max-w-3xl overflow-hidden rounded-2xl bg-white shadow-2xl"
        >

            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">

                <div>
                    <h2
                        id="add-apartment-title"
                        class="text-lg font-bold text-slate-900"
                    >
                        Add Apartment
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Create a new apartment listing and configure its features.
                    </p>
                </div>

                <button
                    type="button"
                    @click="showAddModal = false"
                    class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500"
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

            </div>


            {{-- Form --}}
            <form
                action="{{ route('appartments.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf

                <div class="max-h-[70vh] overflow-y-auto px-6 py-6">

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                        {{-- Designation --}}
                        <div class="sm:col-span-2">
                            <label
                                for="add_appart_designation"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Apartment Designation
                            </label>

                            <input
                                id="add_appart_designation"
                                name="appart_designation"
                                type="text"
                                value="{{ old('appart_designation') }}"
                                required
                                placeholder="e.g. Deluxe Apartment A"
                                class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder-slate-400 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                            >
                        </div>


                        {{-- Building --}}
                        <div class="sm:col-span-2">
                            <label
                                for="add_building_id"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Building
                            </label>

                            <select
                                id="add_building_id"
                                name="building_id"
                                required
                                class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                            >
                                <option value="">
                                    Select a building
                                </option>

                                @foreach($buildings as $building)
                                    <option
                                        value="{{ $building->id }}"
                                        @selected(old('building_id') == $building->id)
                                    >
                                        {{ $building->building_name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>


                        {{-- Bedroom --}}
                        <div>
                            <label
                                for="add_bedroom"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Bedrooms
                            </label>

                            <input
                                id="add_bedroom"
                                name="bedroom"
                                type="number"
                                min="0"
                                value="{{ old('bedroom', 0) }}"
                                required
                                class="block w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                            >
                        </div>


                        {{-- Bathroom --}}
                        <div>
                            <label
                                for="add_bathroom"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Bathrooms
                            </label>

                            <input
                                id="add_bathroom"
                                name="bathroom"
                                type="number"
                                min="0"
                                value="{{ old('bathroom', 0) }}"
                                required
                                class="block w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                            >
                        </div>


                        {{-- Living Room --}}
                        <div>
                            <label
                                for="add_livingroom"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Living Rooms
                            </label>

                            <input
                                id="add_livingroom"
                                name="livingroom"
                                type="number"
                                min="0"
                                value="{{ old('livingroom', 0) }}"
                                required
                                class="block w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                            >
                        </div>


                        {{-- Kitchen --}}
                        <div>
                            <label
                                for="add_kitchen"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Kitchens
                            </label>

                            <input
                                id="add_kitchen"
                                name="kitchen"
                                type="number"
                                min="0"
                                value="{{ old('kitchen', 0) }}"
                                required
                                class="block w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                            >
                        </div>


                        {{-- Balcony --}}
                        <div>
                            <label
                                for="add_balcon"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Balconies
                            </label>

                            <input
                                id="add_balcon"
                                name="balcon"
                                type="number"
                                min="0"
                                value="{{ old('balcon', 0) }}"
                                required
                                class="block w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                            >
                        </div>


                        {{-- Price --}}
                        <div>
                            <label
                                for="add_price"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Price / Night
                            </label>

                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-medium text-slate-400">
                                    $
                                </span>

                                <input
                                    id="add_price"
                                    name="price"
                                    type="number"
                                    min="0"
                                    step="0.01"
                                    value="{{ old('price') }}"
                                    required
                                    placeholder="0.00"
                                    class="block w-full rounded-xl border border-slate-300 py-3 pl-8 pr-4 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                >
                            </div>
                        </div>


                        {{-- Availability --}}
                        <div>
                            <label
                                for="add_available"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Availability
                            </label>

                            <select
                                id="add_available"
                                name="available"
                                required
                                class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                            >
                                <option value="yes" @selected(old('available', 'yes') === 'yes')}>
                                    Yes / Available
                                </option>

                                <option value="no" @selected(old('available') === 'no')}>
                                    No / Occupied
                                </option>
                            </select>
                        </div>


                        {{-- Images --}}
                        <div class="sm:col-span-2">
                            <label
                                for="add_images"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Apartment Photos
                            </label>

                            <input
                                id="add_images"
                                name="img[]"
                                type="file"
                                accept="image/*"
                                multiple
                                class="block w-full cursor-pointer rounded-xl border border-slate-300 bg-white text-sm text-slate-600 file:mr-4 file:border-0 file:bg-slate-100 file:px-4 file:py-3 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-200 focus:outline-none"
                            >

                            <p class="mt-1.5 text-xs text-slate-400">
                                You can select multiple photos for this apartment.
                            </p>
                        </div>

                    </div>

                </div>


                {{-- Footer --}}
                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:flex-row sm:justify-end">

                    <button
                        type="button"
                        @click="showAddModal = false"
                        class="inline-flex justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
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
                                d="M12 4v16m8-8H4"
                            />
                        </svg>

                        Add Apartment
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>


{{-- =============================================================
    SAVE CONFIRMATION MODAL
============================================================== --}}
<div
    x-show="showSaveModal"
    x-cloak
    x-transition.opacity
    class="fixed inset-0 z-[60] overflow-y-auto"
    role="dialog"
    aria-modal="true"
    aria-labelledby="save-apartment-title"
    @keydown.escape.window="closeSaveModal()"
>

    <div
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
        @click="closeSaveModal()"
    ></div>

    <div class="flex min-h-full items-center justify-center p-4 sm:p-6">

        <div
            x-show="showSaveModal"
            x-transition
            @click.stop
            class="relative w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl"
        >

            <div class="p-6">

                {{-- Close --}}
                <button
                    type="button"
                    @click="closeSaveModal()"
                    class="absolute right-4 top-4 rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
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
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>


                {{-- Icon --}}
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
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


                <h2
                    id="save-apartment-title"
                    class="mt-5 text-lg font-bold text-slate-900"
                >
                    Save Apartment Changes
                </h2>

                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Are you sure you want to save the changes for this apartment listing?
                </p>


                <form
                    :action="'/appartments/' + saveApartment.id"
                    method="POST"
                    enctype="multipart/form-data"
                    class="mt-6"
                >
                    @csrf
                    @method('PUT')

                    {{-- Hidden Updated Fields --}}
                    <input
                        type="hidden"
                        name="id"
                        :value="saveApartment.id"
                    >

                    <input
                        type="hidden"
                        name="appart_designation"
                        :value="saveApartment.designation"
                    >

                    <input
                        type="hidden"
                        name="building_id"
                        :value="saveApartment.building_id"
                    >

                    <input
                        type="hidden"
                        name="bedroom"
                        :value="saveApartment.bedroom"
                    >

                    <input
                        type="hidden"
                        name="bathroom"
                        :value="saveApartment.bathroom"
                    >

                    <input
                        type="hidden"
                        name="livingroom"
                        :value="saveApartment.livingroom"
                    >

                    <input
                        type="hidden"
                        name="kitchen"
                        :value="saveApartment.kitchen"
                    >

                    <input
                        type="hidden"
                        name="balcon"
                        :value="saveApartment.balcon"
                    >

                    <input
                        type="hidden"
                        name="price"
                        :value="saveApartment.price"
                    >

                    <input
                        type="hidden"
                        name="available"
                        :value="saveApartment.available"
                    >


                    {{-- Image Replacement / Additional Images --}}
                    <div class="mb-6 rounded-xl border border-slate-200 bg-slate-50 p-4">

                        <label
                            for="edit_images"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Replace / Add Photos
                        </label>

                        <input
                            id="edit_images"
                            name="img[]"
                            type="file"
                            accept="image/*"
                            multiple
                            class="block w-full cursor-pointer rounded-xl border border-slate-300 bg-white text-sm text-slate-600 file:mr-4 file:border-0 file:bg-slate-100 file:px-4 file:py-3 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-200 focus:outline-none"
                        >

                        <p class="mt-1.5 text-xs text-slate-400">
                            Optional. Select new or additional apartment photos.
                        </p>

                    </div>


                    {{-- Summary --}}
                    <div class="mb-6 rounded-xl border border-slate-200 bg-white p-4">

                        <div class="grid grid-cols-2 gap-4 text-sm">

                            <div>
                                <span class="block text-xs text-slate-400">
                                    Apartment
                                </span>

                                <span
                                    class="font-semibold text-slate-800"
                                    x-text="saveApartment.designation"
                                ></span>
                            </div>

                            <div>
                                <span class="block text-xs text-slate-400">
                                    Price / Night
                                </span>

                                <span class="font-semibold text-slate-800">
                                    $<span x-text="Number(saveApartment.price || 0).toFixed(2)"></span>
                                </span>
                            </div>

                            <div>
                                <span class="block text-xs text-slate-400">
                                    Bedrooms
                                </span>

                                <span
                                    class="font-semibold text-slate-800"
                                    x-text="saveApartment.bedroom"
                                ></span>
                            </div>

                            <div>
                                <span class="block text-xs text-slate-400">
                                    Bathrooms
                                </span>

                                <span
                                    class="font-semibold text-slate-800"
                                    x-text="saveApartment.bathroom"
                                ></span>
                            </div>

                        </div>

                    </div>


                    {{-- Footer --}}
                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                        <button
                            type="button"
                            @click="closeSaveModal()"
                            class="inline-flex justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="inline-flex justify-center rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                        >
                            Confirm & Save
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>


{{-- =============================================================
    DELETE CONFIRMATION MODAL
============================================================== --}}
<div
    x-show="showDeleteModal"
    x-cloak
    x-transition.opacity
    class="fixed inset-0 z-[60] overflow-y-auto"
    role="dialog"
    aria-modal="true"
    aria-labelledby="delete-apartment-title"
    @keydown.escape.window="closeDeleteModal()"
>

    <div
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
        @click="closeDeleteModal()"
    ></div>

    <div class="flex min-h-full items-center justify-center p-4 sm:p-6">

        <div
            x-show="showDeleteModal"
            x-transition
            @click.stop
            class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl"
        >

            <div class="p-6">

                {{-- Close --}}
                <button
                    type="button"
                    @click="closeDeleteModal()"
                    class="absolute right-4 top-4 rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
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


                {{-- Warning Icon --}}
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-rose-100 text-rose-600">
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
                            d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 2.98h15.58a2 2 0 001.74-2.98l-7.82-14a2 2 0 00-3.42 0z"
                        />
                    </svg>
                </div>


                <h2
                    id="delete-apartment-title"
                    class="mt-5 text-lg font-bold text-slate-900"
                >
                    Delete Apartment
                </h2>

                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Are you sure you want to delete this apartment?
                    All associated booking history and reviews will be permanently removed.
                </p>


                <form
                    :action="'/appartments/' + deleteApartmentId"
                    method="POST"
                    class="mt-6"
                >
                    @csrf
                    @method('DELETE')

                    <input
                        type="hidden"
                        name="id"
                        :value="deleteApartmentId"
                    >


                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                        <button
                            type="button"
                            @click="closeDeleteModal()"
                            class="inline-flex justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="inline-flex justify-center rounded-xl bg-rose-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2"
                        >
                            Confirm Delete
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