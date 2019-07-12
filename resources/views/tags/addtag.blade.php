@extends('layouts.app')

@section('content')
@include('inc.message')
    <h3>Add tag</h3>
    <form action="/tags" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="name">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-lg" value="Add">
        </div>
    </form>
@endsection