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

        <div class="form col bg-danger d-flex align-items-center justify-content-center py-5 px-4">
            <div class="text-white">
                <form  action="{{route('user.apartments.update', $apartment->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <h2 class="text-center display-4 pb-4">Edit your apartment</h2>
                    
                    <!-- TITLE -->
                    <div class="form-group row title m-0 py-1 @error('title') is-invalid @enderror">
                        <label  class="col-form-label px-0" for="title">Title*</label>
                        <input  class="form-control @error('title') is-invalid @enderror" 
                                type="text" name="title" id="title" 
                                value="{{old('title', $apartment->title)}}"
                                required
                                >
                        <small class="form-text bg-warning text-danger fw-bold rounded-2">{{$errors->first('title')}}</small>
                    </div>    

                    <!-- IMAGE -->
                    <div class="form-group row image m-0 py-1">
                        <label  class="col-form-label px-0" for="img">Image*</label>
                        <div class="d-flex gap-4 px-0">
                            <img src="{{asset('storage/' . $apartment->img)}}" style="width: 200px;" alt="">
                            <input  class="form-control align-self-end " 
                                type="file" name="img" id="img"
                                value="{{ old('img', $apartment->img)}}"
                                >
                        </div>
                        
                    </div>

                    <!-- ADDRESS -->
                    <div class="form-group row address py-1">
                        <div class="form-group row image m-0 py-1">
                            <label class="col-form-label px-0" for="address">Address*</label>
                            <input  class="form-control @error('address') is-invalid @enderror" 
                                    type="text" name="address" id="address" 
                                    onkeyup="callStreet()"
                                    value="{{old('address', $apartment->address)}}"
                                    required
                                    >
                            <small class="form-text bg-warning text-danger fw-bold rounded-2">{{$errors->first('address')}}</small>
                            <div class="result" hidden></div>
                        </div>
                    </div>

                    <!-- COORDINATE -->
                    <div hidden class="coordinate">
                        <!-- LATITUDE -->
                        <input 
                            hidden 
                            class="form-control @error('latitude') is-invalid @enderror mx-5" 
                            type="text" name="latitude" id="latitude" 
                            value="{{ old('latitude', $apartment->latitude) }}"
                        >
                        <!-- LONGITUDE -->
                        <input 
                            hidden 
                            class="form-control @error('longitude') is-invalid @enderror mx-5" 
                            type="text" name="longitude" id="longitude"
                            value="{{ old('longitude', $apartment->longitude) }}"
                        >
                    </div>

                    <div class="d-flex gap-4">
                        <!-- MQ -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="square_meters">SQ*</label>
                            <input  class="form-control @error('square_meters') is-invalid @enderror" 
                                    type="number" name="square_meters" id="square_meters"
                                    min="1"
                                    value="{{ old('square_meters', $apartment->square_meters) }}"
                                    required
                            >
                            <small class="form-text bg-warning text-danger fw-bold rounded-2">{{$errors->first('square_meters')}}</small>
                        </div>
                        
                        <!-- ROOMS -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="rooms_number">Rooms*</label>
                            <input  class="form-control @error('rooms_number') is-invalid @enderror" 
                                    type="number" name="rooms_number" id="rooms_number"
                                    min="1"
                                    value="{{ old('rooms_number', $apartment->rooms_number) }}"
                                    required
                            >
                            <small class="form-text bg-warning text-danger fw-bold rounded-2">{{$errors->first('rooms_number')}}</small>
                        </div>
                    </div>

                    <div class="d-flex gap-4">
                        <!-- BEDS -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="beds_number">Beds*</label>
                            <input  class="form-control @error('beds_number') is-invalid @enderror" 
                                    type="number" name="beds_number" id="beds_number"
                                    min="1"
                                    value="{{ old('beds_number', $apartment->beds_number) }}"
                                    required
                            >
                            <small class="form-text bg-warning text-danger fw-bold rounded-2">{{$errors->first('beds_number')}}</small>
                        </div>
                        
                        <!-- BATHROOMS -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="bathrooms_number">Bathrooms*</label>
                            <input  class="form-control @error('bathrooms_number') is-invalid @enderror" 
                                    type="number" name="bathrooms_number" id="bathrooms_number"
                                    min="1"
                                    value="{{ old('bathrooms_number', $apartment->bathrooms_number) }}"
                                    required
                            >
                            <small class="form-text bg-warning text-danger fw-bold rounded-2">{{$errors->first('bathrooms_number')}}</small>
                        </div>
                    </div>

                    
                    <!-- SERVICES -->
                    <label class="col-form-label px-0 pt-3" for="services">Services</label>
                    <div class="row row-cols-2 row-cols-xl-3">
                    
                    @foreach($services as $service)
                        <div class="col">
                            <input type="checkbox" name="services[]" value="{{$service->id}}" {{ (in_array($service->id, $ids)) ? 'checked' : 'class="alert"' }}>
                            <span>
                                <span>
                                    <i class="{{ $service->icon }} ps-1 pe-3" style="width: 8px;"></i>
                                </span>
                                <span>{{ $service->name }}</span>
                            </span>
                        </div>
                        @endforeach
                    </div>
            
                    <div class="d-flex pt-5">
                        <div class="visibility d-flex align-items-center">
                            <label for="visibility">Visibility </label>
                            <input class="mx-3" style="width:20px; height:20px" type="checkbox" name="visibility" id="visibility" value="true"
                            {{ ($apartment->visibility === "true") ? 'checked' : '' }}>
                        </div>
                    </div>
                    <!-- BUTTON -->
                    <div class="button pt-3">
                        <button id="btnCreate" class="btn btn-light text-danger fw-bold w-25" type="submit"
                        >EDIT</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection