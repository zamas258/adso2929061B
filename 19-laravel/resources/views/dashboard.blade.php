@extends('layouts.app')

@section('title', 'Larapets: Dashboard')

@section('content')
@include('partials.navbar')

<h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
    Dashboard
</h1>

<div class="flex flex-wrap gap-6 items-center justify-center mb-6">

    @if (Auth::user()->role == 'Admin')

    {{-- USERS --}}
    <div class="card text-white bg-[#0006] w-96 shadow-sm">
        <figure class="h-[240px] w-full overflow-hidden">
            <img class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                src="{{ asset('images/users.png') }}" />
        </figure>

        <div class="card-body">
            <h2 class="card-title">Module Users</h2>

            <ul class="list bg-[#0003] rounded-box shadow-md">
                <li class="list-row">
                    <div class="text-xs">Total Users</div>
                    <button class="btn btn-ghost">{{ App\Models\User::count() }}</button>
                </li>

                <li class="list-row">
                    <div class="text-xs">Customers</div>
                    <button class="btn btn-ghost">
                        {{ App\Models\User::where('role', 'Customer')->count() }}
                    </button>
                </li>

                <li class="list-row">
                    <div class="text-xs">Actives</div>
                    <button class="btn btn-ghost">
                        {{ App\Models\User::where('active', 1)->count() }}
                    </button>
                </li>
            </ul>

            <a class="btn btn-outline mt-3" href="{{ url('users') }}">Enter</a>
        </div>
    </div>

    {{-- PETS --}}
    <div class="card text-white bg-[#0006] w-96 shadow-sm">
        <figure class="h-[240px] w-full overflow-hidden">
            <img class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                src="{{ asset('images/pets.png') }}" />
        </figure>

        <div class="card-body">
            <h2 class="card-title">Module Pets</h2>

            <ul class="list bg-[#0003] rounded-box shadow-md">
                <li class="list-row">
                    <div class="text-xs">Total Pets</div>
                    <button class="btn btn-ghost">{{ App\Models\Pet::count() }}</button>
                </li>

                <li class="list-row">
                    <div class="text-xs">Dogs</div>
                    <button class="btn btn-ghost">
                        {{ App\Models\Pet::where('kind', 'Dog')->count() }}
                    </button>
                </li>

                <li class="list-row">
                    <div class="text-xs">Cats</div>
                    <button class="btn btn-ghost">
                        {{ App\Models\Pet::where('kind', 'Cat')->count() }}
                    </button>
                </li>
            </ul>

            <a class="btn btn-outline mt-3" href="{{ url('pets') }}">Enter</a>
        </div>
    </div>

    {{-- ADOPTIONS --}}
    <div class="card text-white bg-[#0006] w-96 shadow-sm">
        <figure class="h-[240px] w-full overflow-hidden">
            <img class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                src="{{ asset('images/adoptions.png') }}" />
        </figure>

        <div class="card-body">
            <h2 class="card-title">Module Adoptions</h2>

            <ul class="list bg-[#0003] rounded-box shadow-md">
                <li class="list-row">
                    <div class="text-xs">Total</div>
                    <button class="btn btn-ghost">{{ App\Models\Adoption::count() }}</button>
                </li>

                <li class="list-row">
                    <div class="text-xs">Dogs Adopted</div>
                    <button class="btn btn-ghost">
                        {{ App\Models\Pet::where('adopted', 1)->where('kind', 'Dog')->count() }}
                    </button>
                </li>

                <li class="list-row">
                    <div class="text-xs">Cats Adopted</div>
                    <button class="btn btn-ghost">
                        {{ App\Models\Pet::where('adopted', 1)->where('kind', 'Cat')->count() }}
                    </button>
                </li>
            </ul>

            <a class="btn btn-outline mt-3" href="{{ url('adoptions') }}">Enter</a>
        </div>
    </div>

    @endif


    @if (Auth::user()->role == 'Customer')

    {{-- PROFILE --}}
    <div class="card text-white bg-[#0006] w-96 shadow-sm">
        <figure class="h-[240px] w-full overflow-hidden">
            <img class="w-full h-full object-cover"
                src="{{ asset('images/users.png') }}" />
        </figure>

        <div class="card-body">
            <h2 class="card-title">My Profile</h2>
            <a class="btn btn-outline mt-3" href="{{ url('myprofile') }}">Enter</a>
        </div>
    </div>

    {{-- MY ADOPTIONS --}}
    <div class="card text-white bg-[#0006] w-96 shadow-sm">
        <figure class="h-[240px] w-full overflow-hidden">
            <img class="w-full h-full object-cover"
                src="{{ asset('images/adoptions.png') }}" />
        </figure>

        <div class="card-body">
            <h2 class="card-title">
                My Adoptions
                <span class="badge">
                    {{ App\Models\Adoption::where('user_id', Auth::id())->count() }}
                </span>
            </h2>

            <a class="btn btn-outline mt-3" href="{{ url('myadoptions') }}">Enter</a>
        </div>
    </div>

    {{-- MAKE ADOPTION --}}
    <div class="card text-white bg-[#0006] w-96 shadow-sm">
        <figure class="h-[240px] w-full overflow-hidden">
            <img class="w-full h-full object-cover"
                src="{{ asset('images/adoptions.png') }}" />
        </figure>

        <div class="card-body">
            <h2 class="card-title">Make Adoption</h2>
            <a class="btn btn-outline mt-3" href="{{ url('makeadoption') }}">Enter</a>
        </div>
    </div>

    @endif

</div>
@endsection