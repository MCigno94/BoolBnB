@extends('layouts.app')

@section('content')  
<section class="container my-3">

    <!-- NAV ARROWS -->
    <div class="d-flex justify-content-end gap-3">
        <a class="nav-link mb-2" href="#">
            <i class="fa-solid fa-chevron-left fs-2 text-danger"></i>
        </a>

        <a class="nav-link mb-2" href="#">
            <i class="fa-solid fa-chevron-right fs-2 text-danger"></i>
        </a>
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
            <form action="{{route('user.apartments.destroy', $apartment->id)}}" method="post">
                @csrf
                @method('DELETE')

                    <button class="btn" type="submit">
                        <i class="fa-solid fa-trash pe-2 text-danger"></i>Delete
                    </button>

            </form>
        </div>
    </div>
        <h1 class="mr-2">{{ $apartment->title }}</h1>
</section>
@endsection