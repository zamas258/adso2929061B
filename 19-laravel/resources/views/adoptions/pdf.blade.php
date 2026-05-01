<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adoptions Report - Larapets</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #222; }
        h2 { margin: 0 0 8px 0; }
        .meta { margin-bottom: 14px; color: #666; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; vertical-align: middle; }
        th { background: #2d3748; color: #fff; }
        tr:nth-child(even) { background: #f8f8f8; }
        .img { width: 42px; height: 42px; object-fit: cover; border-radius: 6px; }
    </style>
</head>
<body>
    <h2>Adoptions Report - Larapets</h2>
    <div class="meta">
        Generated: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }} | Total: {{ $adopts->count() }}
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User Photo</th>
                <th>Pet Photo</th>
                <th>Pet</th>
                <th>User</th>
                <th>Email</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($adopts as $adopt)
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
                    <td><img src="{{ $userImgPath }}" class="img" alt="User"></td>
                    <td><img src="{{ $petImgPath }}" class="img" alt="Pet"></td>
                    <td>{{ $adopt->pet->name ?? 'N/A' }}</td>
                    <td>{{ $adopt->user->fullname ?? 'N/A' }}</td>
                    <td>{{ $adopt->user->email ?? 'N/A' }}</td>
                    <td>{{ optional($adopt->created_at)->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;">No adoptions found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
