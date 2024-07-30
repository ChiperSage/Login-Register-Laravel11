<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="POST" action="{{ route('login') }}">
    @csrf

        @if ($errors->has('username'))
            <div class="alert alert-danger">
                {{ $errors->first('username') }}
            </div>
        @endif
        <br>

    <!-- Username -->
    <div>
        <label for="username">Username</label>
        <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus>
    </div>

    <!-- Password -->
    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
    </div>

    <!-- Remember Me -->
    <div>
        <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="remember">Remember me</label>
    </div>

    <div>
        <button type="submit">Log in</button>
    </div>
</form>

</body>
</html>
