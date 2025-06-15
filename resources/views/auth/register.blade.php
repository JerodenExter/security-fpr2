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
    <label>Wachtwoord: <input type="password" name="password" required></label><br>
    <button type="submit">Maak je account aan</button>
</form>
</body>
</html>
