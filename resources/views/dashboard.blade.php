@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-primary">Create Post</a>
                    <h3 class="mt-3">Your Blog Posts</h3>
                    @if(count($posts) > 0)
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>

                    @foreach($posts as $post)
                    <tr>
                            <th><a href="/posts/{{$post->id}}">{{$post->title}}</a></th>
                            <th><a class="btn btn-primary" href="/posts/{{$post->id}}/edit">Edit</a></th>
                            <th>
                                    <form class="form-group" action="/posts/{{$post->id}}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE')}}
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    </form>
                            </th>
                        </tr>
                    @endforeach

                    </table>
                    @else
                    <p>You have no Post</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
