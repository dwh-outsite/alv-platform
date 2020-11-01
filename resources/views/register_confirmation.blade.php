@extends('layouts.app')

@section('content')

    <div class="h-full flex items-center justify-center">

        <div class="bg-white rounded mx-4 md:w-1/3 overflow-hidden">
            <div class="bg-gray-700 font-bold px-6 py-4 uppercase tracking-wide text-gray-100">
                Aanmelden
            </div>
            <div class="p-6 leading-snug">
                <div class="font-bold mb-3">Bedankt voor het aanmelden, {{ $participant->name }}!</div>
                <div>
                    Je ontvang binnen enkele minuten je toegangscode per e-mail op <em>{{ $participant->email }}</em>.
                </div>
            </div>
        </div>

    </div>

@endsection
