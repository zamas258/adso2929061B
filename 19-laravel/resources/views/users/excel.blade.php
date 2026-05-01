<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Users</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Photo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            @php
                $userImgPath = (!empty($user->photo) && file_exists(public_path('images/' . $user->photo)))
                    ? public_path('images/' . $user->photo)
                    : public_path('images/no-image.png');
            @endphp
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->fullname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <img src="{{ $userImgPath }}" width="50" height="50" alt="Photo">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>