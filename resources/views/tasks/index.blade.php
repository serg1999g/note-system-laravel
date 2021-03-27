@extends('layout')

@section('content')
<div class="container-fluid">
    <h3>My tasks</h3>
    <a href="{{ route('tasks.create')}}" class="btn btn-success">Create</a>
    <a href="{{ route('tasks.import')}}" class="btn btn-success">Import</a>
    <a href="{{ route('tasks.export') }}" class="btn btn-success">Export CSV</a>
    <div class="row justify-content-center">
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
                        <td class="description">{!! $task->limit !!}</td>
                        <td class="img">

                                @isset($task->images)
                                    @foreach($task->images as $img)
                                        <div class="wrap-img">
                                            <img src="{{ asset('/storage/' . $img->images)}}" alt="">
                                        </div>
                                    @endforeach
                                @endisset

                        </td>
                        <td>
                            <a href="{{route('tasks.show', $task->id)}}">
                                Show
                            </a>
                            <a href="{{ route('tasks.edit', $task->id) }}">
                                Edit
                            </a>
                            <form action="{{'tasks.destroy', $task->id}}">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')">Delete</i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="display: flex; justify-content: center">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>

</div>
@endsection
