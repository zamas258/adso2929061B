<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('hello', function () {
    return "<h1>Hello Laravel 🚀</h1>";
});

Route::get('sayhello/{name}', function() {
    return "<h1>Hello: ".request()->name."</h1>";
});

Route::get('getall/pets', function() {
    $pets = \App\Models\Pet::all();
    dd($pets->toArray());
});

Route::get('show/pet/{id}', function($id) {
    $pet = \App\Models\Pet::find($id);
    dd($pet);
});
Route::get('show/users', function() {
    $users = \App\Models\User::select('name', 'edad', 'created_at as fecha_creacion')->get();
    dd($users);
});