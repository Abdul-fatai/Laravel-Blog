@extends('layouts.app')

@section('content')
<a href="/posts" class="mb-3 btn btn-outline-secondary">Go back</a><br>
<div class="bg-white p-5">
    <picture>
            <img style="width: 50%,"  src="/storage/cover_images/{{$post->cover_image}}" class="img-fluid" alt="Single-Image">
    </picture>

    <h1 class="mt-4">{{$post->title}}</h1>
    
            <div class="badge  bg-dark">
                {{$post->tag_name}}
            </div><br>
       
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
    <h3 style="border-bottom: 5px solid red">Comments</h3>
        @foreach($comments as $comment)
            <div>
                <article class="bg-light mb-3 p-2">
                    <img src='https://png.pngtree.com/svg/20170920/4ff36bf59e.svg' class='img-rounded float-left m-1' width='50px' height='40px'>
                    <h4 class="mt-3"> {{$comment->name}} <span style="color: red; font-size: 15px;">says:</span></h4>
                     <small class='float-right pr-2'>{{$comment->created_at}}</small>
                     <div>
                    <p class="ml-5">{{$comment->message}}</p>
                     </div>
                  </article>
            </div>
        @endforeach

        @include('inc.message')
        <div class="bg-light p-4">
                <h3 class="">Leave a Comment</h3>
            <form action="/comments" method="POST">
                @csrf 
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="message" cols="30" rows="5" placeholder="Body text"></textarea>
                </div>
                <input type="submit" class="btn btn-primary btnlg" value="Comment">
            </form>
        </div>
</div>
@endsection