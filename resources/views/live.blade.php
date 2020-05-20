@extends('layouts.app')

@section('content')
    <div class="h-full flex text-gray-200">
        <div class="border-r-2 border-gray-400 w-1/4 flex flex-col justify-between">
            <div class="flex-1">
                <div class="bg-gray-700 font-bold p-4 uppercase text-center tracking-wide">
                    Stemmingen
                </div>
                <div class="h-full">
                    <poll />
                </div>
            </div>
            <div class="border-t-2 border-gray-400">
                <div class="bg-gray-700 font-bold p-4 uppercase text-center tracking-wide">
                    Vergaderstukken
                </div>
                <div class="py-3 px-4">
                    <files-list folder-id="1CGDDk8iXkluXqHZf7NEWgcmKmKtaQSSi" />
                </div>
            </div>
        </div>
        <div class="flex-1 flex flex-col justify">
            <div>
                <div class="embed-responsive aspect-ratio-16/9">
                    <iframe class="embed-responsive-item" src="{{ config('app.stream_url') }}"></iframe>
                </div>
            </div>
            <div class="flex-1 border-t-2 border-gray-400 flex flex-col">
                <div class="bg-gray-700 font-bold p-4 uppercase text-center tracking-wide">
                    Stel een vraag
                </div>
                <div class="flex-1">
                    <question />
                </div>
            </div>
        </div>
    </div>
@endsection
