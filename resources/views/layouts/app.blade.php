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
        <nav class="bg-white border-b-4 border-purple-500 text-gray-800 shadow py-3 px-6 flex items-center justify-between">
            <div>
                <a href="{{ url('/') }}" class="text-lg font-semibold no-underline">
                    {{ config('app.name', 'ALV Platform') }}
                </a>
            </div>
            @auth
                <div>
                    <connection-status />
                </div>
                <div class="flex items-center text-right text-sm">
                    @if (auth()->user() instanceof App\User)
                        <div class="mr-6">
                            <admin-hide-button />
                        </div>
                    @endif
                    {{ auth()->user()->name }}
                </div>
            @endauth
        </nav>

        <div class="flex-1 h-full">
            @yield('content')
        </div>

        <notifications position="center top" />
    </div>

</body>
</html>
