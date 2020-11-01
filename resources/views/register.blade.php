@extends('layouts.app')

@section('content')

    <div class="h-full flex items-center justify-center">

        <div class="bg-white rounded mx-4 md:w-1/3 overflow-hidden">
            <div class="bg-gray-700 font-bold px-6 py-4 uppercase tracking-wide text-gray-100">
                Aanmelden
            </div>
            <div class="p-6 leading-snug">
                <div class="font-bold mb-3">Welkom bij het ALV streaming platform!</div>
                <div class="mb-3">
                    Vul hieronder je naam en e-mailadres in om toegang aan te vragen tot het platform.
                    Na het invullen ontvang je direct per e-mail een persoonlijke toegangscode.
                </div>
                <div class="mb-3">
                    <strong>Let op:</strong> je e-mailadres moet gelijk zijn aan het adres waarop je de ALV uitnodiging
                    hebt ontvangen.
                </div>
                <div class="leading-snug">
                </div>

                <form method="POST" action="{{ route('register-post') }}" class="mt-6">
                    @csrf

                    <input type="text" placeholder="Naam" name="name" class="form-input w-full mb-4" required />
                    @error('name')
                    <div class="bg-red-200 p-3 mb-6 rounded">{{ $message }}</div>
                    @enderror

                    <input type="email" placeholder="E-mail" name="email" class="form-input w-full mb-4" required />
                    @error('email')
                    <div class="bg-red-200 p-3 mb-6 rounded">{{ $message }}</div>
                    @enderror

                    <label class="bg-purple-100 rounded-lg p-4 flex">
                        <input type="checkbox" name="privacy_consent" value="true" class="mr-2 pt-2 w-6 h-6 rounded-lg" required/>
                        <div class="flex-1 text-sm">
                            @error('privacy_consent')
                            <div class="bg-red-200 p-3 mb-3 rounded">{{ $message }}</div>
                            @enderror

                            Bij het verzenden van dit formulier geef je DWH toestemming om je gegevens op te slaan en te verwerken zoals beschreven op <a href="https://dwhdelft.nl/privacy" class="text-purple-600" target="_blank">dwhdelft.nl/privacy</a>.
                            We gebruiken deze gegevens alleen ter identificatie van je ledenstatus en om je naam te vermelden als je een vraag stelt, stemmen is te allen tijde anoniem.
                        </div>
                    </label>

                    <button class="mt-6 w-full bg-purple-500 hover:bg-purple-700 text-gray-100 font-bold py-3 rounded">
                        Registreren
                    </button>

                    <div class="mt-4 text-gray-500 text-sm">
                        <p>
                            <strong>Let op: </strong> Alleen leden kunnen deelnemen aan de vergadering. Indien blijkt dat je geen lid bent wordt je toegangscode buiten werking gesteld. Je ontvangt hierover geen bericht.
                        </p>
                    </div>
                </form>

            </div>
        </div>

    </div>

@endsection
