<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form method="POST" action="{{ route('user.update', $user) }}">
        @csrf
        @method('PUT')
        <label>Username:</label>
        <input type="text" name="username" value="{{ $user->username }}" required>
        <br>
        <label>Password (leave blank to keep current password):</label>
        <input type="password" name="password">
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
