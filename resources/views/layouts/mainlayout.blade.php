<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('layouts.partials.head')
</head>
<body>
    @include('layouts.partials.nav')
    @include('layouts.partials.header')
    @yield('content')
    @include('layouts.partials.footer')    
    @include('layouts.partials.footer-scripts')    
    
</body>
</html>