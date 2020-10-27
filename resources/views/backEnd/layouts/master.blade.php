<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="IE=edge" http-equiv="X-UA-Compatible">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="" name="description">
  <meta content="" name="author">
  <meta name="csrf-token" content="{!! csrf_token() !!}">
  <link href="../favicon.ico" rel="icon">
   <meta name="google-site-verification" content="alcOzYSPj8Hb4y63e7fPyPJPTB5FDkNET_DDmrwSiJ8" />
  @yield('title')

  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
  <link href="{{ asset('assets/common/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontEnd/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/backEnd/css/bootflat.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/backEnd/css/styles.admin.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/backEnd/css/square/green.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/backEnd/css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
  @yield('css')
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/gicmadmin/dashboard"><span>GICM Markets Admin</span></a>
        <ul class="user-menu">
          <li class="dropdown pull-right test">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="glyphicon glyphicon-user"></span> 
              {{ auth()->guard('admin')->user()->first_name. " " .auth()->guard('admin')->user()->last_name}}
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li>
                  <span class="glyphicon glyphicon-user"></span> {{auth()->guard('admin')->user()->email}}
              </li>
              <li>
                <a href="{{ url('/gicmadmin/logout') }}">
                  <span class="glyphicon glyphicon-log-out"></span> Logout
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div id="sidebar-collapse" class="col-sm-3 col-lg-3 sidebar">
    {{-- <form role="search">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search">
      </div>
    </form> --}}
    <ul class="nav menu">
      <li role="presentation" class="divider">
        <i class="fa fa-list"></i>&nbsp; &nbsp; Dashboard
      </li>
      <li>
        <a href="/gicmadmin/dashboard">
          <i class="fa fa-dashboard"></i>&nbsp; &nbsp; Dashboard
        </a>
      </li>
      <li role="presentation" class="divider">
        <i class="fa fa-list"></i>&nbsp; &nbsp; News Section
      </li>
      <li>
        <a href="/gicmadmin/add-news">
          <i class="fa fa-plus"></i>&nbsp; &nbsp; Add News
        </a>
      </li>
      <li>
        <a href="/gicmadmin/edit-delete-news">
          <i class="fa fa-pencil"></i>&nbsp; &nbsp; Edit/Delete News
        </a>
      </li>
      <!--<li role="presentation" class="divider">
        <i class="fa fa-list"></i>&nbsp; &nbsp; Analysis Section
      </li>
      <li>
        <a href="/gicmadmin/add-analysis">
          <i class="fa fa-plus"></i>&nbsp; &nbsp;Add Analysis
        </a>
      </li>
      <li>
        <a href="/gicmadmin/edit-delete-analysis">
          <i class="fa fa-pencil"></i>&nbsp; &nbsp;Edit/Delete Analysis
        </a>
      </li>-->
      <li role="presentation" class="divider">
        <i class="fa fa-list"></i>&nbsp; &nbsp; Members Section
      </li>
      <li>
        <a href="/gicmadmin/add-new-member">
          <i class="fa fa-plus"></i>&nbsp; &nbsp;Add New Member
        </a>
      </li>
      <li role="presentation" class="divider">
        <i class="fa fa-list"></i>&nbsp; &nbsp; Email Section
      </li>
      <li>
        <a href="/gicmadmin/send-mail">
          <i class="fa fa-plus"></i>&nbsp; &nbsp;Send Email
        </a>
      </li>
      
      <li role="presentation" class="divider"></li>
      <li role="presentation" class="divider"></li>
    </ul>
    <footer>
      <div class="container">
        <p> <a href="{{ url('http://www.coderxpert.com') }}">GICM Dev Team</a> </p>
      </div>
    </footer>
  </div>
  {{-- http://www.localhost:8000/assets/frontEnd/images/android.png --}}
  <!-- message -->
  <div class="alert alert-success flash_message" style="display:none; margin-top:10px">
   <strong class="message"></strong>
 </div>
 <!-- end of message -->
 <div class="bb-alert alert alert-info" style="display: none;">
  <span></span>
</div>
<!-- showing the ajax loader -->
<div class="loading" style="display: none">

</div>
<!-- end of ajax loader -->
@yield('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{ asset('assets/common/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/backEnd/js/tab-content.js') }}"></script>
<script src="{{ asset('assets/backEnd/js/active-menu.js') }}"></script>
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>


<!-- <script src="{{ asset('assets/tinymce/tinymce.min.js') }}"></script> -->
<!-- tinymce -->
<!--  {{-- <script src="//cdn.tinymce.com/4/tinymce.min.js"></script> --}}  -->
<!-- DataTables -->  
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<!-- App scripts -->
<script src="{{ asset('assets/backEnd/js/app.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('.custom_address').hide();
    $('.accounts_group').change(function () {
      var show = $(this).val();
      if (show=='custom_address'){
        $('.custom_address').slideDown("slow");
        $(".custom_address input").prop('required',true);
    }
    else{
      $('.custom_address').slideUp("slow");
      $(".custom_address input").prop('required',false);
    }
    })
});
</script>

@stack('scripts')
</body>
</html>