@extends('layouts.app')

@section('content')
<div class="container">
 
    <h1 align="center">Admin Pannel</h1>
{{-- User content --}}

    <p>
        <div class="wt-100" align='center' style="color:white;padding: 15px;background-color:rgb(0,35,0);border-radius:20px 20px 0 0;">
           <span style="font-size: 15pt;letter-spacing:2.5px;"><b>User's Data</b></span>
        </div>
    </p>
   

    <table class="table table-dark" style="cursor:pointer;">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>

        @foreach ($user as $contact)
            @if ($contact->id != 1)
                <tr>
                    <th scope="row">{{$contact->id}}</th>
                    <td>{{$contact->name}}</td>
                    <td>{{$contact->username}}</td>
                    <td>{{$contact->email}}</td>
                    <td> <a href="/remove/user/{{$contact->id}}" class="btn btn-danger">Remove</a></td>
                </tr>    
            @endif
            
        @endforeach

    
    </tbody>
    </table>
    <div class="d-flex justify-content-center pt-4">
        {{$user->links()}}
    </div>


{{-- Gallery content --}}
    <p>
        <div class="wt-100" align='center' style="color:white;padding: 15px;background-color:rgb(0,35,0);">
           <span style="font-size: 15pt;letter-spacing:2.5px;"><b>Gallery</b></span>
           <div style="float:right;"><a href="/p/create" class="btn btn-primary">Add</a></div>
        </div>

    </p>
    <table class="table table-dark" style="cursor:pointer;">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>

        @foreach ($gallery as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->title}}</td>
                <td>{{$item->description}}</td>
                <td>NPR.{{$item->price}}</td>
                <td> 
                    <a href="/remove/{{$item['id']}}" class="btn btn-danger">Remove</a>
                    <a href="/update/{{$item['id']}}" class="btn btn-secondary">Update</a> 
                </td>
            </tr>
        @endforeach    
    </tbody>
    </table>
    <div class="d-flex justify-content-center pt-4" style="padding-bottom: 25em;">
        {{$gallery->links()}}
    </div>



</div>

@endsection
