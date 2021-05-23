@extends('layouts.app')

@section('content')
    <div class="flex text-gray-200">
        <div class="border-r-2 border-gray-400 w-2/5">
            <div>
                <div class="bg-gray-700 font-bold p-4 uppercase text-center tracking-wide">
                    Countdown
                </div>
                <admin-countdown />
            </div>
            <div class="border-t-2 border-gray-400">
                <div class="bg-gray-700 font-bold p-4 uppercase text-center tracking-wide">
                    Upper Third
                </div>
                <admin-upper-third />
            </div>
            <div class="border-t-2 border-gray-400">
                <div class="bg-gray-700 font-bold p-4 uppercase text-center tracking-wide">
                    Message
                </div>
                <admin-message />
            </div>
        </div>
        <div class="border-r-2 border-gray-400 flex-1 flex flex-col justify">
            <div class="bg-gray-700 font-bold p-4 uppercase text-center tracking-wide">
                Lower Thirds
            </div>
            <admin-lower-thirds :initial-lower-thirds="{!! config('app.event.lower_thirds', '[]') !!}" />
        </div>
    </div>
@endsection

