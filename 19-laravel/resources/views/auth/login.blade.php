{{--<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>--}}

@extends('layouts.app')

@section('title', 'Larapets: Login')

@section('content')
    <section class="bg-[#0006]
    p-4 outline
    rounded-md
    w-90
    flex
    flex-col
    gap-4
    justify-center
    items-center">

    <h1 class="text-4xl 
    flex gap-2
    border-b-2
    pb-2
    gap-2"
    >
    <svg xmlns="http://www.w3.org/2000/svg"  class="size-10 "fill="currentColor" viewBox="0 0 256 256"><path d="M208,80H176V56a48,48,0,0,0-96,0V80H48A16,16,0,0,0,32,96V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V96A16,16,0,0,0,208,80ZM96,56a32,32,0,0,1,64,0V80H96ZM208,208H48V96H208V208Zm-68-56a12,12,0,1,1-12-12A12,12,0,0,1,140,152Z"></path></svg>
                Login
    </h1>
    <form class="flex mt-8 flex-col gap-4 w-full" action="{{route('login')}}" method="post">
        @csrf
        <label class="label">Email</label>
        <input class="input bg-[#0009] outline-1" type="text" name="email" value="{{ old('email') }}" placeholder="username@mail.com">
        @error('email')
        <small class="badge badge-error w-full">{{ $message }}</small>    
        @enderror
        <label class="label ">Password</label>
        <input class="input bg-[#0009] outline-1" type="password" name="password" placeholder="yoursecret">
        @error('password')
        <small class="badge badge-error w-full">{{ $message }}</small>    
        @enderror
        <button class="btn">Login</button>
        @if (Route::has('password.request'))
                <a class="underline text-sm text-white hover:text-[#fff9] 
                border-b-1
                pb-1
                w-fit
                mt-4
                rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
        @endif
    </form>
    </section>

