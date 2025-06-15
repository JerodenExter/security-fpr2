<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren</title>
</head>
<body>
<h1>Registratie van account</h1>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('register.store') }}">
    @csrf
    <label>Naam: <input type="text" name="name" required></label><br>
    <label>Email: <input type="email" name="email" required></label><br>
    <div>
        <label for="password">Wachtwoord</label>
        <input type="password" name="password" id="password" required>
    </div>
    <div>
        <label for="password_confirmation">Bevestig Wachtwoord</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
    </div>
    <button type="submit">Maak je account aan</button>
</form>
<small>Tip: Gebruik een wachtwoordmanager om sterke en unieke wachtwoorden te bewaren.</small>
</body>
</html>
