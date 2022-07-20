@extends('layouts.app')

@section('content')


<div class="container ct-form bg-white bg-md-gray">
    <div class="row row-cols-1 row-cols-md-2 h-100 align-items-center justify-content-center">
        <div class="col d-none d-md-block">
            <div class="logo text-center">
                <div>
                    <img src="{{asset('img/logo.png')}}" alt="">
                </div>
                <div class="logo-text display-3 text-white">
                    BoolBnB
                </div>
            </div>
        </div>

        @include('partials.error')

        <div class="form col bg-danger d-flex align-items-center justify-content-center py-5">
            <div class="text-white">
                <form  action="{{route('user.apartments.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <h2 class="text-center display-4 pb-4">Add new apartment</h2>
                    
                    <!-- TITLE -->
                    <div class="form-group row title m-0 py-1 @error('title') is-invalid @enderror">
                        <label class="col-form-label px-0" for="title">Title</label>
                        <input class="form-control" type="text" name="title" id="title">
                        <small class="form-text text-white">{{$errors->first('title')}}</small>
                    </div>    

                    <!-- IMAGE -->
                    <div class="form-group row image m-0 py-1">
                        <label class="col-form-label px-0" for="img">Image</label>
                        <input class="form-control" type="file" name="img" id="img">
                        <small class="form-text text-white">{{$errors->first('img')}}</small>
                    </div>

                    <!-- @error('cover_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror -->

                    <!-- COUNTRY -->
                    <div class="form-group row title m-0 py-1">
                        <label class="col-form-label px-0" for="country">Country</label>
                        <input class="form-control" type="text" name="country" id="country">
                        <small class="form-text text-white">{{$errors->first('country')}}</small>

                    </div>

                    <!-- TITLE -->
                    <div class="form-group row title m-0 py-1">
                        <label class="col-form-label px-0" for="city">City</label>
                        <input class="form-control" type="text" name="city" id="city">
                        <small class="form-text text-white">{{$errors->first('city')}}</small>

                    </div>

                    <!-- ADDRESS -->
                    <div class="d-flex gap-4">
                        <div class="form-group row image m-0 py-1">
                            <label class="col-form-label px-0" for="street">Street</label>
                            <input class="form-control" type="text" name="street" id="street">
                            <small class="form-text text-white">{{$errors->first('street')}}</small>
                        </div>
                        <div class="form-group row image m-0 py-1">
                            <label class="col-form-label px-0" for="street_number">Street Number</label>
                            <input class="form-control" type="number" name="street_number" id="street_number">
                            <small class="form-text text-white">{{$errors->first('street_number')}}</small>
                        </div>
                        <div class="form-group row image m-0 py-1">
                            <label class="col-form-label px-0" for="zip_code">Zip Code</label>
                            <input class="form-control" type="text" name="zip_code" id="zip_code">
                            <small class="form-text text-white">{{$errors->first('zip_code')}}</small>
                        </div>
                    </div>

                    <div class="d-flex gap-4">
                        <!-- MQ -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="square_meters">SQ</label>
                            <input class="form-control" type="number" name="square_meters" id="square_meters">
                            <small class="form-text text-white">{{$errors->first('square_meters')}}</small>
                        </div>
                        
                        <!-- ROOMS -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="rooms_number">Rooms</label>
                            <input class="form-control" type="number" name="rooms_number" id="rooms_number">
                            <small class="form-text text-white">{{$errors->first('rooms_number')}}</small>
                        </div>
                    </div>

                    <div class="d-flex gap-4">
                        <!-- BEDS -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="beds_number">Beds</label>
                            <input class="form-control" type="number" name="beds_number" id="beds_number">
                            <small class="form-text text-white">{{$errors->first('beds_number')}}</small>
                        </div>
                        
                        <!-- BATHROOMS -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="bathrooms_number">Bathrooms</label>
                            <input class="form-control @error('img') is-invalid @enderror" type="number" name="bathrooms_number" id="bathrooms_number">
                            <!-- <small class="form-text text-white">{{$errors->first('bathrooms_number')}}</small> -->
                        </div>
                    </div>

                    @foreach($services as $service)
                    <div>
                        <label>
                            <input type="checkbox" name="services[]" value="{{$service->id}}">
                            <span>{{ $service->name }}</span>
                        </div>
                        @endforeach
                    </div>
            
                    <div class="d-flex align-items-center gap-5 pt-4">
                        <!-- BUTTON -->
                        <div class="button">
                            <button class="btn btn-light text-danger fw-bold px-5" type="submit">ADD</button>
                        </div>

                        <!-- VISIBILITY -->
                        <div class="visibility d-flex gap-2 pt-1">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" style="transform: scale(1.75)">
                                <label class="form-check-label ms-3" for="flexSwitchCheckChecked">Make visible</label>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection