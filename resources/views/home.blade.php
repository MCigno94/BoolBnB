@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="">
<!--                 <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div> -->
                <div class="container">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                        @foreach($apartments as $apartment)
                        @if($apartment->visibility === "true")
                        <div class="cols">                            
                            <div class="card">

                                <div class="img_container">
                                    
                                    <img class="apartment_img" src="{{ ($apartment->img === 'Case-moderne.jpg') ? asset('img/Case-moderne.jpg') : asset('storage/' . $apartment->img) }}" alt="{{$apartment->title}}">
                                </div>
                                <h5>{{$apartment->title}}</h5>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection