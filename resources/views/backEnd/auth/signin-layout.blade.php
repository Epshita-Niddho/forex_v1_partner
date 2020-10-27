<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/x-icon" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/login.css">
    <!-- font-awesome -->
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css">
    <!-- main css file -->
    
   

    @yield('css-link')
    
    
  </head>
  <body style="background-color:#F5F7F8;">
    
    <div class="preloader-wrapper">
      <div class="preloader">
          <img src="{{asset('img/loader.gif')}}" alt="loading..." style="max-width: 200px">
      </div>
    </div>
      <section class="main-header">
        <div class="container">
          <div class="row">
            <div class="logo-flex clearfix">
            <div class="col-xs-6 column">
              <div class="header-img clearfix">
                <a href="/"><img src="{{asset('img/logo.png')}}" alt="" style="width:{{$general_info->logo_width}};height:{{$general_info->logo_height}}"></a>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="text-center header-right-content column">
                <div class="button-sign" style="width: 180px">
                    <?php if (Request::is('login') || Request::is(app()->getLocale().'/login')): ?>
                  <p>Open Trading Account!<span><a href="{{$general_info->client_portal_url}}/register" target="_blank">Sign Up</a></span></p>
                  @else
                  <p>Have an Account!<span><a href="/login">Sign in</a></span></p>
                  @endif
                </div>
                
              </div>
            </div>
            </div>
          </div>
        </div>
      </section>

    @yield('main-body')

    <!--  -->

    <section class="form-footer">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 social-links">
            <a href="{{$general_info->facebook_link}}"><i class="fab fa-facebook-f"></i></a>
            <a href="{{$general_info->google_plus_link}}"><i class="fab fa-google-plus-g"></i></a>
            <a href="{{$general_info->twitter_link}}"><i class="fab fa-twitter"></i></a>
            
            <a href="{{$general_info->youtube_link}}"><i class="fab fa-youtube"></i></a>
            <a href="{{$general_info->linked_in_link}}"><i class="fab fa-linkedin-in"></i></a>
          </div>
          <!-- <div class="col-xs-12 col-sm-12 col-md-12 company-link">
            <ul class="footer_menu">
                    <li><a href="{{$general_info->footer_link1_link}}" target="" class="terms_conditions">{{$general_info->footer_link1_text}}</a></li>
                    <li><a href="{{$general_info->footer_link2_link}}" target="" class="security_of_funds">{{$general_info->footer_link2_text}}</a></li>
                    <li><a href="{{$general_info->footer_link3_link}}" target="" class="legal_forms">{{$general_info->footer_link3_text}}</a></li>
                    <li><a href="{{$general_info->footer_link4_link}}" target="">{{$general_info->footer_link4_text}}</a></li>
                    <li><a href="{{$general_info->footer_link5_link}}" target="" class="privacy_policy">{{$general_info->footer_link5_text}}</a></li>
                </ul>
          </div> -->

          <div class="col-xs-12 col-sm-12 col-md-12 ">
            <br> 
            <p><b>{{$general_info->risk_warning_title}} : </b>{!!$general_info->risk_warning_text!!}</p>
            <br>
            <p><b>{{$general_info->legal_information_title}} : </b>{!!$general_info->legal_information_text!!}</p>
            <br><br>
            <p>{{$general_info->copyright_text}}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
   
    
    <script type="text/javascript">
      $(function(){
          $('.selectpicker').selectpicker();
      });
    </script>
    <script type="text/javascript" src="{{asset('js/pages/login5.js')}}"></script>
    <script type="text/javascript">
      $(document).ready(function($) {
        var Body = $('body');
        Body.addClass('preloader-site');
        });
        $(window).load(function() {
            $('.preloader-wrapper').fadeOut();
            $('body').removeClass('preloader-site');
        });
    </script>
    <script>
      $(function(){

        $("#login").bootstrapValidator({
    feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },

        fields : {
          email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required and cannot be empty'
                    },
                    emailAddress: {
                        message: 'The email address is not a valid'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty'
                    },
                    different: {
                        field: 'username',
                        message: 'The password cannot be the same as username'
                    },
                    
                }
            },
        }
        

  });

      });
    </script>
    @yield('js-link')
    
  </body>
</html>