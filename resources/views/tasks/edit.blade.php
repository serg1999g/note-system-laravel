@extends('layout')

@section('content')

@include('errors')
@include('textEditor')

<div class="container">
    <h3>Edit task # - {{$task->id}}</h3>
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['route' => ['tasks.update', $task->id], 'method'=>'PUT', 'enctype' => 'multipart/form-data']) !!}
            {{ csrf_field() }}
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
                    {!! Form::file('image-'.(count($task->image)+1) ) !!}
                </div>
            </div>
            {!! Form::close() !!}

            <div class="wrapper">
                @foreach($task->image as $img)
                    <div class="wrapper-image">
                        <div class="delete">
                            <button class="delete-image" id="{{ $img->id }}" >&#10006;</button>
                        </div>
                        <img src="{{ asset('/storage/' . $img->images)}}"   class="img-edit" alt="">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection