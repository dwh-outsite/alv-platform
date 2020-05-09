@extends('layouts.app')

@section('content')
    <div class="h-full flex text-gray-200">
        <div class="border-r-2 border-gray-400 w-1/4 flex flex-col justify-between">
            <div class="flex-1">
                <div class="bg-gray-700 font-bold p-4 uppercase text-center tracking-wide">
                    Stemmingen
                </div>
                <div class="h-full flex items-center justify-center">
                    Er is op dit moment geen stemming bezig.
                </div>
            </div>
            <div class="border-t-2 border-gray-400">
                <div class="bg-gray-700 font-bold p-4 uppercase text-center tracking-wide">
                    Vergaderstukken
                </div>
                <div class="py-6 flex items-center justify-center">
                    Er zijn nog geen vergaderstukken beschikbaar.
                </div>
            </div>
        </div>
        <div class="flex-1 flex flex-col justify">
            <div>
                <div class="embed-responsive aspect-ratio-16/9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/J---aiyznGQ"></iframe>
                </div>
            </div>
            <div class="flex-1 border-t-2 border-gray-400 flex flex-col">
                <div class="bg-gray-700 font-bold p-4 uppercase text-center tracking-wide">
                    Stel een vraag
                </div>
                <div class="flex-1 flex items-center justify-center">
                    Deze functionaliteit is nog niet beschikbaar.
                </div>
            </div>
        </div>

    </div>
@endsection
