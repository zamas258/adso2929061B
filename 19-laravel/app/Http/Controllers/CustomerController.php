<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Adoption;

class CustomerController extends Controller
{
    public function myprofile(){
        $user = User::find(Auth::User()->id);
        return view('customer.myprofile')->with('user', $user);
    }

    public function updatemyprofile(Request $request, User $user)
    {
        // Convertir email a minúsculas antes de todo
        $email = strtolower($request->email);

        // Validar que el usuario autenticado solo pueda editar su propio perfil
        if ($user->id !== Auth::user()->id) {
            return redirect()->back()->with('error', 'You can only edit your own profile.');
        }

        $request->validate([
            'document' => ['required', 'numeric', 'unique:users,document,' . $user->id],
            'fullname' => ['required', 'string', 'max:255'],
            'gender'   => ['required', 'in:Female,Male'],
            'birthdate' => ['required', 'date'],
            'phone'    => ['required', 'string', 'max:20'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'photo'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'active'   => ['required', 'in:0,1'],
            'role'     => ['required', 'in:Customer,Admin,Moderator'],
        ]);

        // Actualizar los datos del usuario
        $user->document = $request->document;
        $user->fullname = $request->fullname;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->phone = $request->phone;
        $user->active = $request->active;
        $user->role = $request->role;
        $user->email = $email;

        // Manejar la foto
        if ($request->hasFile('photo')) {
            // Eliminar foto anterior si no es la default
            if ($user->photo && $user->photo != 'default.jpg') {
                $oldPhotoPath = public_path('images/' . $user->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            $photoName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $photoName);
            $user->photo = $photoName;
        }

        if ($user->save()) {
            return redirect('dashboard')->with('success', 'The User: ' . $user->fullname . ' was edited successfully!');
        }

        return back()->with('error', 'Error updating user');
    }

    // Otros métodos que mencionaste en las rutas (puedes agregarlos según necesites)
    public function myadoptions(Request $request)
{
    $query = Adoption::where('user_id', Auth::user()->id)->with('pet');
    
    // Si hay búsqueda, filtrar
    if ($request->has('qsearch') && !empty($request->qsearch)) {
        $search = $request->qsearch;
        $query->whereHas('pet', function($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('breed', 'LIKE', "%{$search}%")
              ->orWhere('kind', 'LIKE', "%{$search}%");
        });
    }
    
    $adoptions = $query->orderBy('id', 'desc')->paginate(10);
    
    return view('customer.myadoptions', compact('adoptions'));
}
public function searchAdoptions(Request $request)
{
    $search = $request->get('qsearch');
    
    $adoptions = Adoption::where('user_id', Auth::user()->id)
        ->whereHas('pet', function($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('breed', 'LIKE', "%{$search}%")
                  ->orWhere('kind', 'LIKE', "%{$search}%");
        })
        ->with('pet')
        ->orderBy('id', 'desc')
        ->paginate(10);
    
    if ($request->ajax()) {
        return view('customer.partials.adoption_cards', compact('adoptions'))->render();
    }
    
    return view('customer.myadoptions', compact('adoptions'));
}

    public function showadoption(Request $request)
    {
        $adoption = Adoption::find($request->id);
        return view('customer.showadoption')->with('adoption', $adoption);
    }
    

    public function listpets()
    {
        // Lógica para listar mascotas
        return view('customer.listpets');
    }

    public function search(Request $request)
    {
        // Lógica para buscar mascotas para adopción
        return view('customer.searchpets');
    }

    public function showpet($id)
    {
        // Lógica para mostrar una mascota específica
        return view('customer.showpet');
    }

    public function makeadoption(Request $request)
    {
        // Lógica para realizar una adopción
        return redirect()->back()->with('message', 'Adoption request sent successfully!');
    }
    
}