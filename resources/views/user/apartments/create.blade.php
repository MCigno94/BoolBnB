@extends('layouts.app')

@section('content')


<div class="container ct-form bg-white bg-md-gray">
    <div class="row row-cols-1 row-cols-md-2 h-100 align-items-center justify-content-center">
        <div class="col d-none d-md-block">
            <div class="logo text-center">
                <div>
                    <img src="{{asset('img/logo.png')}}" alt="">
                </div>
                <div class="logo-text display-3 text-danger">
                    BoolBnB
                </div>
            </div>
        </div>

        <div class="form col bg-danger d-flex align-items-center justify-content-center py-5">
            <div class="text-white">
                <form  action="{{route('user.apartments.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <h2 class="text-center display-4 pb-4">Add new apartment</h2>
                    
                    <!-- TITLE -->
                    <div class="form-group row title m-0 py-1 @error('title') is-invalid @enderror">
                        <label class="col-form-label px-0" for="title">Title</label>
                        <input class="form-control @error('title') is-invalid @enderror" required type="text" name="title" id="title">
                        <small class="form-text text-white">{{$errors->first('title')}}</small>
                    </div>    

                    <!-- IMAGE -->
                    <div class="form-group row image m-0 py-1">
                        <label class="col-form-label px-0" for="img">Image</label>
                        <input class="form-control @error('img') is-invalid @enderror" type="file" name="img" id="img">
                        <small class="form-text text-white">{{$errors->first('img')}}</small>
                    </div>

                    <!-- @error('cover_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror -->

                    <!-- ADDRESS -->
                    <div class="d-flex gap-4">
                        <div class="form-group row image m-0 py-1">
                            <label class="col-form-label px-0" for="address">Address</label>
                            <input class="form-control @error('address') is-invalid @enderror" required type="text" name="address" id="address">
                            <small class="form-text text-white">{{$errors->first('address')}}</small>
                            <div class="result" hidden></div>
                        </div>

                        <!-- LATITUDE -->
                        <input hidden type="text" class="form-control @error('latitude') is-invalid @enderror mx-5" 
                        name="latitude" id="latitude" value="{{ old('latitude') }}" >
                        <!-- LONGITUDE -->
                        <input hidden type="text" class="form-control @error('longitude') is-invalid @enderror mx-5" 
                        name="longitude" id="longitude" value="{{ old('longitude') }}">
                    </div>

                    <div class="d-flex gap-4">
                        <!-- MQ -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="square_meters">SQ</label>
                            <input class="form-control @error('square_meters') is-invalid @enderror" type="number" min="9" name="square_meters" id="square_meters">
                            <small class="form-text text-white">{{$errors->first('square_meters')}}</small>
                        </div>
                        
                        <!-- ROOMS -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="rooms_number">Rooms</label>
                            <input class="form-control @error('rooms_number') is-invalid @enderror" type="number" min="1" name="rooms_number" id="rooms_number">
                            <small class="form-text text-white">{{$errors->first('rooms_number')}}</small>
                        </div>
                    </div>

                    <div class="d-flex gap-4">
                        <!-- BEDS -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="beds_number">Beds</label>
                            <input class="form-control @error('beds_number') is-invalid @enderror" type="number" min="1" name="beds_number" id="beds_number">
                            <small class="form-text text-white">{{$errors->first('beds_number')}}</small>
                        </div>
                        
                        <!-- BATHROOMS -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="bathrooms_number">Bathrooms</label>
                            <input class="form-control @error('bathrooms_number') is-invalid @enderror" type="number" min="1" name="bathrooms_number" id="bathrooms_number">
                            <small class="form-text text-white">{{$errors->first('bathrooms_number')}}</small>
                        </div>
                    </div>

                    
                    <!-- SERVICES -->
                    <label class="col-form-label px-0 pt-3" for="services">Services</label>
                    <div class="row row-cols-2 row-cols-xl-3">
                    @foreach($services as $service)
                        <div class="col">
                            <input type="checkbox" name="services[]" value="{{$service->id}}">
                            <span>
                                <span>
                                    <i class="{{ $service->icon }} ps-1 pe-3" style="width: 8px;"></i>
                                </span>
                                <span>{{ $service->name }}</span>
                            </span>
                        </div>
                        @endforeach
                    </div>
            
                    <div class="d-flex align-items-center">
                        <div class="visibility">
                            <label for="visibility">visibility </label>
                            <input class="mt-5 ms-3" Style="width:25px; height:25px" type="checkbox" name="visibility" id="visibility" value="true">
                        </div>
                    </div>

                    <!-- BUTTON -->
                    <div class="button pt-5">
                        <button class="btn btn-light text-danger fw-bold w-25" type="submit">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection