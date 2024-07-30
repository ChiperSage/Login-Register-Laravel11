<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
</head>
<body>
    <h1>User List</h1>
    <a href="{{ route('user.create') }}">Create New User</a>

    @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                        <a href="{{ route('user.edit', $user->user_id) }}">Edit</a>
                        <a href="{{ route('user.assignRole', $user->user_id) }}">Role</a>
                        <form action="{{ route('user.destroy', $user->user_id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

 <script type="text/javascript">
        function confirmDelete() {
            return confirm('Are you sure you want to delete this user?');
        }
    </script>
