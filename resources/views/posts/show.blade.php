@extends('layouts.app')
@section('content')
<!-- Page Content -->
<div class="container">
  <div class="row">
    @foreach($post as $p)
   <!-- Post Content Column -->
   <div class="col-lg-8">
    <!-- Title -->
    <h1 class="mt-4">{{$p->title}}</h1>
    <!-- Author -->
    <p class="lead">
      by
      <a href="#">{{$p->user->name}}</a>
    </p>
    <hr>
    <!-- Date/Time -->
    <p>Posted on {{$p->published_at}}</p>
    <hr>
    @isset($p->image)
    <!-- Preview Image -->
    <img class="img-fluid rounded" src="{{asset('$p->image')}}" alt="">
    @endisset
    <hr>
    <!-- Post Content -->
    <p class="lead">{{$p->body}}</p>
    <hr>
  </div>
  @endforeach
  <!-- Sidebar Widgets Column -->
  <div class="col-md-4">

  </div>
</div>
<!-- /.row -->
</div>
<!-- /.container -->

@endsection