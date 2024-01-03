<div id="submenu" class="bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-8">
            <!-- Navigation Links -->
            <div class="hidden space-x-3 sm:-my-px sm:ms-10 sm:flex ml-20 font-">
                <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                    {{ __('All users') }}
                </x-nav-link>
                <x-nav-link :href="route('users.create')" :active="request()->routeIs('users.create')">
                    {{ __('New user') }}
                </x-nav-link>
            </div>
        </div>
    </div>
</div>
