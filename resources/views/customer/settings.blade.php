<x-customerLayout>
    
    <div x-data="{ activeTab: 'profile' }" class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Account Settings</h1>
                <p class="mt-1 text-sm text-slate-500">Manage your profile, security, and notification preferences.</p>
            </div>

            {{-- Session Flash Alerts --}}
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

            @if($errors->any())
                <div x-data="{ show: true }" x-show="show" class="mb-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-rose-800">
                    <div class="flex items-start gap-3">
                        <svg class="h-5 w-5 shrink-0 text-rose-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm font-bold">Please correct the following errors:</p>
                            <ul class="mt-1 list-disc list-inside text-xs space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Layout Grid: Navigation Tabs + Main Content --}}
            <div class="grid grid-cols-1 gap-8 md:grid-cols-4">

                {{-- Tab Sidebar Navigation --}}
                <aside class="md:col-span-1">
                    <nav class="flex space-x-2 md:flex-col md:space-x-0 md:space-y-1">
                        
                        {{-- Profile Tab --}}
                        <button @click="activeTab = 'profile'" 
                                :class="activeTab === 'profile' ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-600 hover:bg-slate-100'"
                                class="flex items-center gap-3 w-full rounded-xl px-4 py-3 text-sm transition">
                            <svg class="h-5 w-5 text-slate-400" :class="{ 'text-indigo-600': activeTab === 'profile' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Profile Details
                        </button>

                        {{-- Security Tab --}}
                        <button @click="activeTab = 'security'" 
                                :class="activeTab === 'security' ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-600 hover:bg-slate-100'"
                                class="flex items-center gap-3 w-full rounded-xl px-4 py-3 text-sm transition">
                            <svg class="h-5 w-5 text-slate-400" :class="{ 'text-indigo-600': activeTab === 'security' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Password & Security
                        </button>

                        {{-- Notifications Tab --}}
                        <button @click="activeTab = 'notifications'" 
                                :class="activeTab === 'notifications' ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-600 hover:bg-slate-100'"
                                class="flex items-center gap-3 w-full rounded-xl px-4 py-3 text-sm transition">
                            <svg class="h-5 w-5 text-slate-400" :class="{ 'text-indigo-600': activeTab === 'notifications' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            Notifications
                        </button>

                    </nav>
                </aside>

                {{-- Main Form Content Area --}}
                <main class="md:col-span-3">

                    {{-- Tab 1: Profile Details --}}
                    <div x-show="activeTab === 'profile'" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <h2 class="text-lg font-bold text-slate-900">Personal Information</h2>
                        <p class="mt-1 text-xs text-slate-500">Update your account name, contact details, and avatar.</p>

                        <form action="{{ route('customers.update-profile') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            @method('PUT')

                            {{-- Avatar Upload --}}
                            <div class="flex items-center gap-6">
                                <div class="relative h-20 w-20 overflow-hidden rounded-full border border-slate-200 bg-slate-100">
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="h-full w-full object-cover">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center font-bold text-slate-400 text-xl">
                                            {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700">Profile Photo</label>
                                    <input type="file" name="avatar" class="mt-1.5 text-xs text-slate-500 file:mr-4 file:rounded-xl file:border-0 file:bg-indigo-50 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100">
                                    <p class="mt-1 text-[11px] text-slate-400">JPG, PNG, or WEBP up to 2MB.</p>
                                </div>
                            </div>

                            {{-- Name --}}
                            <div>
                                <label for="name" class="block text-xs font-semibold text-slate-700">Full Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                    class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-900 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-xs font-semibold text-slate-700">Email Address</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                    class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-900 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                            </div>

                            {{-- Phone Number --}}
                            <div>
                                <label for="phone" class="block text-xs font-semibold text-slate-700">Phone Number</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" placeholder="+250 788 000 000"
                                    class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-900 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                            </div>

                            <div class="flex justify-end pt-4 border-t border-slate-100">
                                <button type="submit" class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                                    Save Profile Changes
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Tab 2: Security --}}
                    <div x-show="activeTab === 'security'" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8" x-cloak>
                        <h2 class="text-lg font-bold text-slate-900">Change Password</h2>
                        <p class="mt-1 text-xs text-slate-500">Ensure your account is using a strong, unique password.</p>

                        <form action="{{ route('customers.update-password') }}" method="POST" class="mt-6 space-y-6">
                            @csrf
                            @method('PUT')

                            {{-- Current Password --}}
                            <div>
                                <label for="current_password" class="block text-xs font-semibold text-slate-700">Current Password</label>
                                <input type="password" name="current_password" id="current_password" required
                                    class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                            </div>

                            {{-- New Password --}}
                            <div>
                                <label for="password" class="block text-xs font-semibold text-slate-700">New Password</label>
                                <input type="password" name="password" id="password" required
                                    class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                            </div>

                            {{-- Password Confirmation --}}
                            <div>
                                <label for="password_confirmation" class="block text-xs font-semibold text-slate-700">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                    class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                            </div>

                            <div class="flex justify-end pt-4 border-t border-slate-100">
                                <button type="submit" class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Tab 3: Notifications --}}
                    <div x-show="activeTab === 'notifications'" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8" x-cloak>
                        <h2 class="text-lg font-bold text-slate-900">Notification Preferences</h2>
                        <p class="mt-1 text-xs text-slate-500">Choose how and when you receive updates regarding your bookings.</p>

                        <form action="{{ route('customer.notifications.update') }}" method="POST" class="mt-6 space-y-6">
                            @csrf
                            @method('PUT')

                            <div class="space-y-4">
                                
                                {{-- Booking Status Alerts --}}
                                <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-100 bg-slate-50/50 cursor-pointer hover:bg-slate-50">
                                    <input type="checkbox" name="notify_booking_updates" value="1" {{ old('notify_booking_updates', $user->notify_booking_updates) ? 'checked' : '' }}
                                        class="mt-0.5 h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                                    <div>
                                        <span class="block text-sm font-bold text-slate-900">Booking Status Updates</span>
                                        <span class="block text-xs text-slate-500">Receive email alerts when a reservation request is confirmed or updated by property managers.</span>
                                    </div>
                                </label>

                                {{-- Stay Reminders --}}
                                <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-100 bg-slate-50/50 cursor-pointer hover:bg-slate-50">
                                    <input type="checkbox" name="notify_reminders" value="1" {{ old('notify_reminders', $user->notify_reminders) ? 'checked' : '' }}
                                        class="mt-0.5 h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                                    <div>
                                        <span class="block text-sm font-bold text-slate-900">Check-in Reminders</span>
                                        <span class="block text-xs text-slate-500">Receive helpful check-in and check-out reminder notifications prior to your stay.</span>
                                    </div>
                                </label>

                                {{-- Special Offers & Promotions --}}
                                <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-100 bg-slate-50/50 cursor-pointer hover:bg-slate-50">
                                    <input type="checkbox" name="notify_promotions" value="1" {{ old('notify_promotions', $user->notify_promotions) ? 'checked' : '' }}
                                        class="mt-0.5 h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                                    <div>
                                        <span class="block text-sm font-bold text-slate-900">Promotions & Recommendations</span>
                                        <span class="block text-xs text-slate-500">Receive occasional emails about featured apartments, discount offers, and news.</span>
                                    </div>
                                </label>

                            </div>

                            <div class="flex justify-end pt-4 border-t border-slate-100">
                                <button type="submit" class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                                    Save Notification Settings
                                </button>
                            </div>
                        </form>
                    </div>

                </main>
            </div>

        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>

</x-customerLayout>