<html>
    <head>
        <title> @yield('title') </title>
        {{-- link --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/patients/css/header.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/patients/css/home.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/patients/css/footer.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/patients/css/contactUs.css') }}">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body >
        @section('header')
            @include('layouts.patients.header')
        @show

        <div class="container">
            @yield('content')
        </div>
        @yield('JScontent')


        @section('footer')
            @include('layouts.patients.footer')
        @show
    </body>
    <script src="{{ asset('/assets/patients/js/home.js') }}"></script>
    <script src="{{ asset('/assets/patients/js/header.js') }}"></script>
</html>