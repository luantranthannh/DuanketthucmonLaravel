<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Boicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<script src="https://cdn.tailwindcss.com"></script>
	<!-- My CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
	<link rel="stylesheet" href="/assets/admin/css/style.css">
	<title>Admin</title>
</head>
<body>


	<!-- SIDEBAR -->
	@include('layouts.admin.sidebar')
	<!-- SIDEBAR -->

     

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		@include('layouts.admin.navbar')
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			

			@yield('content')
			
		
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
	@yield('js')
	<script src="/assets/admin/js/main.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>