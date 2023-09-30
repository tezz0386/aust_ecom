<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') ?? 'Moneysewa' }}</title>
    <link href="http://transfer.test/assets/img/logo.png" rel="icon">
    @vite(['resources/views/admin/sass/app.scss', 'resources/views/admin/js/app.js'], 'admin')
    @stack('styles')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">
        @include('admin.views.partial.navbar')
        @include('admin.views.partial.sidebar')
        @yield('content')
        @include('admin.views.partial.footer')
    </div>
    @stack('scripts')
</body>

</html>
