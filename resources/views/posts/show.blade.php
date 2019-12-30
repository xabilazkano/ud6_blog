@extends('layouts.app')
@section('content')
<!-- Page Content -->
<div class="container">
  <div class="row">
    <!-- Post Content Column -->
    <div class="col-lg-8">
      <!-- Title -->
      <h1 class="mt-4">{{$post->title}}</h1>
      <!-- Author -->
      <p class="lead">
        by
        <a href="#">{{$post->user->name}}</a>
      </p>
      <hr>
      <!-- Date/Time -->
      <p>Posted on {{$post->published_at}}</p>
      <hr>
      @isset($post->image)
      <!-- Preview Image -->
      <img class="img-fluid rounded" src="{{url('img/' . $post->image)}}" alt="">
      @endisset
      <hr>
      <!-- Post Content -->
      <p class="lead">{{$post->body}}</p>
      <hr>
    </div>
    <!-- Sidebar Widgets Column -->
    <div class="col-md-4">

    </div>
  </div>
  <!-- /.row -->
</div>
<!-- /.container -->

@endsection