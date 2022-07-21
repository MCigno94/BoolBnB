@extends('layouts.app')

@section('content')
<div class="container ct-form bg-white">
    <div class="row row-cols-1 row-cols-md-2 h-100 align-items-center justify-content-center">

        <!-- ========== Start LOGO ========== -->
        <div class="col d-none d-md-block">
            <div class="logo text-center">
                <img src="{{ asset('img/logo.png')}}" alt="">
                <div class="logo-text display-3 text-danger">
                    BoolBnB
                </div>
            </div>
        </div>
        <!-- ========== End LOGO ========== -->
        
        <div class="form col bg-danger d-flex align-items-center justify-content-center py-5">
            <div class="text-white">

                @if ($errors->any())
                    <div class="alert alert-primary">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <h2 class="text-center display-4 pb-4">Register</h2>

                    <!-- ========== Start EMAIL ========== -->
                    <div class="form-group row">
                        <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address *') }}</label>
                        <div class="">
                            <input id="email" type="email" required class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback text-white" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- ========== End EMAIL ========== -->


                    <!-- ========== Start PASSWORD ========== -->
                    <div class="form-group row">
                        <label for="password" class="col-form-label text-md-right">{{ __('Password *') }}</label>
                        <div class="">
                            <input id="password" required min="8" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback text-white" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- ========== End PASSWORD ========== -->


                    <!-- ========== Start CONFIRM PASSWORD ========== -->
                    <div class="form-group row">
                        <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password *') }}</label>
                        <div class="">
                            <input id="password-confirm" required type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        </div>
                        @error('password')
                            <span class="invalid-feedback text-white" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- ========== End CONFIRM PASSWORD ========== -->


                    <!-- ========== Start NAME ========== -->
                    <div class="form-group row">
                        <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>
                        <div class="">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                        </div>
                    </div>
                    <!-- ========== End NAME ========== -->


                    <!-- ========== Start SURNAME ========== -->
                    <div class="form-group row">
                        <label for="surname" class="col-form-label text-md-right">{{ __('Surname') }}</label>

                        <div class="">
                            <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}" autocomplete="surname" autofocus>
                        </div>
                    </div>
                    <!-- ========== End SURNAME ========== -->


                    <!-- ========== Start BIRTH_DATE ========== -->
                    <div class="form-group row">
                        <label for="birth_date" class="col-form-label text-md-right">{{ __('Birth date') }}</label>
                        @php
                            $currentDate=intval(date("Y"));
                            $maxDate= $currentDate - 18;
                            $finalDate=date("$maxDate-m-d");                        
                        @endphp
                        <div class="">
                            <input id="birth_date" type="date" class="form-control" name="birth_date" value="{{ old('birth_date') }}" autocomplete="birth_date" min="1900-01-01" max= "{{ $finalDate }}" >                        
                        </div>
                    </div>
                    <!-- ========== End BIRTH_DATE ========== -->


                    <!-- ========== Start BUTTONS ========== -->
                    <div class="form-group pt-5">
                        <div class="d-flex">
                            <button type="submit" class="btn btn-light text-danger fw-bold w-25">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                    <!-- ========== End BUTTONS ========== -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection