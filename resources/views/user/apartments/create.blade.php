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
        <div class="form col bg-danger d-flex align-items-center justify-content-center">
            <div class="text-white">
                <form action="{{route('user.apartments.store')}}" class="ms-4" method="post" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group row title m-0 py-1">
                        <label class="col-form-label text-md-right p-0" for="title">Titolo</label>
                        <textarea class="form-control"  name="title" cols="30" rows="10" id="title" placeholder="titolo descrittivo"></textarea>
                    </div>

                    <div class="rooms_number">
                        <label for="rooms_number">Numero di camere </label>
                        <input type="number" name="rooms_number" id="rooms_number">
                    </div>
                    
                    <div class="beds_number">
                        <label for="beds_number">Numero letti </label>
                        <input type="number" name="beds_number" id="beds_number">
                    </div>
                    
                    <div class="bathrooms_number">
                        <label for="bathrooms_number">Numero bagni </label>
                        <input type="number" name="bathrooms_number" id="bathrooms_number">
                    </div>
                    
                    <div class="square_meters">
                        <label for="square_meters">Metri quadri dell'appartamento </label>
                        <input type="number" name="square_meters" id="square_meters">
                    </div>

                    <div class="country">
                        <label for="country">Country </label>
                        <input type="text" name="country" id="country">
                    </div>

                    <div class="city">
                        <label for="city">city </label>
                        <input type="text" name="city" id="city">
                    </div>

                    <div class="street">
                        <label for="street">street </label>
                        <input type="text" name="street" id="street">
                    </div>

                    <div class="street_number">
                        <label for="street_number">street number </label>
                        <input type="number" name="street_number" id="street_number">
                    </div>

                    <div class="zip_code">
                        <label for="zip_code">zip_code </label>
                        <input type="text" name="zip_code" id="zip_code">
                    </div>

                    <div class="form-group row image m-0 py-1">
                        <label class="col-form-label text-md-right p-0" for="img">Immagine dell'apartamento</label>
                        <input class="form-control" type="file" name="img" id="img">
                    </div>

                    <div class="visibility">
                        <label for="visibility">visibility </label>
                        <input type="number" name="visibility" id="visibility">
                    </div>

                    <button type="submit">invia</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection