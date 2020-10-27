<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}"/>
 
    <link type="text/css" rel="stylesheet" href="css/components.css" />
    <link type="text/css" rel="stylesheet" href="css/custom.css" />
    <link type="text/css" rel="stylesheet" href="css/components2.css" />
    <link type="text/css" rel="stylesheet" href="vendors/chartist/css/chartist.min.css" />
    <link type="text/css" rel="stylesheet" href="vendors/circliful/css/jquery.circliful.css">
    <link type="text/css" rel="stylesheet" href="vendors/fancybox/css/jquery.fancybox.css"/>
    <link type="text/css" rel="stylesheet" href="vendors/fancybox/css/jquery.fancybox-buttons.css" />
    <link type="text/css" rel="stylesheet" href="vendors/fancybox/css/jquery.fancybox-thumbs.css" />
    <link type="text/css" rel="stylesheet" href="vendors/imagehover/css/imagehover.min.css" />
    <link type="text/css" rel="stylesheet" href="css/pages/index.css">
    
   <link type="text/css" rel="stylesheet" href="vendors/c3/css/c3.min.css"/>
    <link type="text/css" rel="stylesheet" href="vendors/toastr/css/toastr.min.css"/>
    <link type="text/css" rel="stylesheet" href="vendors/switchery/css/switchery.min.css"/>
    <link type="text/css" rel="stylesheet" href="css/pages/new_dashboard.css"/>
    <!-- <link type="text/css" rel="stylesheet" href="#" id="skin_change"/> -->
    <link type="text/css" rel="stylesheet" href="vendors/chartist/css/chartist.min.css" />
    <link type="text/css" rel="stylesheet" href="css/pages/chartist.css" />
    
    <!--plugin styles-->
    <!-- <link type="text/css" rel="stylesheet" href="vendors/select2/css/select2.min.css" />
    <link type="text/css" rel="stylesheet" href="vendors/datatables/css/scroller.bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="vendors/datatables/css/colReorder.bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="vendors/datatables/css/dataTables.bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="css/pages/dataTables.bootstrap.css" /> -->
    <!-- end of plugin styles -->

    @yield('link')
    

<body class="body">
<div class="preloader" style=" position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 100000;
  backface-visibility: hidden;
  background: #ffffff;">
    <div class="preloader_img" style="width: 200px;
  height: 200px;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%,-50%);
  background-position: center;
z-index: 999999">
        <img src="img/loader.gif" style=" max-width: 200px;" alt="">
    </div>
