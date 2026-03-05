@extends('layouts.app')

@section('title', 'Larapets: Welcome')
@section('content')
    <section class="bg-[#0006]
    p-4 outline
    rounded-md
    w-80
    flex
    flex-col
    gap-4
    justify-center
    items-center">
        <img src="{{asset('images/logo.png')}}" class="size-40">
        <p class="text-justify">
            🐾 “No compres amor… adóptalo y cambia dos vidas: la suya y la tuya.” 💛
        </p>
        <div class="flex gap-2 justify-between mt-8">
            @guest
            <a class="btn btn-outline w-34" href="{{url('login')}}">
                <svg xmlns="http://www.w3.org/2000/svg"  class="size-5 "fill="currentColor" viewBox="0 0 256 256"><path d="M208,80H176V56a48,48,0,0,0-96,0V80H48A16,16,0,0,0,32,96V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V96A16,16,0,0,0,208,80ZM96,56a32,32,0,0,1,64,0V80H96ZM208,208H48V96H208V208Zm-68-56a12,12,0,1,1-12-12A12,12,0,0,1,140,152Z"></path></svg>
                Login
            </a>
            <a class="btn btn-outline w-34" href="{{url('register')}}">
                <svg xmlns="http://www.w3.org/2000/svg"  class="size-5 " fill="currentColor" viewBox="0 0 256 256"><path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"></path></svg>
                Register
            </a>
            @else 
            <a class="btn btn-outline w-34" href="{{url('dashboard')}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5  " fill="currentColor" viewBox="0 0 256 256"><path d="M80,40a40,40,0,1,0,40,40A40,40,0,0,0,80,40Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,80,104Zm96,16a40,40,0,1,0-40-40A40,40,0,0,0,176,120Zm0-64a24,24,0,1,1-24,24A24,24,0,0,1,176,56ZM80,136a40,40,0,1,0,40,40A40,40,0,0,0,80,136Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,80,200Zm96-64a40,40,0,1,0,40,40A40,40,0,0,0,176,136Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,176,200Z"></path></svg>
                Dashboard
            </a>
            @endguest

        </div>
    </section>
@endsection
    