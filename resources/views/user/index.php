<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
</head>
<body>
    <h1>User List</h1>
    <a href="{{ route('user.create') }}">Create New User</a>
    <ul>
        @foreach ($users as $user)
            <li>{{ $user->username }} - 
                <a href="{{ route('user.edit', $user) }}">Edit</a> - 
                <form action="{{ route('user.destroy', $user) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
