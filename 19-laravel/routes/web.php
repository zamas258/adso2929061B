<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Pet;
use Carbon\Carbon;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ============================================
// RUTAS DE PERFIL (AUTH)
// ============================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ============================================
// RUTAS PROTEGIDAS POR AUTENTICACIÓN
// ============================================
Route::middleware('auth')->group(function () {

    // Búsquedas (todos los usuarios autenticados)
    Route::post('search/users', [UserController::class, 'search'])->name('users.search');
    Route::post('search/pets', [PetController::class, 'search'])->name('pets.search');
    Route::post('search/adoptions', [AdoptionController::class, 'search'])->name('adoptions.search');

    // Rutas de prueba para cualquier usuario autenticado
    Route::get('hello', function () {
        return "<h1>Hello Laravel 🚀</h1>";
    });
    
    Route::get('sayhello/{name}', function () {
        return "<h1>Hello: ".request()->name."</h1>";
    });
    
    Route::get('getall/pets', function(){
        $pets = App\Models\Pet::all();
        dd($pets->toArray());
    });
    
    Route::get('show/pet/{id}', function($id){
        $pet = App\Models\Pet::find($id);
        dd($pet->toArray());
    });
    
    Route::get('challenge', function () {
        if (!file_exists(public_path('images'))) {
            mkdir(public_path('images'), 0777, true);
        }
        
        if (User::count() < 20) {
            User::factory()->count(20)->create();
        }
        
        $users = User::take(20)->get();
        
        foreach ($users as $user) {
            $imagePath = public_path('images/' . $user->photo);
            if (!file_exists($imagePath)) {
                try {
                    $gender = ($user->gender == 'Male') ? 'men' : 'women';
                    $url = "https://randomuser.me/api/portraits/{$gender}/" . rand(1,99) . ".png";
                    file_put_contents($imagePath, file_get_contents($url));
                } catch (\Exception $e) {
                }
            }
        }
        
        $headerStyle = "style='background: gray; color: white; padding: 0.4rem; border: 1px solid gray;'";
        $cellStyle = "style='border: 1px solid gray; padding: 0.4rem;'";
        
        $code = "<h2>Challenge</h2>";
        $code .= "<table style='border-collapse: collapse; margin: 2px auto; font-family: Arial; border: 1px solid gray; width: 100%;'>";
        
        $code .= "<td>";
        $code .= "<th $headerStyle>Photo</th>";
        $code .= "<th $headerStyle>Fullname</th>";
        $code .= "<th $headerStyle>Age</th>";
        $code .= "<th $headerStyle>Gender</th>";
        $code .= "<th $headerStyle>Created At</th>";
        $code .= "</tr>";
        
        foreach ($users as $user) {
            $age = Carbon::parse($user->birthdate)->age;
            
            $code .= "<tr>";
            $code .= "<td $cellStyle>";
            if (file_exists(public_path('images/' . $user->photo))) {
                $code .= "<img src='" . asset('images/' . $user->photo) . "' width='60' height='60' style='display: block; margin: 0 auto;'>";
            }
            $code .= "</td>";
            $code .= "<td $cellStyle>" . $user->fullname . "</td>";
            $code .= "<td $cellStyle>" . $age . " años</td>";
            $code .= "<td $cellStyle>" . $user->gender . "</td>";
            $code .= "<td $cellStyle>" . $user->created_at . "</td>";
            $code .= "</tr>";
        }
        
        $code .= "</table>";
        
        return $code;
    });
    
    Route::get('getall/pets/view', function(){
        $pets = Pet::all();
        return view('getallpets')->with('pets', $pets);
    });
    
    Route::get('show/pet/view/{id}', function($id){
        $pet = Pet::findOrFail($id);
        return view('showpet')->with('pet', $pet);
    });

    // ========================================
    // RUTAS SOLO PARA ADMINISTRADORES (role:Admin)
    // ========================================
    Route::middleware(['role:Admin'])->group(function () {

        // Exportaciones
        Route::get('export/users/pdf', [UserController::class, 'pdf'])->name('users.pdf');
        Route::get('export/pets/pdf', [PetController::class, 'pdf'])->name('pets.pdf');
        Route::get('export/adoptions/pdf', [AdoptionController::class, 'pdf'])->name('adoptions.pdf');
        Route::get('export/users/excel', [UserController::class, 'excel'])->name('users.excel');
        Route::get('export/pets/excel', [PetController::class, 'excel'])->name('pets.excel');
        Route::get('export/adoptions/excel', [AdoptionController::class, 'excel'])->name('adoptions.excel');

        // Importación de usuarios
        Route::post('import/users', [UserController::class, 'import'])->name('users.import');

        // CRUDs completos solo para admin
        Route::resources([
            'users'       => UserController::class,
            'pets'        => PetController::class,
            'adoptions'   => AdoptionController::class,
        ]);
    });

    // ========================================
    // RUTAS DE CUSTOMER (para todos los usuarios autenticados)
    // ========================================
    
    // Perfil de usuario
    Route::get('myprofile', [CustomerController::class, 'myprofile'])->name('customer.myprofile');
    Route::put('myprofile/{user}', [CustomerController::class, 'updatemyprofile'])->name('customer.updatemyprofile');

    // Mis adopciones
    Route::get('myadoptions', [CustomerController::class, 'myadoptions'])->name('customer.myadoptions');
    Route::get('myadoption/{id}', [CustomerController::class, 'showadoption'])->name('customer.showadoption');

    // Lista de mascotas disponibles (TU VISTA CON ESTILOS)
    Route::get('listpets', [CustomerController::class, 'listpets'])->name('customer.listpets');
    Route::get('showpet/{id}', [CustomerController::class, 'showpet'])->name('customer.showpet');
    Route::post('search/adoptionpets', [CustomerController::class, 'search'])->name('customer.searchpets');
    
    // Adopción directa (sin formulario)
    Route::post('adopt/{id}', [CustomerController::class, 'adoptDirectly'])->name('customer.adopt.directly');
    
    // Redirección: makeadoption muestra la misma vista que listpets
    Route::get('makeadoption', [CustomerController::class, 'listpets'])->name('makeadoption');
});

require __DIR__.'/auth.php';