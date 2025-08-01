<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/robsontenorio/mary@0.44.2/libs/currency/currency.js"></script>
</head>

<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-100">
    <x-nav sticky class="lg:hidden">
        <x-slot:brand>
            <x-app-brand />
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-nav>

    <x-toast/>
    
    @if (session('impersonate'))
        <livewire:admin.users.stop-impersonate/>
    @endif

    @if (!app()->environment('production'))
        <x-devbar/>
    @endif

    <x-main full-width>
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">
            <x-menu activate-by-route>
                @if($user = auth()->user())
                    <x-menu-separator />
 
                    <x-list-item :item="$user" value="name" sub-value="username" no-separator no-hover class="-mx-2 -my-2! rounded">
                        <x-slot:actions>
                            <div class="o-tooltip-left" data-tip="logoff">
                                <x-button 
                                    icon="o-power" 
                                    class="btn-circle btn-ghost btn-xs" 
                                    @click="$dispatch('logout')"
                                />
                            </div>
                        </x-slot:actions>
                    </x-list-item>

                    <x-menu-separator />
                @endif

                <x-menu-item title="Home" icon="o-home" link="/" />
                <x-menu-item title="Customers" icon="o-building-storefront" :link="route('customers')" />
                <x-menu-item title="Opportunities" icon="o-currency-dollar" :link="route('opportunities')" />

                @can(\App\Enum\Can::BE_AN_ADMIN->value)
                    <x-menu-sub title="Admin" icon="o-lock-closed">
                        <x-menu-item title="Dashboard" icon="o-chart-bar-square" link="{{ route('admin.dashboard') }}" />
                        <x-menu-item title="Users" icon="o-users" link="{{ route('admin.users') }}" />
                    </x-menu-sub>
                @endcan
            </x-menu>
        </x-slot:sidebar>

        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    <x-toast />

    <livewire:auth.logout/>
</body>
</html>