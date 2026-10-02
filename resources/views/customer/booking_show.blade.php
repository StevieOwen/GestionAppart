<x-customerLayout>
   
    <div x-data="{ activeTab: 'all', cancelModalOpen: false, selectedBookingId: null }" class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">My Reservations</h1>
                    <p class="mt-1 text-sm text-slate-500">View and manage all your apartment booking requests and history.</p>
                </div>
                
                <a href="{{ route('/') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Book Another Apartment
                </a>
            </div>

            {{-- Session Feedback Alerts --}}
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" class="mb-6 flex items-center justify-between rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                    <div class="flex items-center gap-3">
                        <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                    <button type="button" @click="show = false" class="text-emerald-600 hover:text-emerald-800">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div x-data="{ show: true }" x-show="show" class="mb-6 flex items-center justify-between rounded-xl border border-rose-200 bg-rose-50 p-4 text-rose-800">
                    <div class="flex items-center gap-3">
                        <svg class="h-5 w-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                    <button type="button" @click="show = false" class="text-rose-600 hover:text-rose-800">&times;</button>
                </div>
            @endif

            {{-- Navigation Filter Tabs --}}
            <div class="mb-6 border-b border-slate-200">
                <nav class="-mb-px flex space-x-6 overflow-x-auto">
                    <button @click="activeTab = 'all'" :class="activeTab === 'all' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-700'" class="whitespace-nowrap border-b-2 py-4 px-1 text-sm font-semibold transition">
                        All Bookings ({{ $allBookings->count() }})
                    </button>

                    <button @click="activeTab = 'processing'" :class="activeTab === 'processing' ? 'border-amber-500 text-amber-600' : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-700'" class="flex items-center gap-2 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-semibold transition">
                        Processing 
                        <span class="rounded-full bg-amber-100 px-2 py-0.5 text-xs font-bold text-amber-700">{{ $processingBookings->count() }}</span>
                    </button>

                    <button @click="activeTab = 'confirmed'" :class="activeTab === 'confirmed' ? 'border-emerald-600 text-emerald-600' : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-700'" class="flex items-center gap-2 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-semibold transition">
                        Confirmed
                        <span class="rounded-full bg-emerald-100 px-2 py-0.5 text-xs font-bold text-emerald-700">{{ $confirmedBookings->count() }}</span>
                    </button>

                    <button @click="activeTab = 'cancelled'" :class="activeTab === 'cancelled' ? 'border-rose-600 text-rose-600' : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-700'" class="flex items-center gap-2 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-semibold transition">
                        Cancelled
                        <span class="rounded-full bg-slate-100 px-2 py-0.5 text-xs font-bold text-slate-600">{{ $cancelledBookings->count() }}</span>
                    </button>
                </nav>
            </div>

            {{-- Bookings Table Container --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/75 text-xs font-bold uppercase tracking-wider text-slate-500">
                                <th scope="col" class="py-4 px-6">Apartment & Location</th>
                                <th scope="col" class="py-4 px-6">Check-In / Check-Out</th>
                                <th scope="col" class="py-4 px-6">Duration</th>
                                <th scope="col" class="py-4 px-6">Total Amount</th>
                                <th scope="col" class="py-4 px-6">Status</th>
                                <th scope="col" class="py-4 px-6 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm font-medium text-slate-700">
                            
                            {{-- Macro-like iteration helper --}}
                            @php
                                $tabGroups = [
                                    'all' => $allBookings,
                                    'processing' => $processingBookings,
                                    'confirmed' => $confirmedBookings,
                                    'cancelled' => $cancelledBookings,
                                ];
                            @endphp

                            @foreach($tabGroups as $tabKey => $bookingList)
                                @forelse($bookingList as $booking)
                                    <tr x-show="activeTab === '{{ $tabKey }}'" class="transition hover:bg-slate-50/50">
                                        
                                        {{-- Apartment Designation & Building --}}
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-4">
                                                @if($booking->appartment->images->first())
                                                    <img src="{{ asset('storage/' . $booking->appartment->images->first()->img) }}" alt="Apartment" class="h-12 w-14 rounded-lg object-cover shadow-sm">
                                                @else
                                                    <div class="flex h-12 w-14 items-center justify-center rounded-lg bg-slate-100 text-slate-400">
                                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                                    </div>
                                                @endif
                                                <div>
                                                    <p class="font-bold text-slate-900">{{ $booking->appartment->appart_designation }}</p>
                                                    <p class="text-xs text-slate-500">{{ $booking->appartment->building->building_name ?? 'N/A' }} • {{ $booking->appartment->building->address ?? '' }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Dates --}}
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            <div class="text-slate-900 font-semibold">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</div>
                                            <div class="text-xs text-slate-400">to {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</div>
                                        </td>

                                        {{-- Duration --}}
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            <span class="inline-flex items-center rounded-md bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                                {{ $booking->number_days }} {{ Str::plural('night', $booking->number_days) }}
                                            </span>
                                        </td>

                                        {{-- Price --}}
                                        <td class="py-4 px-6 whitespace-nowrap font-bold text-slate-900">
                                           {{\Illuminate\Support\Number::currency($booking->price, 'USD')}}
                                        </td>

                                        {{-- Status Badge --}}
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            @if($booking->status === 'processing')
                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-700 border border-amber-200">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                                    Processing
                                                </span>
                                            @elseif($booking->status === 'confirmed')
                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700 border border-emerald-200">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                    Confirmed
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-3 py-1 text-xs font-bold text-rose-700 border border-rose-200">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                                    Cancelled
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Action Column --}}
                                        <td class="py-4 px-6 text-right whitespace-nowrap">
                                            @if($booking->status === 'processing')
                                                <button 
                                                    type="button" 
                                                    @click="selectedBookingId = {{ $booking->id }}; cancelModalOpen = true"
                                                    class="inline-flex items-center gap-1.5 rounded-xl border border-rose-200 bg-rose-50 px-3 py-1.5 text-xs font-bold text-rose-700 transition hover:bg-rose-100 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-1">
                                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                                    Cancel
                                                </button>
                                            @else
                                                <span class="text-xs text-slate-400 italic">No actions available</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr x-show="activeTab === '{{ $tabKey }}'">
                                        <td colspan="6" class="py-12 text-center text-slate-400">
                                            <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 4h10M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"/></svg>
                                            <p class="mt-2 text-sm font-semibold text-slate-600">No {{ $tabKey === 'all' ? '' : $tabKey }} reservations found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        {{-- Cancellation Confirmation Modal --}}
        <div x-show="cancelModalOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                
                {{-- Backdrop --}}
                <div x-show="cancelModalOpen" x-transition.opacity @click="cancelModalOpen = false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

                {{-- Modal Box --}}
                <div x-show="cancelModalOpen" x-transition class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <form action="{{ route('customers.cancel-booking') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <input type="hidden" name="booking_id" :value="selectedBookingId">

                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-rose-100 text-rose-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900" id="modal-title">Cancel Reservation Request</h3>
                                    <p class="mt-2 text-sm text-slate-500">Are you sure you want to cancel this booking request? This action cannot be undone.</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col-reverse gap-2 border-t border-slate-100 bg-slate-50 px-6 py-4 sm:flex-row sm:justify-end">
                            <button type="button" @click="cancelModalOpen = false" class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                                Keep Booking
                            </button>
                            <button type="submit" class="rounded-xl bg-rose-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-rose-700">
                                Yes, Cancel Reservation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>


</x-customerLayout>