@extends('layouts.app')

@section('content')
<a href="/posts" class="mb-3 btn btn-outline-secondary">Go back</a><br>
<div class="bg-white p-5">
    <picture>
            <img style="width: 50%,"  src="/storage/cover_images/{{$post->cover_image}}" class="img-fluid" alt="Single-Image">
    </picture>

    <h1 class="mt-4">{{$post->title}}</h1>
    <small> Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <small>{{$post->name}}</small>
    
    <hr>
    <div>
        {!!$post->body!!}
    </div>
    <hr>

    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="float-left btn btn-outline-info">Edit</a>
            <form class="form-group" action="/posts/{{$post->id}}" method="POST">
                @csrf
                {{ method_field('DELETE')}}
                <button type="submit" class=" float-right btn btn-outline-danger">Delete</button>
            </form>
            <br><br><br>
        @endif
    @endif
        

        @include('inc.message')
        <div class="bg-light p-4">
                <h3 class="">Reply</h3>
            <form action="/comments" method="POST">
                @csrf 
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="name">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="message" cols="30" rows="5" placeholder="Body text"></textarea>
                </div>
                <input type="submit" class="btn btn-primary btnlg" value="Comment">
            </form>
        </div>
</div>
@endsection