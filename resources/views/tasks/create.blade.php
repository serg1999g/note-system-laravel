@extends('layout')

@section('content')

@include('errors')
@include('textEditor')

<div class="container">
    <h3>Create task</h3>
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['route' => 'tasks.store', 'enctype' => 'multipart/form-data'])!!}
            {{ csrf_field() }}
            <div class="form-groi">
                <input type="text" class="form-control" name="title" value="{{old('title')}}">
                <br>
                <textarea name="description" id="" cols="30" rows="10" class="form-control">{{ old('description')}}</textarea>
                <br>
                <button class="btn btn-success">Submit</button>
                <a href="{{route('tasks.index')}}" class="btn btn-success">Back</a>
            </div>

            <div class="wrapper">
                <div class="wrapper-input-images">
                    {!! Form::file('image') !!}
{{--                    <input type="file" name="image" class="image-input">--}}
                </div>
            </div>

            {!! Form::close() !!}

{{--                <img class="img-fluid" src="{{ asset('/storage/' . $path) }}" alt="">--}}

        </div>
    </div>
</div>
@endsection