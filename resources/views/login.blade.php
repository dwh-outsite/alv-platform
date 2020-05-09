@extends('layouts.app')

@section('content')

    <div class="h-full flex items-center justify-center">

        <div class="bg-white rounded text-center">
            <div class="bg-gray-700 font-bold px-6 py-4 uppercase tracking-wide text-gray-100 rounded-t">
                Aanmelden
            </div>
            <div class="p-6">
                Vul hieronder de per e-mail verkregen code in.

                <form method="POST" action="{{ route('login-post') }}" class="mt-6">
                    @csrf

                    @error('code')
                        <div class="bg-red-200 p-3 mb-6 rounded">{{ $message }}</div>
                    @enderror

                    <input type="text" placeholder="Code" name="code" class="form-input w-full text-center" required />

                    <button class="mt-6 w-full bg-blue-500 hover:bg-blue-700 text-gray-100 font-bold py-3 rounded">
                        Inloggen
                    </button>
                </form>

            </div>
        </div>

    </div>

@endsection
