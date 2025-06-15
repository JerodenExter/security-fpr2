<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Nieuw wachtwoord" required>
    <input type="password" name="password_confirmation" placeholder="Bevestig wachtwoord" required>
    <button type="submit">Wachtwoord resetten</button>
</form>
