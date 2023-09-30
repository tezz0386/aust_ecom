<!DOCTYPE html>
<html lang="en">
@include('frontend.layouts.head')

<body class="animsition">
 <div id="app">
    @include('frontend.layouts.header')
    @yield('content')
    @include('frontend.layouts.footer')
 </div>
 @include('frontend.layouts.bottom-footer')
</body>

</html>
