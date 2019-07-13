@extends('layout')

@section('content')

@include('errors')

<div class="container">
   <div class="row">
       <div class="col-md-12">
           <h3>{{$task->title}}</h3>
           <p>{!! Str::limit($task->description, 3000) !!}</p>
           <div class="wrapper">
               @foreach($task->image as $img)
                   <div class="wrapper-image">
                       <img src="{{ asset('/storage/' . $img->images)}}" class="img-edit" alt="">
                   </div>
               @endforeach
           </div>
            <a href="{{route('tasks.index')}}" class="btn btn-success show-back">Back</a>
       </div>
   </div>
</div>
@endsection