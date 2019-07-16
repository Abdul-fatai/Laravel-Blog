@extends('layouts.app')

@section('content')
@include('inc.message')
    <h1>Create Post</h1>
    <form action="/posts" method="POST" enctype="multipart/form-data">
      @csrf
            <div class="form-group">
              <label>Title</label>
              <input type="text" name="title" class="form-control"  placeholder="Title">
            </div>
            <div class="form-group">
              <label>Body</label>
              <textarea name="body" id="article-ckeditor" class="form-control"  rows="5" placeholder="Body text"></textarea>
            </div>
            <div class="form-group">
              <label>Add Tag</label>
              <select class="form-control" name="tag" id="">
                <option  selected disabled>Select</option>
                
                    @if(count($tags) > 0)
                        @foreach ($tags as $tag)
                        <option >{{$tag->name}}</option>
                         @endforeach
                    @endif
                
              </select>
            </div>
            <div class="form-group">
                <label>File Upload</label>
                <input type="file" name="cover.image" class="form-control">
              </div>
            <button type="submit" class="btn btn-primary btn-lg">Publish</button>
          </form>


@endsection