<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pet;
use App\Models\Adoption;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function myprofile(){
        $user = User::find(Auth::User()->id);
        return view('customer.myprofile')->with('user', $user);
    }

    public function updatemyprofile(Request $request, User $user)
    {
        $email = strtolower($request->email);

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

        $user->document = $request->document;
        $user->fullname = $request->fullname;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->phone = $request->phone;
        $user->active = $request->active;
        $user->role = $request->role;
        $user->email = $email;

        if ($request->hasFile('photo')) {
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

    public function myadoptions(Request $request)
    {
        $query = Adoption::where('user_id', Auth::user()->id)->with('pet');
        
        if ($request->has('qsearch') && !empty($request->qsearch)) {
            $search = $request->qsearch;
            $query->whereHas('pet', function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('bread', 'LIKE', "%{$search}%")
                  ->orWhere('kind', 'LIKE', "%{$search}%");
            });
        }
        
        $adoptions = $query->orderBy('id', 'desc')->paginate(10);
        
        return view('customer.myadoptions', compact('adoptions'));
    }
    
    public function showadoption($id)
    {
        $adoption = Adoption::with('pet')->findOrFail($id);
        
        if ($adoption->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('customer.showadoption', compact('adoption'));
    }
    
    // TU VISTA PRINCIPAL CON ESTILOS
    public function listpets()
    {
        $pets = Pet::where('adopted', 0)
                    ->orderBy('id', 'desc')
                    ->paginate(10);
        
        return view('customer.listpets', compact('pets'));
    }

    public function search(Request $request)
    {
        $pets = Pet::where('adopted', 0)
                    ->where(function($query) use ($request) {
                        $query->where('name', 'LIKE', "%{$request->q}%")
                              ->orWhere('bread', 'LIKE', "%{$request->q}%")
                              ->orWhere('kind', 'LIKE', "%{$request->q}%");
                    })
                    ->orderBy('id', 'desc')
                    ->paginate(10);
        
        return view('customer.listpets', compact('pets'));
    }

    public function showpet($id)
    {
        $pet = Pet::findOrFail($id);
        return view('customer.showpet', compact('pet'));
    }

    // ADOPCIÓN DIRECTA
    public function adoptDirectly($id)
    {
        $user = Auth::user();
        $pet = Pet::findOrFail($id);

        // Verificar si la mascota ya está adoptada
        if ($pet->adopted == 1) {
            return redirect()->back()->with('error', 'This pet has already been adopted.');
        }

        // Verificar límite de adopciones (máximo 3)
        $countAdoptions = Adoption::where('user_id', $user->id)->count();

        if($countAdoptions >= 3){
            return redirect()->back()->with('error', 'You have reached the maximum number of adoptions (3). You cannot adopt more pets.');
        }

        // Crear la adopción
        $adoption = new Adoption();
        $adoption->user_id = $user->id;
        $adoption->pet_id = $pet->id;
        $adoption->status = 0; // 0 = pendiente
        $adoption->adoption_date = now();
        $adoption->save();

        // Marcar la mascota como adoptada
        $pet->adopted = 1;
        $pet->save();

        return redirect()->route('customer.myadoptions')->with('success', '🎉 Congratulations! You have successfully adopted ' . $pet->name . '!');
    }
}