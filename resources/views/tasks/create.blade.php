@extends('layout')

@section('content')

@include('errors')
@include('textEditor')

<div class="container">
    <h3>Create task</h3>
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('tasks.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="form-groi">
                <input type="text" class="form-control" name="title" value="{{old('title')}}">
                <br>
                <textarea name="description" id="" cols="30" rows="10" class="form-control">{{ old('description')}}</textarea>
                <br>
                <button class="btn btn-success">Submit</button>
                <a href="{{route('tasks.index')}}" class="btn btn-success">Back</a>
                <button class="btn btn-success add-block-image">Add image</button>
            </div>
            <div class="wrapper">
                <div class="wrapper-input-images">
                    <input type="file" name="image-1">
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
