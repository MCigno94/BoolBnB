@extends('layouts.app')

@section('content')

@foreach($apartments as $apartment)
<h1>{{$apartment->title}}</h1>

<img src="{{ ($apartment->img === 'Case-moderne.jpg') ? asset('img/Case-moderne.jpg') : asset('storage/' . $apartment->img) }}" alt="">
<hr>

<div class="buttons d-flex justify-content-between">
    <a class="btn btn-primary" href="{{route('user.apartments.show',$apartment->id)}}">Views</a>
    <a class="btn btn-secondary" href="{{route('user.apartments.edit',$apartment->id)}}">Edit</a>

    <form action="{{route('user.apartments.destroy',$apartment->id)}}" method="post">
        @csrf
        @method('DELETE')

        <button class="btn btn-danger" type="submit">Delete</button>
    </form>
</div>

@endforeach

@endsection