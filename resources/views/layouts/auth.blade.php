<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="Admitro - Admin Panel HTML template" name="description">
		<meta content="Spruko Technologies Private Limited" name="author">
		<meta name="keywords" content="admin panel ui, user dashboard template, web application templates, premium admin templates, html css admin templates, premium admin templates, best admin template bootstrap 4, dark admin template, bootstrap 4 template admin, responsive admin template, bootstrap panel template, bootstrap simple dashboard, html web app template, bootstrap report template, modern admin template, nice admin template"/>
		
        <!-- Title -->
		<title>{!! env('APP_NAME', 'Login') !!}</title>

        <!--Favicon -->
        <link rel="icon" href="{{URL::asset('assets/images/brand/favicon.ico')}}" type="image/x-icon"/>

        <!--Bootstrap css -->
        <link href="{{URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Style css -->
        <link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet" />
        <link href="{{URL::asset('assets/css/dark.css')}}" rel="stylesheet" />
        <link href="{{URL::asset('assets/css/skin-modes.css')}}" rel="stylesheet" />

        <!-- Animate css -->
        <link href="{{URL::asset('assets/css/animated.css')}}" rel="stylesheet" />

        <!---Icons css-->
        <link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet" />

        @yield('css')

        <!-- Color Skin css -->
        <link id="theme" href="{{URL::asset('assets/colors/color1.css')}}" rel="stylesheet" type="text/css"/>

	</head>
	<body class="h-100vh bg-primary">
		@yield('content')		
		
        <!-- Jquery js-->
		<script src="{{URL::asset('assets/js/jquery-3.5.1.min.js')}}"></script>

        <!-- Bootstrap4 js-->
        <script src="{{URL::asset('assets/plugins/bootstrap/popper.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

        <!--Othercharts js-->
        <script src="{{URL::asset('assets/plugins/othercharts/jquery.sparkline.min.js')}}"></script>

        <!-- Circle-progress js-->
        <script src="{{URL::asset('assets/js/circle-progress.min.js')}}"></script>

        <!-- Jquery-rating js-->
        <script src="{{URL::asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>

        @yield('js')
        
        <!-- Custom js-->
        <script src="{{URL::asset('assets/js/custom.js')}}"></script>
	</body>
</html>