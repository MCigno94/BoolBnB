@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left-sidebar -->
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

            <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Visibility</th>
            </tr>
        </thead>
        <tbody>
            @forelse($apartments as $apartment)
            <tr>
                <td>{{$apartment->title}}</td>
                <td>
                    <img width="150" src="{{ ($apartment->img === 'Case-moderne.jpg') ? asset('img/Case-moderne.jpg') : asset('storage/' . $apartment->img) }}" alt="{{$apartment->title}}">
                </td>
                <td class="text-center align-middle">
                @if ($apartment->visibility === "true") 
                    <i style="color: green" class="fas fa-circle mx-2"></i>
                @else
                    <i style="color: red" class="fas fa-circle mx-2"></i>
                @endif

                </td>

                <td class="align-middle">
                    <div>
                        <a class="btn btn-primary" href="{{route('user.apartments.show',$apartment->id)}}">Views</a>
                        <a class="btn btn-secondary" href="{{route('user.apartments.edit',$apartment->id)}}">Edit</a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-apartment-{{$apartment->id}}">
                            Delete
                        </button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="delete-apartment-{{$apartment->id}}" tabindex="-1" aria-labelledby="modelTitle-{{$apartment->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete apartment "<span class="text-primary">{{$apartment->title}}</span>"</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{route('user.apartments.destroy',$apartment->id)}}" method="apartment">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td scope="row">Nothing</td>
            </tr>
            @endforelse
        </tbody>
    </table>



    <!-- ------------------------------------------------------------------------------------------ -->



            
            <!-- <div class="d-flex flex-wrap gap-4">
                @foreach($apartments as $apartment)
                <div class="card">
                    <img src="{{ ($apartment->img === 'Case-moderne.jpg') ? asset('img/Case-moderne.jpg') : asset('storage/' . $apartment->img) }}" alt="{{$apartment->title}}">
                    <div class="card-body">
                        <h2>{{$apartment->title}}</h2>
                        <p>{{$apartment->description}}</p>
                        <div class="visibility">
                            @if ($apartment->visibility === "true") 
                                {{-- <i class="fas fa-circle mr-2"></i> --}}
                                <span class="mx-3"><i style="color: green" class="fas fa-circle mx-2"></i>Visible</span>
                            @else
                                <span class="mx-3"><i style="color: red" class="fas fa-circle mx-2"></i> Not Visible</span>
                            @endif
                        </div>

                        <div class="buttons d-flex justify-content-between">
                            <a class="btn btn-primary" href="{{route('user.apartments.show',$apartment->id)}}">Views</a>
                            <a class="btn btn-secondary" href="{{route('user.apartments.edit',$apartment->id)}}">Edit</a>

                            <form action="{{route('user.apartments.destroy',$apartment->id)}}" method="apartment">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </div>
                    </div>

                </div>
                @endforeach
            </div> -->
        </main>
    </div>
</div>
@endsection