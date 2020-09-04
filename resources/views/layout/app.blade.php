<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>CRM @yield('title')</title>

    <meta name="csrf_token" content="{{ csrf_token() }}" />

    @include('layout.styles')

    <script>
        var BASE_URL = '{{ url("/") }}';
    </script>

</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
@include('layout.header')
@include('layout.sidebar')

<!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true"></div>
        @yield('content')
    </div>
</div>
@extends('layout.sponsors')
@include('layout.footer')
@yield('scripts')
</body>
</html>
