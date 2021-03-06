<!DOCTYPE html>
<html lang="{{ config('app.locale')}}">

<head>
	<title>Compra Venta</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/login.css') }}">
	<!-- Font awesome -->
    <link rel="stylesheet" href="{{ asset('/assets/lte/plugins/fontawesome-free/css/all.min.css') }}">
</head>

<body>
	@yield('content')
</body>
<script src="{{ asset('/assets/lte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/lte/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

</html>
