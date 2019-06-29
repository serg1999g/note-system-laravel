@extends('layout')

@section('content')
<div class="container-fluid">
    <h3>My tasks</h3>
    <a href="{{ route('tasks.create')}}" class="btn btn-success">Create</a>
    <a href="{{ route('tasks.import')}}" class="btn btn-success">Import</a>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="table">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Title</td>
                        <td>Description</td>
                        <td>Action</td>
                    </tr>
                </thead>

                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>{{$task->id}}</td>
                        <td>{{$task->title}}</td>
                        <td>{{Str::limit($task->description, 150)}}</td>
                        <td></td>
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