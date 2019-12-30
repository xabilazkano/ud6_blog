@extends('layouts.app2')
@section('admin')
<div class="text-center col-md-10 p-5">
	<br>
	 <h2>Eliminar rol para el usuario: {{$user->name}}</h2>
	<form action="{{route('destroyRole', $user->id)}}" method="post">
		@csrf
		<label for="role">Roles:</label>
		<select name="role">
			@foreach ($user->roles as $role)
			<option value="{{$role->id}}">{{$role->name}}</option>
			@endforeach
		</select><br><br>
		<input type="submit" name="" value="Eliminar rol">
	</form>
</div>
@endsection