</div>
<div id="wrap">
    <div id="top">
        <!-- .navbar -->
        <nav class="navbar navbar-static-top">
            <div class="container-fluid m-0" style=" background:rgb(61, 65, 68) none repeat scroll 0% 0%">
                
                <div class="menu">
                    <span class="toggle-left first-icon" id="menu-toggle">
                        <i class="fa fa-bars"></i>
                        <!-- <i class="fa fa-times"></i> -->

                    </span>
                    <span class="toggle-left second-icon" id="menu-toggle" style="margin-left: 30px;">
                        <!-- <i class="fa fa-bars"></i> -->
                        <i class="fa fa-times "></i>

                    </span>
                </div> 
                
                <div class="topnav dropdown-menu-right float-right">
                   <!-- <div class="btn-group hidden-md-up small_device_search" data-toggle="modal"
                         data-target="#search_modal">
                        <i class="fa fa-search text-primary"></i>
                    </div>
                    <div class="btn-group">
                        <div class="notifications no-bg">
                            <a class="btn btn-default btn-sm messages" data-toggle="dropdown" id="messages_section"> <i
                                    class="fa fa-envelope-o fa-1x"></i>
                                <span class="badge badge-pill badge-warning notifications_badge_top">8</span>
                            </a>
                            <div class="dropdown-menu drop_box_align" role="menu" id="messages_dropdown">
                                <div class="popover-title">You have 8 Messages</div>
                                <div id="messages">
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="img/mailbox_imgs/5.jpg" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data"><strong>hally</strong>
                                                sent you an image.
                                                <br>
                                                <small>add to timeline</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="img/mailbox_imgs/8.jpg" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data"><strong>Meri</strong>
                                                invitation for party.
                                                <br>
                                                <small>add to timeline</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="img/mailbox_imgs/7.jpg" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <strong>Remo</strong>
                                                meeting details .
                                                <br>
                                                <small>add to timeline</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="img/mailbox_imgs/6.jpg" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <strong>David</strong>
                                                upcoming events list.
                                                <br>
                                                <small>add to timeline</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="img/mailbox_imgs/5.jpg" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data"><strong>hally</strong>
                                                sent you an image.
                                                <br>
                                                <small>add to timeline</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="img/mailbox_imgs/8.jpg" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data"><strong>Meri</strong>
                                                invitation for party.
                                                <br>
                                                <small>add to timeline</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="img/mailbox_imgs/7.jpg" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <strong>Remo</strong>
                                                meeting details .
                                                <br>
                                                <small>add to timeline</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="img/mailbox_imgs/6.jpg" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <strong>David</strong>
                                                upcoming events list.
                                                <br>
                                                <small>add to timeline</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="popover-footer">
                                    <a href="mail_inbox.html" class="text-white">Inbox</a>
                                </div>
                            </div>
                        </div>
                    </div>
                  <div class="btn-group">
                        <div class="notifications messages no-bg">
                            <a class="btn btn-default btn-sm" data-toggle="dropdown" id="notifications_section"> <i
                                    class="fa fa-bell-o"></i>
                                <span class="badge badge-pill badge-danger notifications_badge_top">9</span>
                            </a>
                            <div class="dropdown-menu drop_box_align" role="menu" id="notifications_dropdown">
                                <div class="popover-title">You have 9 Notifications</div>
                                <div id="notifications">
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="img/mailbox_imgs/1.jpg" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>Remo</strong>
                                                sent you an image
                                                <br>
                                                <small class="primary_txt">just now.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="img/mailbox_imgs/2.jpg" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>clay</strong>
                                                business propasals
                                                <br>
                                                <small class="primary_txt">20min Back.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="img/mailbox_imgs/3.jpg" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>John</strong>
                                                meeting at Ritz
                                                <br>
                                                <small class="primary_txt">2hrs Back.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="img/mailbox_imgs/6.jpg" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>Luicy</strong>
                                                Request Invitation
                                                <br>
                                                <small class="primary_txt">Yesterday.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="img/mailbox_imgs/1.jpg" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>Remo</strong>
                                                sent you an image
                                                <br>
                                                <small class="primary_txt">just now.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="img/mailbox_imgs/2.jpg" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>clay</strong>
                                                business propasals
                                                <br>
                                                <small class="primary_txt">20min Back.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="img/mailbox_imgs/3.jpg" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>John</strong>
                                                meeting at Ritz
                                                <br>
                                                <small class="primary_txt">2hrs Back.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="img/mailbox_imgs/6.jpg" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>Luicy</strong>
                                                Request Invitation
                                                <br>
                                                <small class="primary_txt">Yesterday.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="img/mailbox_imgs/1.jpg" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>Remo</strong>
                                                sent you an image
                                                <br>
                                                <small class="primary_txt">just now.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="popover-footer">
                                    <a href="#" class="text-white">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                     -->
                     <div class="menu-ul">
                         <ul style="" >
                             <li><a href="{{$general_info->live_chat_link}}">Live Chat</a></li>
                             <li><a href="/faqs">FAQ</a></li>
                             
                            
                            <li><a href="/logout" title="Logout"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 20px"></i></a></li>
                            
                         </ul>
                     </div>
                    <!-- <div class="btn-group">
                        <div class="user-settings no-bg">
                            <button type="button" class="btn btn-default no-bg micheal_btn" data-toggle="dropdown">
                                <img src="img/admin.jpg" class="admin_img2 img-thumbnail rounded-circle avatar-img"
                                     alt="avatar"> <strong>{{session('fname')}} {{session('lname')}}   </strong>
                                <span class="fa fa-sort-down white_bg"></span>
                            </button>
                            <div class="dropdown-menu admire_admin">

                                <a class="dropdown-item title" href="#">
                                   {{session('login_email')}} </a>
                                <a class="dropdown-item" href="edit_user.html"><i class="fa fa-cogs"></i>
                                    Account Settings</a>
                                <a class="dropdown-item" href="#">
                                    <i class="fa fa-user"></i>
                                    User Status
                                </a>
                                <a class="dropdown-item" href="mail_inbox.html"><i class="fa fa-envelope"></i>
                                    Inbox</a>

                                <a class="dropdown-item" href="lockscreen.html"><i class="fa fa-lock"></i>
                                    Lock Screen</a>
                                <a class="dropdown-item" href="/logout"><i class="fa fa-sign-out"></i>
                                    Log Out</a>
                            </div>
                        </div>
                    </div> -->

                </div>
             <!--   <div class="top_search_box float-right hidden-sm-down">
                    <form class="header_input_search float-right">
                        <input type="text" placeholder="Search" name="search">
                        <button type="submit">
                            <span class="font-icon-search"></span>
                        </button>
                        <div class="overlay"></div>
                    </form>
                </div>  -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        <!-- /.navbar -->
        <!-- /.head -->
    </div>

    <div class="wrapper" style="min-height: 500px;margin-top: 50px">
        <div id="left" style="background: rgb(61, 65, 68) none repeat scroll 0% 0%;">
            <div class="menu_scroll">
                <div class="left_media">
                    <div class="media user-media bg-dark dker">
                    <a class="navbar-brand float-left text-center" href="/dashboard">
                    <img style="width:{{$general_info->logo_width}};height:{{$general_info->logo_height}};" src="{{asset('img/logo.png')}}" class="admin_img" alt="logo">
                    <!-- <p class="user-info menu_hide">Welcome Karimul <br>ID : 5000</p> -->
                </a>
                        <div class="user-media-toggleHover">
                            <span class="fa fa-user"></span>
                        </div>
                        <div class="user-wrapper bg-dark">
                            <a class="user-link" href="/dashboard" style="top:4px">
                                <img class="media-object img-thumbnail user-img rounded-circle admin_img3" alt="User Picture"
                                     src="profile.png">
                                    <p class="user-info menu_hide">Welcome {{session('fname')}} <br>ID : {{session('id')}}</p>
                            </a>
                        </div>

                    </div>
                    
                        
                                                                               

                    <hr/>
                </div>
                                 

                <ul id="menu">
                    <li {!! (Request::is('dashboard')? 'class="active"':"") !!}>
                        <a href="/dashboard">
                            <i class="fa fa-home"></i>
                            <span class="link-title menu_hide">&nbsp;Dashboard</span>
                        </a>
                    </li>
                    @if(Auth::guard('admin')->user()->owner_type=="personal")
                    <li {!! (Request::is('myprofile')? 'class="active"':"") !!}>
                        <a href="/myprofile">
                            <i class="fa fa-user"></i>
                            <span class="link-title menu_hide">&nbsp;Personal Details</span>
                        </a>
                    </li>
                    @else
                    <li {!! (Request::is('company-profile')? 'class="active"':"") !!}>
                            <a href="/company-profile">
                                <i class="fa fa-user"></i>
                                <span class="link-title menu_hide">&nbsp;Company Profile</span>
                            </a>
                    </li>
                    <li {!! (Request::is('change-password')? 'class="active"':"") !!}>
                                <a href="/change-password">
                                    <i class="fa fa-user"></i>
                                    <span class="link-title menu_hide">&nbsp;Change Password</span>
                                </a>
                     </li>
                    @endif
                    <li {!! (Request::is('withdraw')? 'class="active"':"") !!}>
                        <a href="/withdraw">
                            <i class="fa fa-money"></i>
                            <span class="link-title menu_hide">&nbsp;Fund Transfer</span>
                        </a>
                    </li>

                 

              
					
					
                    
                   <li {!! (Request::is('statistics') || Request::is('clients')|| Request::is('transaction-history')? 'class="active dropdown_menu list-active"':" dropdown_menu list-active") !!}>
                        <a href="javascript:;">
                            <i class="fa fa-th-large"></i>
                            <span class="link-title menu_hide">&nbsp; Reports</span>
                            <span class="fa arrow menu_hide"></span>
                        </a>
                        <ul>
                            <li {!! (Request::is('statistics')? 'class="active"':"") !!}>
                                <a href="/statistics">
                                    <i class="fa fa-angle-right"></i>
                                    &nbsp; Trader Transactions
                                </a>
                            </li>
                            <li {!! (Request::is('clients')? 'class="active"':"") !!}>
                                <a href="/clients">
                                    <i class="fa fa-angle-right"></i>
                                    &nbsp; My Clients
                                </a>
                            </li>
                            <li {!! (Request::is('transaction-history')? 'class="active"':"") !!}>
                                <a href="/transaction-history">
                                    <i class="fa fa-angle-right"></i>
                                   Transaction History
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li {!! (Request::is('static-banner') || Request::is('animated-banner')|| Request::is('html5-banner')? 'class="active dropdown_menu list-active"':" dropdown_menu list-active") !!}>
                        <a href="javascript:;">
                            <i class="fa fa-archive"></i>
                            <span class="link-title menu_hide">&nbsp; Marketing Tools</span>
                            <span class="fa arrow menu_hide"></span>
                        </a>
                        <ul>
                            <li {!! (Request::is('static-banner')? 'class="active"':"") !!}>
                                <a href="static-banner">
                                    <i class="fa fa-angle-right"></i>
                                    &nbsp; Static Banner
                                </a>
                            </li>
                            <li {!! (Request::is('animated-banner')? 'class="active"':"") !!}>
                                <a href="animated-banner">
                                    <i class="fa fa-angle-right"></i>
                                    &nbsp; Animated Banner
                                </a>
                            </li>
                            <li {!! (Request::is('html5-banner')? 'class="active"':"") !!}>
                                <a href="html5-banner">
                                    <i class="fa fa-angle-right"></i>
                                    &nbsp; HTML5 Banner
                                </a>
                            </li>
                        </ul>
                    </li>  
                    <li {!! (Request::is('#')? 'class="active"':"") !!}>
                        <a href="#">
                            <i class="fa fa-pencil-square-o"></i>
                            <span class="link-title menu_hide">&nbsp;Partner Agreement</span>
                        </a>
                    </li>  
                     <li {!! (Request::is('faqs')? 'class="active"':"") !!}>
                        <a href="/faqs">
                            <i class="fa fa-question-circle"></i>
                            <span class="link-title menu_hide">&nbsp;FAQ's</span>
                        </a>
                    </li>  
                </ul>
            </div>
        </div>
        <!-- /#left -->
        
