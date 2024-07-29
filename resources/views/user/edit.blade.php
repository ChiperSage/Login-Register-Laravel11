<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form method="POST" action="{{ route('user.update', $user->user_id) }}">
        @csrf
        @method('PUT')
        <label>Name:</label>
        <input type="text" name="name" value="{{ $user->name }}" required>
        <br>
        <label>Email:</label>
        <input type="email" name="email" value="{{ $user->email }}" required>
        <br>
        <label>Username:</label>
        <input type="text" name="username" value="{{ $user->username }}" required>
        <br>
        <label>Password (leave blank to keep current password):</label>
        <input type="password" name="password">
        <br>
        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation">
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
