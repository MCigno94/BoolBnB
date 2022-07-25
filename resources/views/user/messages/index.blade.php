@extends('layouts.admin')

@section('content')

    
    <div class="container">
        <h2>Messages from {{$apartment->title}}</h2>
        <table>
        <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
        </thead>
        <tbody>
            @forelse($messages as $message)
            <tr>
                <td>{{$message->name}}</td>
                <td>{{$message->email}}</td>
                <td>{{$message->content}}</td>
            </tr>
            @endforelse  
        </tbody>
        </table>
    </div>
    

@endsection