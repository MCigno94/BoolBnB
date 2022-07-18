@extends('layouts.app')

@section('content')

@foreach($apartments as $apartment)
    <h1>{{$apartment->title}}</h1>

    <img src="{{asset('storage/' . $apartment->img) }}" alt="">
    <hr>
@endforeach

@endsection