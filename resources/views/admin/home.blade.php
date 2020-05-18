@extends('layouts.app')

@section('content')
    <div class="flex text-gray-200">
        <div class="border-r-2 border-gray-400 w-1/2 flex flex-col justify-between">
            <div class="flex-1">
                <div class="bg-gray-700 font-bold p-4 uppercase text-center tracking-wide">
                    Stemmingen
                </div>
                <div>
                    <admin-polls :initial-polls='@json($polls)' />
                </div>
            </div>
        </div>
        <div class="border-r-2 border-gray-400 flex-1 flex flex-col justify">
            <div>
                <div class="bg-gray-700 font-bold p-4 uppercase text-center tracking-wide">
                    Lower Thirds
                </div>
                <admin-lower-thirds />
            </div>
            <div class="border-t-2 border-gray-400">
                <div class="bg-gray-700 font-bold p-4 uppercase text-center tracking-wide">
                    Vragen
                </div>
                <admin-questions :initial-questions='@json($questions)' />
            </div>
        </div>
        <div class="w-64 flex flex-col justify">
            <div class="flex-1 flex flex-col">
                <div class="bg-gray-700 font-bold p-4 uppercase text-center tracking-wide">
                    Deelnemers
                </div>
                <div class="flex-1">
                    <admin-participants />
                </div>
            </div>
        </div>
    </div>
@endsection
