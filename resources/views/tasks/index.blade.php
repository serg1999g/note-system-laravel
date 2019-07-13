@extends('layout')

@section('content')
<div class="container-fluid">
    <h3>My tasks</h3>
    <a href="{{ route('tasks.create')}}" class="btn btn-success">Create</a>
    <a href="{{ route('tasks.import')}}" class="btn btn-success">Import</a>
    <a href="{{ route('tasks.export') }}" class="btn btn-success">Export CSV</a>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="table">
                <thead>
                    <tr>
                        <td class="head-table-style">ID</td>
                        <td class="head-table-style">Title</td>
                        <td class="head-table-style">Description</td>
                        <td class="head-table-style">Image</td>
                        <td class="head-table-style">Action</td>
                    </tr>
                </thead>

                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td class="id">{{$task->id}}</td>
                        <td class="title">{{$task->title}}</td>
                        <td class="description">{!! Str::limit($task->description, 100) !!}</td>
                        <td class="img">

                                @isset($task->image)
                                    @foreach($task->image as $img)
                                        <div class="wrap-img">
                                            <img src="{{ asset('/storage/' . $img->images)}}" alt="">
                                        </div>
                                    @endforeach
                                @endisset

                        </td>
                        <td>
                            <a href="{{route('tasks.show', $task->id)}}">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </a>
                            <a href="{{ route('tasks.edit', $task->id) }}">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            {!! Form::open(['method'=> 'DELETE', 'route' => ['tasks.destroy', $task->id]]) !!}
                            <button onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-remove"></i></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
</div>
@endsection