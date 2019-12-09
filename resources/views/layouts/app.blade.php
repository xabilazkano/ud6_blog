<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<body>
	@include('layouts.nav')
	<main class="py-4">
		@yield('content')
	</main>
	@include('layouts.footer')
</body>
</html>