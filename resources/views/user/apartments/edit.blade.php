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
                <form  action="{{route('user.apartments.update', $apartment->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <h2 class="text-center display-4 pb-4">Edit your apartment</h2>
                    
                    <!-- TITLE -->
                    <div class="form-group row title m-0 py-1">
                        <label class="col-form-label px-0" for="title">Title</label>
                        <input class="form-control" type="text" name="title" id="title" value="{{old('title', $apartment->title)}}">
                    </div>

                    <!-- IMAGE -->
                    <div class="form-group row image m-0 py-1">
                        <label class="col-form-label px-0" for="img">Image</label>
                        <div class="d-flex gap-4 px-0">
                            <img src="{{asset('storage/' . $apartment->img)}}" style="width: 200px;" alt="">
                            <input class="form-control align-self-end" type="file" name="img" id="img" value="">
                        </div>
                    </div>

                    <!-- COUNTRY -->
                    <div class="form-group row title m-0 py-1">
                        <label class="col-form-label px-0" for="country">Country</label>
                        <input class="form-control" type="text" name="country" id="country" value="{{old('country', $apartment->country)}}">
                    </div>

                    <!-- TITLE -->
                    <div class="form-group row title m-0 py-1">
                        <label class="col-form-label px-0" for="city">City</label>
                        <input class="form-control" type="text" name="city" id="city" value="{{old('city', $apartment->city)}}">
                    </div>

                    <!-- ADDRESS -->
                    <div class="d-flex gap-4">
                        <div class="form-group row image m-0 py-1">
                            <label class="col-form-label px-0" for="street">Street</label>
                            <input class="form-control" type="text" name="street" id="street" value="{{old('street', $apartment->street)}}">
                        </div>
                        <div class="form-group row image m-0 py-1">
                            <label class="col-form-label px-0" for="street_number">Street Number</label>
                            <input class="form-control" type="number" name="street_number" id="street_number" value="{{old('street_number', $apartment->street_number)}}">
                        </div>
                        <div class="form-group row image m-0 py-1">
                            <label class="col-form-label px-0" for="zip_code">Zip Code</label>
                            <input class="form-control" type="text" name="zip_code" id="zip_code" value="{{old('zip_code', $apartment->zip_code)}}">
                        </div>
                    </div>

                    <div class="d-flex gap-4">
                        <!-- MQ -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="square_meters">SQ</label>
                            <input class="form-control" type="number" name="square_meters" id="square_meters" value="{{old('square_meters', $apartment->square_meters)}}">
                        </div>
                        
                        <!-- ROOMS -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="rooms_number">Rooms</label>
                            <input class="form-control" type="number" name="rooms_number" id="rooms_number" value="{{old('rooms_number', $apartment->rooms_number)}}">
                        </div>
                    </div>

                    <div class="d-flex gap-4">
                        <!-- BEDS -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="beds_number">Beds</label>
                            <input class="form-control" type="number" name="beds_number" id="beds_number" value="{{old('beds_number', $apartment->beds_number)}}">
                        </div>
                        
                        <!-- BATHROOMS -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="bathrooms_number">Bathrooms</label>
                            <input class="form-control" type="number" name="bathrooms_number" id="bathrooms_number" value="{{old('bathrooms_number', $apartment->bathrooms_number)}}">
                        </div>
                    </div>


                    <label class="col-form-label px-0 pt-3" for="services">Services</label>
                    <div class="row row-cols-2 row-cols-xl-3">
                    @foreach($services as $id => $service)
                        <div class="col">
                        <input type="checkbox" name="services[]" value="{{ $id }}"
                                {{ ( is_array(old('services')) && in_array($id, old('services')) ) ? 'checked ' : '' }}>
                            <span>{{ $service->name }}</span>
                        </div>
                        @endforeach
                    </div>
            
                    <div class="d-flex align-items-center gap-5 pt-4">
                        <!-- BUTTON -->
                        <div class="button">
                            <button class="btn btn-light text-danger fw-bold px-5" type="submit">EDIT</button>
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