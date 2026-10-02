<x-mdLayout>

<div
    class="min-h-screen bg-slate-50"
    x-data="{
        // Only open Add Modal for validation errors, old inputs, OR creation success
        showAddModal: {{ session('success_add') || (old('form_type') === 'add' && ($errors->any() || old('building_name'))) ? 'true' : 'false' }},
        showSaveModal: false,
        showDeleteModal: false,

        saveBuilding: {
            id: '',
            name: '',
            address: ''
        },

        deleteBuildingId: '',

        openSaveModal(id, name, address) {
            this.saveBuilding = { id: id, name: name, address: address };
            this.showSaveModal = true;
        },

        openDeleteModal(id) {
            this.deleteBuildingId = id;
            this.showDeleteModal = true;
        }
    }"
    @open-save-modal.window="openSaveModal($event.detail.id, $event.detail.name, $event.detail.address)"
    @open-delete-modal.window="openDeleteModal($event.detail.id)"
>

<div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                Building Management
            </h1>

            <p class="mt-1 max-w-2xl text-sm text-slate-500 sm:text-base">
                Manage your registered property buildings, add new locations, or update existing details.
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
                aria-hidden="true"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4"
                />
            </svg>

            Add Building
        </button>
    </div>

    {{-- =========================================================
        SESSION SUCCESS ALERT
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
                    aria-hidden="true"
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
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        SESSION / VALIDATION ERROR ALERT
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
                        aria-hidden="true"
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
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        BUILDINGS TABLE
    ========================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Table Header --}}
        <div class="border-b border-slate-200 px-5 py-5 sm:px-6">
            <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        Registered Buildings
                    </h2>

                    <p class="text-sm text-slate-500">
                        {{ $buildings->count() }} {{ $buildings->count() === 1 ? 'building' : 'buildings' }} registered.
                    </p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[850px] text-left text-sm">
                <thead class="bg-slate-50">
                    <tr class="border-b border-slate-200">
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            No
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Image
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Building Name
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Address
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($buildings as $building)

                        <tr
                            x-data="{
                                isEditing: false,

                                originalName: @js($building->building_name),
                                originalAddress: @js($building->address),

                                name: @js($building->building_name),
                                address: @js($building->address),

                                startEditing() {
                                    this.originalName = this.name;
                                    this.originalAddress = this.address;
                                    this.isEditing = true;
                                },

                                cancelEditing() {
                                    this.name = this.originalName;
                                    this.address = this.originalAddress;
                                    this.isEditing = false;
                                },

                                prepareSave() {
                                    if (!this.name.trim() || !this.address.trim()) {
                                        return;
                                    }

                                    $dispatch('open-save-modal', {
                                        id: '{{ $building->id }}',
                                        name: this.name,
                                        address: this.address
                                    });
                                }
                            }"
                            class="transition hover:bg-slate-50"
                        >
                            {{-- Hidden ID --}}
                            <input
                                type="hidden"
                                name="id"
                                value="{{ $building->id }}"
                            >

                            {{-- No --}}
                            <td class="whitespace-nowrap px-6 py-5 align-middle">
                                <span class="font-medium text-slate-500">
                                    {{ $loop->iteration }}
                                </span>
                            </td>

                            {{-- Image --}}
                            <td class="px-6 py-5 align-middle">
                                @if($building->image)
                                    <img
                                        src="{{ asset('storage/' . $building->image) }}"
                                        alt="{{ $building->building_name }}"
                                        class="h-14 w-20 rounded-xl object-cover ring-1 ring-slate-200"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="flex h-14 w-20 items-center justify-center rounded-xl bg-slate-100 text-slate-400 ring-1 ring-slate-200">
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
                                                stroke-width="1.5"
                                                d="M4 16l4-4a2 2 0 012.83 0L16 17m-1-1l1.17-1.17a2 2 0 012.83 0L20 15m-2-8h.01M5 20h14a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v14a1 1 0 001 1z"
                                            />
                                        </svg>
                                    </div>
                                @endif
                            </td>

                            {{-- Building Name --}}
                            <td class="px-6 py-5 align-middle">
                                <div x-show="!isEditing">
                                    <p class="font-semibold text-slate-900" x-text="name"></p>
                                </div>

                                <div x-show="isEditing" x-cloak>
                                    <label class="sr-only" for="building-name-{{ $building->id }}">
                                        Building Name
                                    </label>

                                    <input
                                        id="building-name-{{ $building->id }}"
                                        type="text"
                                        x-model="name"
                                        class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                        required
                                    >
                                </div>
                            </td>

                            {{-- Address --}}
                            <td class="px-6 py-5 align-middle">
                                <div x-show="!isEditing">
                                    <p class="max-w-sm text-slate-600" x-text="address"></p>
                                </div>

                                <div x-show="isEditing" x-cloak>
                                    <label class="sr-only" for="building-address-{{ $building->id }}">
                                        Building Address
                                    </label>

                                    <input
                                        id="building-address-{{ $building->id }}"
                                        type="text"
                                        x-model="address"
                                        class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                        required
                                    >
                                </div>
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-5 align-middle">
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
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                        @click="$dispatch('open-delete-modal', { id: '{{ $building->id }}' })"
                                        class="inline-flex items-center gap-1.5 rounded-lg bg-rose-50 px-3 py-2 text-xs font-semibold text-rose-700 transition hover:bg-rose-100 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-1"
                                    >
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="mx-auto flex max-w-md flex-col items-center">
                                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                        <svg
                                            class="h-8 w-8"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            aria-hidden="true"
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
                                        No buildings registered
                                    </h3>

                                    <p class="mt-2 text-sm leading-6 text-slate-500">
                                        You have not added any property buildings yet. Add your first building to start managing your properties.
                                    </p>

                                    <button
                                        type="button"
                                        @click="showAddModal = true"
                                        class="mt-5 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
                                    >
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 4v16m8-8H4"
                                            />
                                        </svg>

                                        Add Building
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
    ADD BUILDING MODAL
============================================================== --}}
<div
    x-show="showAddModal"
    x-cloak
    x-transition.opacity
    class="fixed inset-0 z-50 overflow-y-auto"
    role="dialog"
    aria-modal="true"
    aria-labelledby="add-building-title"
    @keydown.escape.window="showAddModal = false"
>
    {{-- Backdrop --}}
    <div
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
        @click="showAddModal = false"
    ></div>

    <div class="flex min-h-full items-center justify-center p-4 sm:p-6">
        <div
            x-show="showAddModal"
            x-transition
            @click.stop
            class="relative w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl"
        >
            {{-- Modal Header --}}
            <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">
                <div>
                    <h2 id="add-building-title" class="text-lg font-bold text-slate-900">
                        Add Building
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Register a new property building.
                    </p>
                </div>

                <button
                    type="button"
                    @click="showAddModal = false"
                    class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    aria-label="Close modal"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>

            {{-- Form --}}
            <form
                action="{{ route('buildings.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                {{-- Error Alert inside Modal --}}
                @if(session('error') && (old('building_name') || old('address')))
                    <div class="rounded-xl border border-rose-200 bg-rose-50 p-3 text-xs text-rose-700">
                        {{ session('error') }}
                    </div>
                @endif
                {{-- Success Alert Inside Modal --}}
                @if(session('success'))
                    <div
                        x-data="{ show: true }"
                        x-show="show"
                        role="alert"
                        class="flex items-center justify-between gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800"
                    >
                        <div class="flex items-center gap-3">
                            <svg class="h-5 w-5 shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <p class="text-sm font-medium">
                                {{ session('success') }}
                            </p>
                        </div>

                        <button
                            type="button"
                            @click="show = false"
                            class="rounded-lg p-1 text-emerald-600 transition hover:bg-emerald-100"
                            aria-label="Dismiss message"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endif
                <input type="hidden" name="form_type" value="add">

                <div class="space-y-5 px-6 py-6">

                    {{-- Building Name --}}
                    <div>
                        <label
                            for="building_name"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Building Name
                        </label>

                        <input
                            id="building_name"
                            name="building_name"
                            type="text"
                            value="{{ old('building_name') }}"
                            required
                            placeholder="e.g. Kigali Heights"
                            class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder-slate-400 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                        >

                        @error('building_name')
                            <p class="mt-1.5 text-xs text-rose-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div>
                        <label
                            for="address"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Address
                        </label>

                        <input
                            id="address"
                            name="address"
                            type="text"
                            value="{{ old('address') }}"
                            required
                            placeholder="e.g. KG 7 Avenue, Kigali"
                            class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder-slate-400 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                        >

                        @error('address')
                            <p class="mt-1.5 text-xs text-rose-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Image --}}
                    <div>
                        <label
                            for="building_image"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Building Photo
                        </label>

                        <input
                            id="building_image"
                            name="image"
                            type="file"
                            accept="image/*"
                            class="block w-full cursor-pointer rounded-xl border border-slate-300 bg-white text-sm text-slate-600 file:mr-4 file:border-0 file:bg-slate-100 file:px-4 file:py-3 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-200 focus:outline-none"
                        >

                        <p class="mt-1.5 text-xs text-slate-400">
                            Upload a clear photo of the building.
                        </p>

                        @error('image')
                            <p class="mt-1.5 text-xs text-rose-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:flex-row sm:justify-end">
                    <button
                        type="button"
                        @click="showAddModal = false"
                        class="inline-flex justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 4v16m8-8H4"
                            />
                        </svg>

                        Add Building
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
    aria-labelledby="save-building-title"
    @keydown.escape.window="showSaveModal = false"
>
    {{-- Backdrop --}}
    <div
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
        @click="showSaveModal = false"
    ></div>

    <div class="flex min-h-full items-center justify-center p-4 sm:p-6">
        <div
            x-show="showSaveModal"
            x-transition
            @click.stop
            class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl"
        >
            <div class="p-6">

                {{-- Icon --}}
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>
                </div>

                <div class="mt-5 flex items-start justify-between gap-4">
                    <div>
                        <h2 id="save-building-title" class="text-lg font-bold text-slate-900">
                            Save Changes
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Are you sure you want to save the changes for this building?
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="showSaveModal = false"
                        class="rounded-lg p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
                        aria-label="Close modal"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>

                {{-- Update Form --}}
                <form
                    :action="'/buildings/' + saveBuilding.id"
                    method="POST"
                    class="mt-6"
                >
                    @csrf
                    @method('PUT')

                    <input
                        type="hidden"
                        name="id"
                        :value="saveBuilding.id"
                    >

                    <input
                        type="hidden"
                        name="building_name"
                        :value="saveBuilding.name"
                    >

                    <input
                        type="hidden"
                        name="address"
                        :value="saveBuilding.address"
                    >

                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                        <button
                            type="button"
                            @click="showSaveModal = false"
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
    aria-labelledby="delete-building-title"
    @keydown.escape.window="showDeleteModal = false"
>
    {{-- Backdrop --}}
    <div
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
        @click="showDeleteModal = false"
    ></div>

    <div class="flex min-h-full items-center justify-center p-4 sm:p-6">
        <div
            x-show="showDeleteModal"
            x-transition
            @click.stop
            class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl"
        >
            <div class="p-6">

                {{-- Icon --}}
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-rose-100 text-rose-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 2.98h15.58a2 2 0 001.74-2.98l-7.82-14a2 2 0 00-3.42 0z"
                        />
                    </svg>
                </div>

                <div class="mt-5 flex items-start justify-between gap-4">
                    <div>
                        <h2 id="delete-building-title" class="text-lg font-bold text-slate-900">
                            Delete Building
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Are you sure you want to delete this building? This action cannot be undone.
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="showDeleteModal = false"
                        class="rounded-lg p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
                        aria-label="Close modal"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>

                {{-- Delete Form --}}
                <form
                    :action="'/buildings/' + deleteBuildingId"
                    method="POST"
                    class="mt-6"
                >
                    @csrf
                    @method('DELETE')

                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                        <button
                            type="button"
                            @click="showDeleteModal = false"
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

</div>

{{-- Prevent Alpine-controlled elements from flashing before Alpine initializes --}}
<style>
    [x-cloak] {
        display: none !important;
    }
</style>

</x-mdLayout>