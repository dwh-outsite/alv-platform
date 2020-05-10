@extends('layouts.app')

@section('content')

    <div class="h-full flex items-center justify-center">

        <div class="bg-white rounded text-center">
            <div class="bg-gray-700 font-bold px-6 py-4 uppercase tracking-wide text-gray-100 rounded-t">
                Aanmelden
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('admin.login-post') }}">
                    @csrf

                    <input type="email" placeholder="E-mail Adres" class="form-input w-full @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <div class="bg-red-200 p-3 mt-3 rounded">
                        {{ $message }}
                    </div>
                    @enderror

                    <input type="password" placeholder="Wachtwoord" class="mt-6 form-input w-full @error('password') border-red-500 @enderror" name="password" required>

                    @error('password')
                    <div class="bg-red-200 p-3 mt-3 rounded">
                        {{ $message }}
                    </div>
                    @enderror

                    <button class="mt-6 w-full bg-blue-500 hover:bg-blue-700 text-gray-100 font-bold py-3 rounded">
                        Inloggen
                    </button>
                </form>

            </div>
        </div>

    </div>

@endsection
