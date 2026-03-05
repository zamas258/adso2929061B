@extends('layputs.app')
@section('title', 'larapets: Dashboard')
@section('content')
<form method="post" action="{{route('logout')}}">
    @csrf
    <a href="route('logout')"
                onclick="event.preventDefault();
                                    this"></a>
</form>
    
@endsection
