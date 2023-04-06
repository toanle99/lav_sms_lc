<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CJ INSPIRED ACADEMY') }}</title>

    @include('partials.login.inc_top')
</head>

<body>
{{-- @include('partials.login.header')
@yield('content')
@include('partials.login.footer') --}}
@include('partials.top_menu')
<div class="page-content">
    {{-- @include('partials.menu') --}}
    <div class="content-wrapper"> 
        <div class="content px-0 py-0">
            {{--Error Alert Area--}}
            
            @yield('content')
        </div>
           
    </div>
</div>
@include('partials.footer')
@include('partials.inc_bottom')
@yield('scripts')
</body>

</html>
