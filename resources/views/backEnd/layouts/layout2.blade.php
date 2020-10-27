

<!DOCTYPE html>
<html>
<head>
@yield('title')
 @yield('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}"/>
    <!--Global styles -->
    <link type="text/css" rel="stylesheet" href="css/components2.css" />
    <link type="text/css" rel="stylesheet" href="css/custom.css" />
    <!--End of Global styles -->
    <!--Plugin styles-->
    <link type="text/css" rel="stylesheet" href="vendors/bootstrapvalidator/css/bootstrapValidator.min.css"/>
    <link type="text/css" rel="stylesheet" href="vendors/wow/css/animate.css"/>
    <!--End of Plugin styles-->
    <link type="text/css" rel="stylesheet" href="css/pages/login1.css"/>
    <style type="text/css">
        .bg_pattern, .bg_pattern::after {
    position: fixed;
    top: 0;
    left: 0;
}
.bg_pattern {
    width: 100%;
    height: 100%;
    background: url(/img/2x2.png) rgba(6,32,59,.7);
}
    </style>
</head>
<body>
    <div class="bg_pattern"></div>
@yield('content')

<!-- global js -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/tether.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- end of global js-->
<!--Plugin js-->
<script type="text/javascript" src="vendors/bootstrapvalidator/js/bootstrapValidator.min.js"></script>
<script type="text/javascript" src="vendors/wow/js/wow.min.js"></script>
<!--End of plugin js-->
<script type="text/javascript" src="js/pages/login1.js"></script>
</body>

</html>