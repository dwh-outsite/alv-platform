@extends('layouts.app')

@section('content')
    <div class="h-full flex flex-col items-center justify-center text-gray-200 text-lg">
        <h1 class="text-purple-500 text-4xl font-bold">
            Wow, jij bent er vroeg bij!
        </h1>
        <p class="my-8">
            Deze pagina is beschikbaar vanaf
            <strong>{{ Carbon\Carbon::parse(config('app.event.start_time'))->format('d-m-Y H:i') }}</strong>.
        </p>
        <p>
            Je kunt deze pagina sluiten en terugkomen als het zover is!
        </p>

        <meta http-equiv="refresh" content="30;URL='/'" />

    </div>
@endsection
