<!DOCTYPE html>
<html>
<head>
    <title>Assign Roles</title>
</head>
<body>
    <h1>Assign Roles to {{ $user->name }}</h1>
    <form method="POST" action="{{ route('user.storeRoleAssignment', $user->user_id) }}">
        @csrf
        @foreach($roles as $role)
            <label>
                <input type="checkbox" name="role_ids[]" value="{{ $role->role_id }}"
                {{ in_array($role->role_id, $user->roles->pluck('role_id')->toArray()) ? 'checked' : '' }}>
                {{ $role->role_name }}
            </label>
            <br>
        @endforeach
        <button type="submit">Assign Roles</button>
    </form>
</body>
</html>
