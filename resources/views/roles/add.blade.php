@extends('layouts.app2')
@section('admin')
<div class="text-center col-md-10 p-5">
	<br>
	 <h2>Nuevo rol para el usuario: {{$user->name}}</h2>
	<form action="{{route('confirmRole', $user->id)}}" method="post">
		@csrf
		<label for="role">Roles:</label>
		<select name="role">
			@foreach ($roles as $rol)
			<option value="{{$rol->id}}">{{$rol->name}}</option>
			@endforeach
		</select><br><br>
		<input type="submit" name="" value="Añadir rol">
	</form>
</div>
@endsection