<!DOCTYPE html>
<!--[if lte IE 9]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<!--=================================
Meta tags
=================================-->
@yield('title')
 @yield('meta')
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1, user-scalable=no" />

  <link rel="shortcut icon" href="http://www.gicmarkets.com/images/favico.png" type="image/x-icon" />
<!--=================================
Style Sheets
=================================-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>  
    
<link rel="stylesheet" type="text/css" href="assets/frontend/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/frontend/css/flexslider.css">
<link rel="stylesheet" type="text/css" href="assets/frontend/css/animations.css">
<link rel="stylesheet" type="text/css" href="assets/frontend/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/frontend/css/jquery.flickr.css">
<link rel="stylesheet" type="text/css" href="assets/frontend/css/prettyPhoto.css">
<link rel="stylesheet" href="assets/frontend/css/main.css">

<script src="assets/js/lib/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>
<body>

<!--========================================
Body Content
===========================================-->
<div class="offsetWrap">
    
    <div class="offsetMaker"> 
        
        <header class="bg-white doc-header">
            <div class="head-contact clearfix">
            <div class="container">
                <ul class="nav-top pull-left">
                    <li><a href="#" class="appointment">Apply For Partnership</a></li>
                    <li><a href="/login">Partner Login</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Events</a></li>
                </ul>

                <ul class="contact pull-right">
                    <li><a href="#"><i class="fa fa-phone"></i>+447024029770</a></li>
                    <li><a href="#"><i class="fa fa-envelope"></i>partners@gicmarkets.com</a></li>
                </ul>

            </div>
            </div>

            
            <nav id="sticktop">
            <div class="container">
                
                    <a href="/" class="text-left logo"><img src="http://www.gicmarkets.com/images/logos.png" alt=""></a>
                    <ul class="socials">
                        <li><a href="htts://www.facebook.com/gicmarkets" class="fb"><i class="fa fa-facebook-f"></i></a></li>
                        <li><a href="https://twitter.com/gic_markets" class="twitter"><i class="fa fa-twitter"></i></a></li>
                    </ul>
                    <a href="#" class="nav-triger"><span class="fa fa-navicon"></span></a>
                    <ul class="main-menu">
                        <li class="active"><a href="/">Home</a></li>
                        <li><a href="#">Affiliates</a></li>
                        <li><a href="#">Refer Friends</a></li>
                        <li><a href="#">Indroducers</a></li>
                        <li><a href="#">About</a></li>
                        <!--<li class="parent"><a href="#">News</a>
                            <ul>
                                <li><a href="index2.html">Home2</a></li>
                                <li><a href="blog-single.html">Blog Single</a></li>
                                <li><a href="cart.html">Cart Page</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="shop-product-single.html">Product Detial</a></li>
                            </ul>
                            
                        </li>-->
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
            </nav>
        </header>    
@yield('content')


        <footer class="bg-white pt-35">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 mt-40">
                        <h6 class="text-bold text-uppercase after-left-s pb-20 mb-20">Company </h6>
                       <!-- <p>With two clinics specializing in the care for our patients’ total health and well being our doctors are able to create life long relationships.</p>
                       -->
                    </div>

                    <div class="col-sm-3 mt-40 tags">
                        <h6 class="text-bold text-uppercase after-left-s pb-20 mb-20">Tags</h6>
                        <!--<a href="#">care</a>
                        <a href="#">clinix</a>
                        <a href="#">doctor</a>
                        <a href="#">heart</a>
                        <a href="#">medicine</a>
                        <a href="#">treatment</a>
                        -->
                    </div>

                    <div class="col-sm-3 mt-40 recent-posts">
                        <h6 class="text-bold text-uppercase after-left-s pb-20 mb-20">Recent posts</h6>
                        <ul>
                            <!--<li><a href="#">Doctor and Patient Doctors as Advocates for Family Leave</a></li>
                            <li><a href="#">Graphene’s Prospects in Biosensing Just Got a Boost</a></li>
                            <li><a href="#">Your Phone Can Tell Whether You’re Depressed</a></li>
                            -->
                        </ul>
                    </div>
                    <div class="col-sm-3 mt-40">
                        <h6 class="text-bold text-uppercase after-left-s pb-20 mb-20">Important Links</h6>  
                        <!--
                        <ul id="flicker-feed" class="custom_flickr" data-limit="6" data-userID="52617155@N08"></ul>
                        -->
                    </div>
                </div>
                <div class="rights mt-60 pt-15 pb-10">
                   Copyright © 2017 -GIC Markets All Rights Reserved 
                </div>
            </div>
        </footer>
    </div>
    
</div>

<!--=================================
Script Source
=================================-->

<script src="assets/frontend/js/lib/jquery.js"></script>
<script src="assets/frontend/js/lib/css3-animate-it.js"></script>
<script src="assets/frontend/js/lib/jquery.flexslider-min.js"></script>
<script src="assets/frontend/js/lib/jquery.sticky.js"></script>
<script src="assets/frontend/js/lib/jquery.waitforimages.js"></script>
<script src="assets/frontend/js/lib/jflickrfeed.min.js"></script>
<script src="assets/frontend/js/lib/jquery.prettyPhoto.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script src="assets/frontend/js/app/main.js"></script>

</body>
</html>

