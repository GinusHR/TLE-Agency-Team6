<body>
<h1>Bedrijfs Login</h1>
<form method="POST" action="{{ route('company.login') }}">
    @csrf
    <div>
        <label for="login_code">Inlog code</label>
        <input type="text" id="login_code" name="login_code" required>
    </div>
    <div>
        <label for="password">Wachtwoord</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">log in</button>
</form>
</body>
