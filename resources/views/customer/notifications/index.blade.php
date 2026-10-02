<x-customerLayout>
<div class="min-h-screen bg-slate-50 py-8">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

        {{-- Page Header & Actions --}}
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Notifications</h1>
                <p class="mt-1 text-sm text-slate-500">Stay updated on your booking requests and account activity.</p>
            </div>

            @if($unreadCount > 0)
                <form action="{{ route('customer.notifications.readAll') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-xs font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                        <svg class="h-4 w-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Mark all as read
                    </button>
                </form>
            @endif
        </div>

        {{-- Alert Banners --}}
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

        {{-- Filter Tabs --}}
        <div class="mb-6 flex items-center gap-2 border-b border-slate-200 pb-3">
            <a href="{{ route('customer.notifications.index') }}" 
               class="rounded-lg px-3.5 py-1.5 text-xs font-bold transition {{ request('filter') !== 'unread' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-200' }}">
                All Notifications
            </a>
            <a href="{{ route('customer.notifications.index', ['filter' => 'unread']) }}" 
               class="flex items-center gap-2 rounded-lg px-3.5 py-1.5 text-xs font-bold transition {{ request('filter') === 'unread' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-200' }}">
                <span>Unread</span>
                @if($unreadCount > 0)
                    <span class="rounded-full bg-rose-500 px-1.5 py-0.5 text-[10px] font-extrabold text-white">
                        {{ $unreadCount }}
                    </span>
                @endif
            </a>
        </div>

        {{-- Notification List Container --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            @forelse($notifications as $notification)
                <div class="group relative flex items-start gap-4 border-b border-slate-100 p-5 transition hover:bg-slate-50/80 {{ is_null($notification->read_at) ? 'bg-indigo-50/30' : '' }}">
                    
                    {{-- Status Indicator Bar & Icon --}}
                    <div class="mt-1 shrink-0">
                        @switch($notification->type)
                            @case('booking_confirmed')
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                @break
                            @case('booking_cancelled')
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-100 text-rose-600">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                @break
                            @default
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-600">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                        @endswitch
                    </div>

                    {{-- Notification Content --}}
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between gap-2">
                            <h2 class="text-sm font-bold text-slate-900">
                                {{ $notification->title }}
                            </h2>
                            <span class="shrink-0 text-xs text-slate-400">
                                {{ $notification->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <p class="mt-1 text-xs leading-relaxed text-slate-600">
                            {{ $notification->message }}
                        </p>

                        {{-- Metadata Action Link --}}
                        @if(data_get($notification->data, 'action_url'))
                            <div class="mt-2.5">
                                <form action="{{ route('customer.notifications.read', $notification) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-600 hover:text-indigo-800">
                                        <span>View Details</span>
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    {{-- Unread Badge & Delete Action --}}
                    <div class="flex shrink-0 items-center gap-2">
                        @if(is_null($notification->read_at))
                            <span class="h-2.5 w-2.5 rounded-full bg-indigo-600" title="Unread"></span>
                        @endif

                        <form action="{{ route('customer.notifications.destroy', $notification) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this notification?')" class="rounded-lg p-1 text-slate-400 hover:bg-slate-200 hover:text-slate-600" title="Delete">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="p-12 text-center">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-sm font-bold text-slate-900">No notifications found</h3>
                    <p class="mt-1 text-xs text-slate-500">You're all caught up! New reservation alerts and status updates will appear here.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($notifications->hasPages())
            <div class="mt-6">
                {{ $notifications->links() }}
            </div>
        @endif

    </div>
</div>
</x-customerLayout>