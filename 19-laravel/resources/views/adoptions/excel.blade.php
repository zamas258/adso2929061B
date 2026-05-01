<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adoptions Export - Larapets</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User Photo</th>
                <th>Pet Photo</th>
                <th>Pet</th>
                <th>User</th>
                <th>Document</th>
                <th>Email</th>
                <th>Adoption Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adopts as $adopt)
                @php
                    $userImgPath = (!empty($adopt->user->photo) && file_exists(public_path('images/' . $adopt->user->photo)))
                        ? public_path('images/' . $adopt->user->photo)
                        : public_path('images/no-image.png');
                    $petImgPath = (!empty($adopt->pet->image) && file_exists(public_path('images/pets/' . $adopt->pet->image)))
                        ? public_path('images/pets/' . $adopt->pet->image)
                        : ((!empty($adopt->pet->image) && file_exists(public_path('images/' . $adopt->pet->image)))
                            ? public_path('images/' . $adopt->pet->image)
                            : public_path('images/no-image.png'));
                @endphp
                <tr>
                    <td>{{ $adopt->id }}</td>
                    <td><img src="{{ $userImgPath }}" width="45" height="45" alt="User"></td>
                    <td><img src="{{ $petImgPath }}" width="45" height="45" alt="Pet"></td>
                    <td>{{ $adopt->pet->name ?? 'N/A' }}</td>
                    <td>{{ $adopt->user->fullname ?? 'N/A' }}</td>
                    <td>{{ $adopt->user->document ?? 'N/A' }}</td>
                    <td>{{ $adopt->user->email ?? 'N/A' }}</td>
                    <td>{{ optional($adopt->created_at)->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
