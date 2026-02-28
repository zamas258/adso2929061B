<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Pet - {{ $pet->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-700 min-h-dvh p-14">
    <div class="mb-4">
        <a href="{{ url('/getall/pets') }}" class="text-gray-200 hover:text-gray-300 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256">
                <path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path>
            </svg>
            Volver a la lista
        </a>
    </div>

    <h1 class="text-gray-200 text-4xl text-center border-b-2 pb-4 mb-5">Detalle de la Mascota</h1>
    
    <div class="max-w-2xl mx-auto">
        <table class="table table-border bg-gray-300 text-gray-950 w-full">
            <thead>
                <tr class="bg-gray-900 text-gray-200">
                    <th colspan="2" class="text-center text-xl py-4">Información de {{ $pet->name }}</th>
                </tr>
            </thead>
            <tbody>
                <tr class="even:bg-gray-400">
                    <td class="font-bold w-1/3 px-4 py-3">ID</td>
                    <td class="px-4 py-3">{{ $pet->id }}</td>
                </tr>
                <tr class="even:bg-gray-400">
                    <td class="font-bold px-4 py-3">NOMBRE</td>
                    <td class="px-4 py-3">{{ $pet->name }}</td>
                </tr>
                <tr class="even:bg-gray-400">
                    <td class="font-bold px-4 py-3">IMAGEN</td>
                    <td class="px-4 py-3">
                        <img src="{{ asset('images/'.$pet->image) }}" alt="{{ $pet->name }}" class="w-20 h-20 object-cover rounded">
                    </td>
                </tr>
                <tr class="even:bg-gray-400">
                    <td class="font-bold px-4 py-3">KIND</td>
                    <td class="px-4 py-3">{{ $pet->kind }}</td>
                </tr>
                <tr class="even:bg-gray-400">
                    <td class="font-bold px-4 py-3">PESO</td>
                    <td class="px-4 py-3">{{ $pet->weight }} kg</td>
                </tr>
                <tr class="even:bg-gray-400">
                    <td class="font-bold px-4 py-3">EDAD</td>
                    <td class="px-4 py-3">{{ $pet->age }} años</td>
                </tr>
                <tr class="even:bg-gray-400">
                    <td class="font-bold px-4 py-3">RAZA (BREAD)</td>
                    <td class="px-4 py-3">{{ $pet->bread }}</td>
                </tr>
                <tr class="even:bg-gray-400">
                    <td class="font-bold px-4 py-3">UBICACIÓN</td>
                    <td class="px-4 py-3">{{ $pet->location }}</td>
                </tr>
                <tr class="even:bg-gray-400">
                    <td class="font-bold px-4 py-3">DESCRIPCIÓN</td>
                    <td class="px-4 py-3">{{ $pet->description }}</td>
                </tr>
                <tr class="even:bg-gray-400">
                    <td class="font-bold px-4 py-3">ESTADO</td>
                    <td class="px-4 py-3">
                        @if($pet->active)
                            <span class="bg-green-600 text-white px-2 py-1 rounded">Activo</span>
                        @else
                            <span class="bg-red-600 text-white px-2 py-1 rounded">Inactivo</span>
                        @endif
                    </td>
                </tr>
                <tr class="even:bg-gray-400">
                    <td class="font-bold px-4 py-3">ADOPTADO</td>
                    <td class="px-4 py-3">
                        @if($pet->adopted)
                            <span class="bg-green-600 text-white px-2 py-1 rounded">Sí</span>
                        @else
                            <span class="bg-yellow-600 text-white px-2 py-1 rounded">No</span>
                        @endif
                    </td>
                </tr>
                <tr class="even:bg-gray-400">
                    <td class="font-bold px-4 py-3">FECHA CREACIÓN</td>
                    <td class="px-4 py-3">{{ $pet->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                <tr class="even:bg-gray-400">
                    <td class="font-bold px-4 py-3">ÚLTIMA ACTUALIZACIÓN</td>
                    <td class="px-4 py-3">{{ $pet->updated_at->format('d/m/Y H:i') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Tarjeta adicional con más detalles -->
        <div class="mt-6 bg-gray-800 p-4 rounded-lg text-gray-200">
            <h2 class="text-xl font-bold mb-2">Resumen</h2>
            <p><span class="font-semibold">{{ $pet->name }}</span> es un <span class="font-semibold">{{ $pet->kind }}</span> de raza <span class="font-semibold">{{ $pet->bread }}</span>.</p>
            <p>Tiene {{ $pet->age }} años y pesa {{ $pet->weight }} kg.</p>
            <p>Ubicación: {{ $pet->location }}</p>
            <p class="mt-2 text-sm text-gray-400">ID de registro: #{{ $pet->id }}</p>
        </div>
    </div>
</body>

</html>