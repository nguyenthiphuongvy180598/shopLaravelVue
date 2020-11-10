<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <!-- SEO -->
        <meta name="robots" content="INDEX, FOLLOW">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <link rel="canonical" href="{{$url_canonical}}"> --}}
        <!-- END SEO -->
        <title>Shop ban hang</title>
        <link href="{{('/fontend/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{('/fontend/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{('/fontend/css/prettyPhoto.css')}}" rel="stylesheet">
        <link href="{{('/fontend/css/price-range.css')}}" rel="stylesheet">
        <link href="{{('/fontend/css/animate.css')}}" rel="stylesheet">
        <link href="{{('/fontend/css/main.css')}}" rel="stylesheet">
        <link href="{{('/fontend/css/responsive.css')}}" rel="stylesheet">   
        <link href="{{('/fontend/css/sweetalert.css')}}" rel="stylesheet">     
        <link rel="shortcut icon" href="images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
        <script>
        (function () { 
            window.Laravel ={
                csrfToken: '{{ csrf_token() }}'
            };
         })();
        </script>
    </head>
    <body>
        <div id="app">
            <mainapp></mainapp>
        </div>
    </body>
    <script src="{{mix('js/app.js')}}"></script>
    <script src="{{('/fontend/js/jquery.js')}}"></script>
	<script src="{{('/fontend/js/bootstrap.min.js')}}"></script>
	<script src="{{('/fontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{('/fontend/js/price-range.js')}}"></script>
    <script src="{{('/fontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{('/fontend/js/main.js')}}"></script>
    <script src="{{('/fontend/js/sweetalert.js')}}"></script>
    
</html>
