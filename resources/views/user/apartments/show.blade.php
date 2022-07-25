@extends('layouts.app')



@section('js-search')

    <script src="{{asset('js/search.js')}}" async> </script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

@endsection

@section('content')

<div id="map" style="width: 450px; height: 450px;"></div>
<section class="container my-3">

    <!-- NAV ARROWS -->
    <!-- <div class="d-flex justify-content-end gap-3">
        <a class="nav-link mb-2" href="#">
            <i class="fa-solid fa-chevron-left fs-2 text-danger"></i>
        </a>

        <a class="nav-link mb-2" href="#">
            <i class="fa-solid fa-chevron-right fs-2 text-danger"></i>
        </a>
    </div> -->

    <div class="card">

        <div class="img_container">
            
            <img class="apartment_img" src="{{ ($apartment->img === 'Case-moderne.jpg') ? asset('img/Case-moderne.jpg') : asset('storage/' . $apartment->img) }}" alt="{{$apartment->title}}">
        </div>
        <h1>{{$apartment->title}}</h1>
    </div>

    <!-- BUTTONS -->
    <div class="d-flex align-items-center justify-content-between">
        <div class="visibility">
            @if ($apartment->visibility) 
                {{-- <i class="fas fa-circle mr-2"></i> --}}
                <span class="mx-3"><i style="color: green" class="fas fa-circle mx-2"></i>Visible</span>
            @else
                <span class="mx-3"><i style="color: red" class="fas fa-circle mx-2"></i> Not Visible</span>
            @endif
        </div>
        
        <div class="buttons d-flex gap-2">
            <div class="button">
                <a class="btn btn-light" href="{{route('user.apartments.edit', $apartment->id)}}">
                    <i class="fa-solid fa-pen-to-square pe-2 text-primary"></i>Edit
                </a>
            </div>
            <button class="btn" type="submit" data-bs-toggle="modal" data-bs-target="#delete-apartment-{{$apartment->id}}">
                <i class="fa-solid fa-trash pe-2 text-danger"></i>Delete
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
                        <form action="{{route('user.apartments.destroy',$apartment->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection