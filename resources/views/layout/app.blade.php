<html lang="{{ app()->getLocale() }}" xmlns:livewire="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Track @yield('title')</title>

    <meta name="csrf_token" content="{{ csrf_token() }}" />

    @include('layout.styles')

    <livewire:styles/>

    <script>
        var BASE_URL = '{{ url("/") }}';
    </script>

</head>
<!--Start of Tawk.to Script-->
<!--End of Tawk.to Script-->
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
@include('layout.header')
@include('layout.sidebar')

<!-- Content Wrapper -->
    <div class="content-wrapper" style="overflow: auto">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true"></div>
        @yield('content')
    </div>
</div>
@extends('layout.sponsors')
@include('layout.footer')
<livewire:scripts/>
</body>
</html>
