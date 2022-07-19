@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div class="container">
                    @foreach($apartments as $apartment)
                        <h1>{{$apartment->title}}</h1>
                        <img src="{{ ($apartment->img === 'Case-moderne.jpg') ? asset('img/Case-moderne.jpg') : asset('storage/' . $apartment->img) }}" alt="{{$apartment->title}}">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection