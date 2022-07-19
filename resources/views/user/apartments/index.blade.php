@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 bg-light d-none d-md-block sidebar">
            <div class="left-sidebar">
                <ul class="nav flex-column sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('user.apartments.store')}}">
                            <svg class="bi bi-chevron-right" width="16" height="16" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6.646 3.646a.5.5 0 01.708 0l6 6a.5.5 0 010 .708l-6 6a.5.5 0 01-.708-.708L12.293 10 6.646 4.354a.5.5 0 010-.708z" clip-rule="evenodd" />
                            </svg>
                            Apartments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <svg class="bi bi-chevron-right" width="16" height="16" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6.646 3.646a.5.5 0 01.708 0l6 6a.5.5 0 010 .708l-6 6a.5.5 0 01-.708-.708L12.293 10 6.646 4.354a.5.5 0 010-.708z" clip-rule="evenodd" />
                            </svg>
                            Inbox
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <svg class="bi bi-chevron-right" width="16" height="16" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6.646 3.646a.5.5 0 01.708 0l6 6a.5.5 0 010 .708l-6 6a.5.5 0 01-.708-.708L12.293 10 6.646 4.354a.5.5 0 010-.708z" clip-rule="evenodd" />
                            </svg>
                            Booking
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <svg class="bi bi-chevron-right" width="16" height="16" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6.646 3.646a.5.5 0 01.708 0l6 6a.5.5 0 010 .708l-6 6a.5.5 0 01-.708-.708L12.293 10 6.646 4.354a.5.5 0 010-.708z" clip-rule="evenodd" />
                            </svg>
                            Ads
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <svg class="bi bi-chevron-right" width="16" height="16" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6.646 3.646a.5.5 0 01.708 0l6 6a.5.5 0 010 .708l-6 6a.5.5 0 01-.708-.708L12.293 10 6.646 4.354a.5.5 0 010-.708z" clip-rule="evenodd" />
                            </svg>
                            Profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <h3>Apartments</h3>
            <hr>
            <div class="add_apartment pb-4">
                <div class="button">
                    <a class="btn btn-primary text-white" href="{{route('user.apartments.create')}}" role="button">Add New Apartment</a>
                </div>
                @include('partials.message')
            </div>
            <div class="d-flex flex-wrap gap-4">
                @foreach($apartments as $apartment)
                <div class="card">
                    <img class="card-img-top" src="{{$apartment->image}}" alt="un immagine bella bella" style="height: 200px">
                    <div class="card-body">
                        <h2>{{$apartment->title}}</h2>
                        <p>{{$apartment->description}}</p>
                        <div>{{$apartment->daily_price}}</div>

                        <div class="buttons d-flex justify-content-between">
                            <a class="btn btn-primary" href="{{route('user.apartments.show',$apartment->id)}}">Views</a>
                            <a class="btn btn-secondary" href="{{route('user.apartments.edit',$apartment->id)}}">Edit</a>

                            <form action="{{route('user.apartments.destroy',$apartment->id)}}" method="post">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
        </main>
    </div>
</div>
@endsection