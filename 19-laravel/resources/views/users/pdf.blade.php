<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Usuarios</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', 'Helvetica Neue', Arial, sans-serif;
            font-size: 12px;
            color: #1a1a2e;
            background: #ffffff;
            padding: 30px 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 28px;
            padding-bottom: 18px;
            border-bottom: 3px solid #1a1a2e;
        }

        .header-title h1 {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: #1a1a2e;
        }

        .header-title p {
            font-size: 11px;
            color: #6b7280;
            margin-top: 3px;
        }

        .header-meta {
            text-align: right;
            font-size: 10px;
            color: #6b7280;
            line-height: 1.6;
        }

        .summary-bar {
            background: #1a1a2e;
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            display: inline-block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: #1a1a2e;
            color: #ffffff;
        }

        thead th {
            padding: 11px 14px;
            text-align: left;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        thead th:first-child {
            width: 80px;
            border-radius: 6px 0 0 0;
        }

        thead th:last-child {
            border-radius: 0 6px 0 0;
        }

        tbody tr {
            border-bottom: 1px solid #e5e7eb;
        }

        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        tbody tr:last-child {
            border-bottom: 2px solid #1a1a2e;
        }

        tbody td {
            padding: 10px 14px;
            font-size: 12px;
            color: #374151;
        }

        tbody td:first-child {
            font-weight: 700;
            color: #1a1a2e;
            font-size: 11px;
        }

        .id-pill {
            background: #eef2ff;
            color: #3730a3;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
        }

        .footer {
            margin-top: 24px;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            font-size: 9px;
            color: #9ca3af;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="header-title">
            <h1>Reporte de Usuarios</h1>
            <p>Listado general del sistema</p>
        </div>
        <div class="header-meta">
            <strong>Fecha:</strong> {{ date('d/m/Y') }}<br>
            <strong>Hora:</strong> {{ date('H:i') }}<br>
            <strong>Generado por:</strong> Sistema Larapets
        </div>
    </div>

    <div class="summary-bar">
        Total de registros: {{ count($users) }}
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Nombre completo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><span class="id-pill">{{ $user->id }}</span></td>
                <td>{{ $user->fullname }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <span>Larapets</span>
    </div>

</body>
</html>