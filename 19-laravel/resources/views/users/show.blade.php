@extends('layouts.app')

@section('title', 'Larapets: Show User')

@section('content')
    @include('partials.navbar')
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"/>
        </svg>
        Show User
    </h1>
    <div class="breadcrumbs text-sm text-white mb-6">
        <ul>
            <li>
                <a href="{{ url('dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,64H56V56h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,200,40Zm0,64H152V56h48v48Zm-96,32H56a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,104,136Zm0,64H56V152h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,200,136Zm0,64H152V152h48v48Z"/>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ url('users') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z"/>
                    </svg>
                    User Module
                </a>
            </li>
            <li>
                <span class="inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"/>
                    </svg>
                    {{ $user->fullname }}
                </span>
            </li>
        </ul>
    </div>

    <div class="card text-white md:w-[720px] w-[320px] bg-black/50 p-8 mb-4">
        <div class="flex flex-col items-center gap-6">
            <div class="mask mask-squircle w-48">
                <img src="{{ asset('images/' . $user->photo) }}" alt="Photo of {{ $user->fullname }}">
            </div>
            <div class="grid grid-cols-2 gap-x-16 gap-y-4 w-full">
                <div class="flex flex-col gap-4">
                    <div>
                        <span class="font-bold">Document:</span> {{ $user->document }}
                    </div>
                    <div>
                        <span class="font-bold">FullName:</span> {{ $user->fullname }}
                    </div>
                    <div>
                        <span class="font-bold">Gender:</span> {{ $user->gender }}
                    </div>
                    <div>
                        <span class="font-bold">Age:</span>
                        {{ \Carbon\Carbon::parse($user->birthdate)->age }} years old
                    </div>
                    <div>
                        <span class="font-bold">Phone:</span> {{ $user->phone }}
                    </div>
                </div>
                <div class="flex flex-col gap-4">
                    <div>
                        <span class="font-bold">Email:</span> {{ $user->email }}
                    </div>
                    <div>
                        <span class="font-bold">Active:</span>
                        <span class="badge badge-outline">{{ $user->active ? 'Active' : 'Inactive' }}</span>
                    </div>
                    <div>
                        <span class="font-bold">Role:</span>
                        <span class="badge badge-outline">{{ $user->role ?? 'Customer' }}</span>
                    </div>
                    <div>
                        <span class="font-bold">Created At:</span>
                        {{ $user->created_at->diffForHumans() }}
                    </div>
                    <div>
                        <span class="font-bold">Updated At:</span>
                        {{ $user->updated_at->diffForHumans() }}
                    </div>
                </div>
            </div>

            <a href="{{ url('users') }}" class="btn btn-outline hover:bg-[#fff6] hover:text-white w-full">
                Back
            </a>
        </div>
    </div>
@endsection