<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />

     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="X-Frame-Options" content="sameorigin">
    <meta http-equiv="Cache-control" content="no-store">

    <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">

    <title>ZZC Exchange @yield('title')</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    @yield('meta')
    @section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dash.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Arimo:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    @show
    <!-- App -->
    <script>
        window.App = window.App || {};
        App.siteURL = '{{ URL::to("/") }}';
        App.currentURL = '{{ URL::current() }}';
        App.fullURL = '{{ URL::full() }}';
        App.apiURL = '{{ URL::to("api") }}';
        App.assetURL = '{{ URL::to("assets") }}';
    </script>

 
    <!-- jQuery -->
    <script src="{{ asset('assets/vendors/jquery-1.11.1.min.js') }}"></script>

   <script>
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    </script>


   <!--  {{--<script src="{{ asset('assets/js/jquery-1.10.2.min.js') }}"></script>--}}
     {{--<script>window.jQuery || document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"><\/script>')</script>--}} -->
    @yield('script.header')


  


</head>
<body class="@if(Request::is('/')) home @endif @if(Request::is('market/*')) market @endif @if( Auth::guest() ) guest @else logged @endif">
    @include('blocks.header')
    <div class="main-content">
            @yield('body')
    </div>
    <div id="footer" class="clear">
            @include('blocks.footer')
    </div>
@section('script.footer')
<!-- Script Footer -->
<script src="{{ asset('assets/vendors/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery.touchSwipe.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
   /* $(function(){
        $("button[type=submit], input[type=submit]").click(function(){
            $(this).hide();
        });
    });*/
</script>
@show

</body>
</html>