@yield('content')
   
<!-- global scripts-->
<script type="text/javascript" src="js/components.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<!-- end of global scripts-->
<!-- plugin scripts-->
<script type="text/javascript" src="js/pluginjs/jasny-bootstrap.js"></script>
<script type="text/javascript" src="vendors/holderjs/js/holder.js"></script>
<script type="text/javascript" src="vendors/bootstrapvalidator/js/bootstrapValidator.min.js"></script>
<script type="text/javascript" src="js/pages/validation.js"></script>
<!--  plugin scripts -->
<script type="text/javascript" src="vendors/countUp.js/js/countUp.min.js"></script>
<!-- <script type="text/javascript" src="vendors/flip/js/jquery.flip.min.js"></script> -->
<script type="text/javascript" src="js/pluginjs/jquery.sparkline.js"></script>
<!-- <script type="text/javascript" src="vendors/chartist/js/chartist.min.js"></script> -->
<!-- <script type="text/javascript" src="js/pluginjs/chartist-tooltip.js"></script> -->
<!-- <script type="text/javascript" src="vendors/swiper/js/swiper.min.js"></script> -->
<script type="text/javascript" src="vendors/circliful/js/jquery.circliful.min.js"></script>
<script type="text/javascript" src="vendors/flotchart/js/jquery.flot.js" ></script>
<script type="text/javascript" src="vendors/flotchart/js/jquery.flot.resize.js"></script>
<script type="text/javascript" src="/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="vendors/holderjs/js/holder.js"></script>
<script type="text/javascript" src="vendors/fancybox/js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="vendors/fancybox/js/jquery.fancybox-buttons.js"></script>
<script type="text/javascript" src="vendors/fancybox/js/jquery.fancybox-thumbs.js"></script>
<script type="text/javascript" src="vendors/fancybox/js/jquery.fancybox-media.js"></script>

<script type="text/javascript">
    $(function(){

        if ($(window).width()<768) {
             $('#left').hide();
              // $('#left').css('margin':'0px');
            $('.first-icon').click(function(){
                $(this).hide('slow');
                $('.second-icon').show('slow');
                 $('#left').show();


            });
            $('.second-icon').click(function(){
                $(this).hide('slow');
                $('.first-icon').show('slow');
                 $('#left').hide();

            });
        }

        $('.menu').click(function(){
            $('#top.fixed').toggleClass('fixed-navber');
        })
        
    
    });
</script>


<!-- <script type="text/javascript" src="vendors/chartist/js/chartist.min.js"></script>
<script type="text/javascript" src="js/pages/chartist.js"></script> -->
<!-- <script type="text/javascript" src="js/pages/modals.js"></script> -->
<!--plugin scripts-->
@yield('script')

</body>
</html>