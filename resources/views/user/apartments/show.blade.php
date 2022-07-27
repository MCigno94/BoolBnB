@extends('layouts.app')



@section('js-search')

    <script src="{{asset('js/search.js')}}" async> </script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

@endsection

@section('content')


<section class="container my-3">
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
                
                <a class="btn btn-light" href="{{route('user.messages.index', $apartment->id)}}">
                    <i class="fa-solid fa-pen-to-square pe-2 text-primary"></i>Message
                </a>
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

    <!-- NAV ARROWS -->
    <!-- <div class="d-flex justify-content-end gap-3">
        <a class="nav-link mb-2" href="#">
            <i class="fa-solid fa-chevron-left fs-2 text-danger"></i>
        </a>

        <a class="nav-link mb-2" href="#">
            <i class="fa-solid fa-chevron-right fs-2 text-danger"></i>
        </a>
    </div> -->

    <div>
        <h1>{{$apartment->title}}</h1>
        <div class="img_container">
            <img class="apartment_img" src="{{asset('storage/' . $apartment->img)}}"
            alt="{{$apartment->title}}">
        </div>
    </div>
    <div class="container mt-5">
        <div class="row d-flex justify-content-around">
        <div class="col">
            <h2>Description</h2>
            <p>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ducimus excepturi eaque aliquid
            sit perspiciatis cum quasi omnis molestiae odit blanditiis nisi officia deleniti similique nobis, provident doloremque
            expedita ullam suscipit veritatis natus maiores? Nisi voluptas inventore temporibus quia eveniet distinctio consequuntur
            nemo odit, esse, voluptatum facere nostrum voluptate quam necessitatibus dolorum at tenetur. Eos repellendus beatae maiores,
            iusto laborum, qui autem tenetur ullam, aut velit natus dignissimos labore vitae delectus accusantium cupiditate tempore commodi
            ipsa voluptatem provident. Ipsa iure, quasi adipisci alias laudantium maiores et obcaecati totam deserunt sit dicta fuga in dignissimos
            quam quas consectetur. Enim id libero incidunt!
            </p>
        </div>
       <div class="col">
        <h2>Map</h2>
        <div id="map" style="width: 500px; height: 300px;" latitude='{{$apartment->latitude}}' longitude='{{$apartment->longitude}}'></div>
       </div>
    </div>
    <div class="mes-host pt-5 d-flex">
        <div class="w-50 ps-3">
            <h2>Services</h2>
            <div class="p-1">
            @foreach($services as $service)
                        <div class="col">
                            <span>
                                <span>
                                    <i class="{{ $service->icon }} ps-1 pe-3" style="width: 8px;"></i>
                                </span>
                                <span>{{ $service->name }}</span>
                            </span>
                        </div>
             @endforeach
            </div>
        </div>
        <div>
          <h3>Send a message</h3>


          <form>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text"></div>
  </div>
            <textarea type="text" cols="60" rows="10" class="form-control mt-3" name="" id="" aria-describedby="helpId" placeholder=""></textarea>
            <button type="submit" class="btn btn-danger mt-3">Send</button>
</form>
        </div>
    </div>
    </div>
</section>
@endsection
