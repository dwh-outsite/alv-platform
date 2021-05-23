@extends('layouts.app')

@section('content')
    <div class="flex text-gray-200">
        <div class="w-full flex flex-col justify-between">
            <div>
                <div class="bg-gray-700 font-bold p-4 uppercase text-center tracking-wide">
                    Participant
                </div>

                @if (session('message'))
                    <div class="p-4 bg-green-600">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="p-4">
                    <div class="bg-gray-800 rounded-lg ">
                        <div class="rounded-t-md px-4 py-4 font-bold text-lg flex justify-between items-center bg-gray-700" >
                            {{ $participant->name }}
                        </div>
                        <div class="p-4 mb-4 leading-snug">
                            Email: {{ $participant->email }}<br />
                            IP: {{ $participant->ip }}<br />
                            <br />
                            First login: {{ $participant->created_at }}<br />
                            Last login: {{ $participant->updated_at }}
                        </div>
                    </div>

                    <div class="bg-gray-800 rounded-lg ">
                        <div class="rounded-t-md px-4 py-4 font-bold text-lg flex justify-between items-center bg-gray-700" >
                            Block IP
                        </div>
                        <div class="p-4 mb-4 leading-snug">
                            @if (Firewall::isBlacklisted($participant->ip))
                                The IP address of this participant ({{ $participant->ip }}) is already blocked.
                            @else
                                Are you sure you want to block the IP of <strong>{{ $participant->name }}</strong>? <br />
                                Note that this blocks all user on the same (home) network as the participant (in most cases this is not an issue).

                                <form method="POST" action="{{ route('admin.firewall') }}">
                                    @csrf
                                    <input type="hidden" name="ip" value="{{ $participant->ip }}" />
                                    <button class="block mt-4 bg-red-600 rounded py-2 px-4">
                                        Block
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
