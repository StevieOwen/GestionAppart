<x-mdLayout>

    {{-- =========================================================
        KPI SUMMARY CARDS
    ========================================================== --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">

        {{-- Total Buildings --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Buildings
                    </p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ number_format((int) $totalBuildings) }}
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5M9 9h.01M15 9h.01M9 12h.01M15 12h.01"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Apartments --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Apartments
                    </p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ number_format((int) $totalApartments) }}
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 21h18M5 21V8a2 2 0 012-2h10a2 2 0 012 2v13M8 21v-4h8v4M8 10h.01M12 10h.01M16 10h.01M8 13h.01M12 13h.01M16 13h.01"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Bookings --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Bookings
                    </p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ number_format((int) $totalBookings) }}
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Revenue --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Revenue
                    </p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        ${{ number_format((float) $totalRevenue, 2) }}
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8c-2.21 0-4 1.12-4 2.5s1.79 2.5 4 2.5 4 1.12 4 2.5S14.21 18 12 18m0-10V5m0 14v-3M19 12a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- =========================================================
        ANALYTICS / BOOKING CHART
    ========================================================== --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
        <div class="mb-6">
            <h2 class="text-lg font-bold text-slate-900">
                Booking Comparison Across Apartments
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Overview of bookings recorded for each apartment.
            </p>
        </div>

        <div class="relative h-80 w-full">
            <canvas id="bookingsChart" class="max-h-80"></canvas>
        </div>
    </div>

    {{-- =========================================================
        RECENT BOOKINGS
    ========================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b border-slate-200 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
            <div>
                <h2 class="text-lg font-bold text-slate-900">
                    Recent Reservations
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Latest booking activity across your apartments.
                </p>
            </div>

            <a
                href="{{route('bookings.create')}}"
                class="inline-flex items-center gap-1 text-sm font-semibold text-indigo-600 transition hover:text-indigo-700"
            >
                View All
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[700px] text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-semibold">Customer</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Apartment</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Dates</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Total Price</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($recentBookings as $booking)
                        @php
                            $status = strtolower((string) $booking->status);

                            $statusClasses = match ($status) {
                                'confirmed' => 'bg-emerald-100 text-emerald-800',
                                'processing' => 'bg-amber-100 text-amber-800',
                                'cancelled' => 'bg-rose-100 text-rose-800',
                                default => 'bg-slate-100 text-slate-700',
                            };
                        @endphp

                        <tr class="transition hover:bg-slate-50">
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-xs font-bold text-indigo-700">
                                        {{ strtoupper(substr($booking->user?->name ?? 'U', 0, 1)) }}
                                    </div>

                                    <span class="font-medium text-slate-900">
                                        {{ $booking->user?->name ?? 'Unknown Customer' }}
                                    </span>
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-slate-600">
                                {{ $booking->appartment?->appart_designation ?? 'Unknown Apartment' }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-slate-600">
                                <div class="flex flex-col">
                                    <span>
                                        {{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}
                                    </span>
                                    <span class="text-xs text-slate-400">
                                        to {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}
                                    </span>
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 font-semibold text-slate-900">
                                ${{ number_format((float) $booking->price, 2) }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold capitalize {{ $statusClasses }}">
                                    {{ $status ?: 'unknown' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="mx-auto flex max-w-sm flex-col items-center">
                                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"/>
                                        </svg>
                                    </div>

                                    <h3 class="mt-4 font-semibold text-slate-900">
                                        No reservations yet
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        New reservations will appear here once customers start booking your apartments.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- =========================================================
        CUSTOMER REVIEWS
    ========================================================== --}}
    <section>
        <div class="mb-6">
            <h2 class="text-xl font-bold text-slate-900">
                Recent Customer Feedback & Ratings
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                See what customers are saying about their stays.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

            @forelse($reviews as $review)
                @php
                    $customerName = $review->user?->name ?? 'Anonymous Customer';
                    $initials = collect(preg_split('/\s+/', trim($customerName)))
                        ->filter()
                        ->take(2)
                        ->map(fn ($name) => strtoupper(substr($name, 0, 1)))
                        ->implode('');

                    $rating = max(0, min(5, (float) $review->grade));
                    $fullStars = (int) floor($rating);
                    $hasHalfStar = ($rating - $fullStars) >= 0.5;
                @endphp

                <article class="flex flex-col rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md">

                    {{-- Review Header --}}
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex min-w-0 items-center gap-3">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-bold text-indigo-700">
                                {{ $initials ?: 'U' }}
                            </div>

                            <div class="min-w-0">
                                <h3 class="truncate font-semibold text-slate-900">
                                    {{ $customerName }}
                                </h3>

                                <p class="text-xs text-slate-400">
                                    {{ optional($review->created_at)->diffForHumans() }}
                                </p>
                            </div>
                        </div>

                        <span class="shrink-0 rounded-full bg-indigo-50 px-3 py-1 text-xs font-medium text-indigo-700">
                            {{ $review->appartment?->appart_designation ?? 'Apartment' }}
                        </span>
                    </div>

                    {{-- Rating --}}
                    <div class="mt-5 flex items-center gap-1" aria-label="Rating: {{ number_format($rating, 1) }} out of 5">
                        @for($star = 1; $star <= 5; $star++)
                            @if($star <= $fullStars)
                                {{-- Full star --}}
                                <svg class="h-5 w-5 fill-current text-amber-400" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M12 2.5l2.94 5.95 6.56.95-4.75 4.63 1.12 6.54L12 17.48l-5.87 3.09 1.12-6.54L2.5 9.4l6.56-.95L12 2.5z"/>
                                </svg>
                            @elseif($star === $fullStars + 1 && $hasHalfStar)
                                {{-- Half star --}}
                                <svg class="h-5 w-5" viewBox="0 0 24 24" aria-hidden="true">
                                    <defs>
                                        <linearGradient id="half-star-{{ $review->id }}" x1="0%" y1="0%" x2="100%" y2="0%">
                                            <stop offset="50%" stop-color="currentColor"/>
                                            <stop offset="50%" stop-color="transparent"/>
                                        </linearGradient>
                                    </defs>

                                    <path
                                        d="M12 2.5l2.94 5.95 6.56.95-4.75 4.63 1.12 6.54L12 17.48l-5.87 3.09 1.12-6.54L2.5 9.4l6.56-.95L12 2.5z"
                                        fill="url(#half-star-{{ $review->id }})"
                                        stroke="currentColor"
                                        class="text-amber-400"
                                    />
                                </svg>
                            @else
                                {{-- Empty star --}}
                                <svg class="h-5 w-5 fill-none stroke-current text-slate-300" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M12 2.5l2.94 5.95 6.56.95-4.75 4.63 1.12 6.54L12 17.48l-5.87 3.09 1.12-6.54L2.5 9.4l6.56-.95L12 2.5z"/>
                                </svg>
                            @endif
                        @endfor

                        <span class="ml-2 text-sm font-semibold text-slate-700">
                            {{ number_format($rating, 1) }}/5.0
                        </span>
                    </div>

                    {{-- Comment --}}
                    <blockquote class="mt-5 flex-1 text-sm leading-6 italic text-slate-600">
                        "{{ $review->comment }}"
                    </blockquote>
                </article>

            @empty
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center md:col-span-2 lg:col-span-3">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 8h10M7 12h6m-6 8l-3 2v-4a8 8 0 118 4h-5z"/>
                        </svg>
                    </div>

                    <h3 class="mt-4 font-semibold text-slate-900">
                        No customer feedback yet
                    </h3>

                    <p class="mx-auto mt-1 max-w-md text-sm text-slate-500">
                        Customer reviews and ratings will appear here once guests leave feedback about their stays.
                    </p>
                </div>
            @endforelse

        </div>
    </section>

</div>
```

</div>

{{-- =============================================================
CHART.JS
============================================================== --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const canvas = document.getElementById('bookingsChart');

        if (!canvas) {
            return;
        }

        const labels = {!! json_encode($chartLabels ?? []) !!};
        const data = {!! json_encode($chartData ?? []) !!};

        new Chart(canvas, {
            type: 'bar',

            data: {
                labels: labels,

                datasets: [{
                    label: 'Bookings',
                    data: data,
                    backgroundColor: 'rgba(79, 70, 229, 0.85)',
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 0,
                    borderRadius: 6,
                    borderSkipped: false,
                    maxBarThickness: 48
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                interaction: {
                    intersect: false,
                    mode: 'index'
                },

                plugins: {
                    legend: {
                        display: false
                    },

                    tooltip: {
                        backgroundColor: '#0f172a',
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false,

                        callbacks: {
                            label: function (context) {
                                return 'Bookings: ' + context.parsed.y;
                            }
                        }
                    }
                },

                scales: {
                    x: {
                        grid: {
                            display: false
                        },

                        border: {
                            display: false
                        },

                        ticks: {
                            color: '#64748b',
                            font: {
                                size: 12
                            }
                        }
                    },

                    y: {
                        beginAtZero: true,

                        ticks: {
                            precision: 0,
                            color: '#64748b',
                            font: {
                                size: 12
                            }
                        },

                        grid: {
                            color: 'rgba(148, 163, 184, 0.15)',
                            drawBorder: false
                        },

                        border: {
                            display: false,
                            dash: [4, 4]
                        }
                    }
                }
            }
        });
    });
</script>


</x-mdLayout>