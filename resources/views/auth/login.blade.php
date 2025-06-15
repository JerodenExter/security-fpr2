<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h1>Login op een bestaand account</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('login.store') }}">
    @csrf
    <label for="email">E-mail:</label>
    <input type="email" name="email" id="email" required><br>

    <label for="password">Wachtwoord:</label>
    <input type="password" name="password" id="password" required><br>

    <label>
        <input type="checkbox" Name="remember"> Blijf ingelogd
    </label><br><br>

    <button type="submit">Inloggen</button>
</form>
</body>
</html>
