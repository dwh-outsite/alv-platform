<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-900 h-screen antialiased leading-none">
<div id="app" class="h-full flex flex-col">
    <nav class="bg-white border-t-4 shadow-xl border-purple-400 text-gray-800 shadow px-4 flex justify-between">
        @auth
            <div class="flex-1 flex">
                @if (auth()->user() instanceof App\User)
                    <a href="{{ url('/admin') }}" class="text-lg font-semibold no-underline flex items-center mr-8">
                        {{ config('app.name', 'ALV Platform') }}
                    </a>

                    <div class="flex">
                        @foreach(config('app.admin.menu') as $menuItem)
                            @if (Route::currentRouteName() === $menuItem['route'])
                                <a href="{{ route($menuItem['route']) }}" class="flex">
                                    <div class="bg-purple-400 h-full"><div class="bg-white rounded-tr w-4 h-full"></div></div>
                                    <div class="bg-purple-400 rounded-b-lg mb-2 pt-2 px-4 flex items-center font-bold text-white">
                                        {{ $menuItem['name'] }}
                                    </div>
                                    <div class="bg-purple-400 h-full"><div class="bg-white rounded-tl w-4 h-full"></div></div>
                                </a>
                            @else
                                <div class="mb-2 pt-2 px-4 flex items-center text-purple-700">
                                    <a href="{{ route($menuItem['route']) }}">{{ $menuItem['name'] }}</a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <a href="{{ url('/') }}" class="text-lg font-semibold no-underline flex items-center mr-8 space-x-2">
                        <div class="text-lg font-semibold no-underline flex items-center">
                            {{ config('app.name', 'ALV Platform') }}
                        </div>
                        <div class="border border-purple-400 rounded uppercase tracking-wider text-xs text-purple-400 p-1">
                            Live
                        </div>
                    </a>
                @endif
            </div>
            <div class="py-3">
                <connection-status @if (auth()->user() instanceof App\User) :show-participants="true" @endif/>
            </div>
            <div class="md:flex-1 flex items-center justify-end text-right text-sm">
                @if (auth()->user() instanceof App\User)
                    <div class="mr-3">
                        <admin-show-vote-countdown />
                    </div>
                    <div class="mr-3">
                        <admin-show-agenda />
                    </div>
                    <div class="mr-6">
                        <admin-hide-button />
                    </div>
                @endif
                <div class="hidden md:block">{{ auth()->user()->name }}</div>
            </div>
        @else
            <div class="flex-1 py-4">
                <a href="{{ url('/') }}" class="text-lg font-semibold no-underline">
                    {{ config('app.name', 'ALV Platform') }}
                </a>
            </div>
        @endauth
    </nav>

    <div class="flex-1">
        @yield('content')
    </div>

    <notifications position="center top" />
</div>

</body>
</html>
