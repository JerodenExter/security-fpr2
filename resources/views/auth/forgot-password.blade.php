<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <input type="email" name="email" placeholder="Je e-mailadres" required>
    <button type="submit">Reset link verzenden</button>
</form>

@if(session('status'))
    <p>{{ session('status') }}</p>
@endif
