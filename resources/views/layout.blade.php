<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <title>Notes</title>

</head>
<body>
    @yield('content')

    <script src="{{asset('js/otherComponents/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>