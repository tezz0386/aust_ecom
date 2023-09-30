<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('meta_title', @$setting->meta_title)</title>
    <meta name="description" content="@yield('meta_description', @$setting->meta_description)">
    <meta name="keywords" content="@yield('meta_description', @$setting->meta_key_words)">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/views/frontend/sass/app.scss', 'resources/views/frontend/js/app.js'], 'frontend')
</head>
<body class="h-100">
    <div id="app">
        @include('frontend.layouts.header');
        @yield('content')
        @include('frontend.layouts.footer');
    </div>
</body>
</html>
