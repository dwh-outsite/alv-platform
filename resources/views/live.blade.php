@extends('layouts.app')

@section('content')
    <div class="h-full flex text-gray-200">
        <div class="border-r-2 border-gray-400 w-1/4 flex flex-col justify-between">
            <div class="flex-1">
                <div class="bg-gray-700 font-bold p-4 uppercase text-center tracking-wide">
                    Stemmingen
                </div>
                <div class="h-full">
                    <poll :initial-poll='@json($poll)' />
                </div>
            </div>
            <div class="border-t-2 border-gray-400">
                <div class="bg-gray-700 font-bold p-4 uppercase text-center tracking-wide">
                    Stel een vraag
                </div>
                <div class="flex-1">
                    <question />
                </div>
            </div>
            <div class="border-t-2 border-gray-400">
                <div class="flex-1 p-4 flex items-center">
                    <a href="{{ config('app.event.zoom_url') }}" target="_blank">
                        <button class="bg-blue-800 hover:bg-blue-600 p-4 rounded leading-tight font-semibold text-sm">
                            Discussieer mee <br /> via Zoom
                        </button>
                    </a>
                    <div class="text-gray-500 leading-snug text-xs italic ml-2 xl:flex-1">
                        Stop de stream op deze pagina om dubbel geluid te voorkomen.
                        Met het joinen van de Zoom call ga je ermee akkoord dat je in beeld gebracht kunt worden.
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-1 flex flex-col justify">
            <div class="flex-1 bg-black flex flex-col justify-center">
                <div class="embed-responsive aspect-ratio-16/9">
                    <iframe
                        class="embed-responsive-item"
                        src="{{ config('app.event.stream_url') }}"
                        allow="autoplay; encrypted-media"
                        allowfullscreen
                    ></iframe>
                </div>
            </div>
            <div class="border-t-2 border-gray-400 flex flex-col">
                <div class="bg-gray-700 font-bold p-4 uppercase text-center tracking-wide">
                    Vergaderstukken
                </div>
                <div class="py-3 px-4">
                    <files-list folder-id="{{ config('app.event.drive_id') }}" />
                </div>
            </div>
        </div>
    </div>
@endsection
