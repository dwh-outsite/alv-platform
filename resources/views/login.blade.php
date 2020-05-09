<form method="POST" action="{{ route('login-post') }}">
    @csrf

    <input type="text" placeholder="Code" name="code" />

    @error('code')
        {{ $message }}
    @enderror

    <button>Submit</button>
</form>
