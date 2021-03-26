@extends('layout')

@section('content')

@include('errors')
@include('textEditor')

<div class="container">
    <h3>Edit task # - {{$task->id}}</h3>
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('tasks.update',$task->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
            <div class="form-groi">
                <input type="text" class="form-control" name="title" value="{{$task->title}}">
                <br>
                <textarea name="description" id="" cols="30" rows="10" class="form-control">{{$task->description}}</textarea>
                <br>
                <button class="btn btn-warning">Submit</button>
                <a href="{{route('tasks.index')}}" class="btn btn-success">Back</a>
                <button class="btn btn-success add-block-image">Add image</button>
            </div>

            <div class="wrapper">
                <div class="wrapper-input-images">
                    <input type="file" name='image-' . {{ count($task->images)+1 }}>
                </div>
            </div>
            </form>

            <div class="wrapper">
                @foreach($task->images as $image)
                    <div class="wrapper-image">
                        <div class="delete">
                            <button class="delete-image" id="{{ $image->id }}" >&#10006;</button>
                        </div>
                        <img src="{{ asset('/storage/' . $image->images)}}"   class="img-edit" alt="">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
