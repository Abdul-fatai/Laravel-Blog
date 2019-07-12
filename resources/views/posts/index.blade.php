@extends('layouts.app')

@section('content')
@include('inc.message')
    <h1>POSTS</h1>
    @if(count($posts) > 0)
        @foreach ($posts as $post)
        <div class="mb-2 card bg-white">
            <div class="card-body">
                <div class="row">
                <div class="col-md-4 col-sm-4">
                <img width="100%" class="img-thumbnail fluid" src="/storage/cover_images/{{$post->cover_image}}" alt="Post Image">
                </div>
                <div class="col-md-8 col-sm-8">
                    <a href="/posts/{{$post->id}}"><h3>{{$post->title}}</h3></a>
                    <div style="height:120px; overflow: hidden">
                        {!!$post->body!!}
                    </div>
                    <small>Written at {{$post->created_at}} by {{$post->user->name}}</small><br>
                    <a class="btn btn-primary" href="/posts/{{$post->id}}">Read More</a>
                </div>
            </div>
        </div>
        </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No Post Found</p>
    @endif
@endsection


            
        