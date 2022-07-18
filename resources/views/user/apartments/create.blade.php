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
                    <div class="form-group row title m-0 py-1">
                        <label class="col-form-label px-0" for="title">Title</label>
                        <input class="form-control" type="text" name="title" id="title">
                    </div>

                    <!-- IMAGE -->
                    <div class="form-group row image m-0 py-1">
                        <label class="col-form-label px-0" for="img">Image</label>
                        <input class="form-control" type="file" name="img" id="img">
                    </div>

                    <!-- COUNTRY -->
                    <div class="form-group row title m-0 py-1">
                        <label class="col-form-label px-0" for="country">Country</label>
                        <input class="form-control" type="text" name="country" id="country">
                    </div>

                    <!-- TITLE -->
                    <div class="form-group row title m-0 py-1">
                        <label class="col-form-label px-0" for="city">City</label>
                        <input class="form-control" type="text" name="city" id="city">
                    </div>

                    <!-- ADDRESS -->
                    <div class="d-flex gap-4">
                        <div class="form-group row image m-0 py-1">
                            <label class="col-form-label px-0" for="street">Street</label>
                            <input class="form-control" type="text" name="street" id="street">
                        </div>
                        <div class="form-group row image m-0 py-1">
                            <label class="col-form-label px-0" for="street_number">Street Number</label>
                            <input class="form-control" type="number" name="street_number" id="street_number">
                        </div>
                        <div class="form-group row image m-0 py-1">
                            <label class="col-form-label px-0" for="zip_code">Zip Code</label>
                            <input class="form-control" type="text" name="zip_code" id="zip_code">
                        </div>
                    </div>

                    <div class="d-flex gap-4">
                        <!-- MQ -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="square_meters">SQ</label>
                            <input class="form-control" type="number" name="square_meters" id="square_meters">
                        </div>
                        
                        <!-- ROOMS -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="rooms_number">Rooms</label>
                            <input class="form-control" type="number" name="rooms_number" id="rooms_number">
                        </div>
                    </div>

                    <div class="d-flex gap-4">
                        <!-- BEDS -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="beds_number">Beds</label>
                            <input class="form-control" type="number" name="beds_number" id="beds_number">
                        </div>
                        
                        <!-- BATHROOMS -->
                        <div class="form-group row image m-0 py-1 w-50">
                            <label class="col-form-label px-0" for="bathrooms_number">Bathrooms</label>
                            <input class="form-control" type="number" name="bathrooms_number" id="bathrooms_number">
                        </div>
                    </div>
            
                    <div class="d-flex align-items-center">
<!--                             DAILY PRICE
                        <div class="form-group row image m-0 py-1 w-50 pe-3">
                            <label class="col-form-label px-0" for="daily_price">Daily price</label>
                            <input class="form-control" type="number" name="daily_price" id="daily_price">
                        </div> -->

                        <!-- VISIBILITY -->
                        <!-- <div class="visibility d-flex flex-column gap-2 align ps-3">
                            <p class="m-0 p-0 pb-1">Make visible</p>
                            <div class="d-flex gap-5">
                                <div class="yes">
                                    <label for="YES"> YES</label>
                                    <input type="radio" name="visibility" id="YES" value="true">
                                </div>
                                <div class="no">
                                    <label for="NO"> NO</label>
                                    <input type="radio" name="visibility" id="NO" value="false">
                                </div>
                            </div>
                        </div> -->
                        <div class="visibility">
                            <label for="visibility">visibility </label>
                            <input type="number" name="visibility" id="visibility">
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