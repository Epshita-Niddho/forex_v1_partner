

@extends('backEnd.auth.signin-layout')
@section ('title')
Login
@endsection

@section('css-link')
<link type="text/css" rel="stylesheet" href="{{asset('css/pages/login5.css')}}"/>
@endsection
@section('main-body')
<section class="main-body">
  <div class="container">
    <div class="row clearfix">
      <div class="col-md-6 col-xs-12">
        <form class="clearfix form-login" id="login" method="POST" action="{{ url('/login') }}">
          <h4 class="form-h4">LOG IN</h4>
          @if ($errors->has('msg'))
          
          <span class="help-block" style="text-align:center; color:red">
            <strong>{{ $errors->first('msg') }}</strong>
          </span>
          <br>
          @endif
          @if (Session::has('password'))
          <span class="help-block">
            <strong style="color: #00BF86;">{{ Session::get('password') }}</strong>
          </span>
          <br>
          @endif 
          {{ csrf_field() }}
          <div class="row">
             
                              <div class="form-group">
                                <input type="email" id="email" name="email" style="color: #777"  required="required" />
                                <label class="control-label" for="input">Email</label><i class="bar"></i>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                              </div>
                              
                            </div>
                            <div class="row">
             
                              <div class="form-group">
                                <input type="password" id="password" name="password" style="color: #777"   required="required" />
                                <label class="control-label" for="input">Password</label><i class="bar"></i>
                                @if ($errors->has('password'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                              </div>
                            </div>
                            <div class="row" style="margin-top: 30px">
                              <div class="col-md-6 col-xs-12 col-sm-6 anc-style no-padding">
                                <a href="/reset-password">Reset Password</a>
                              </div>
                              <div class="col-md-6 col-xs-12 col-sm-6 no-padding">
                                <button type="submit" class="mat-form-button">Sign In</button>
                                <!-- <button style="display:none;margin-top: 20px;" type="button" class="btn btn-success btn-block b_r_20 m-t-20 form-button-logging">LOGGING IN &nbsp;&nbsp;&nbsp; <i class="fas fa-sync-alt fa-spin"></i></button> -->
                              </div>
                              
                            </div>
                          </form>
                        </div>
                        <div class="col-md-6 col-xs-12 text-center no-padding">
            <div class="reg-des">
              <p>Not Registered?</p>
              <small>Start Trading Today</small>
              <div>
                <a href="{{$general_info->client_portal_url}}/register">
                  <button type="" class="mat-form-button1">Register Now</button>
                </a>
                {{--  <a href="/live-account-register">
                  <button type="" class="mat-form-button1">Open Live Account</button>
                </a>
                <a href="/demo-account-register">
                  <button type="" class="mat-form-button2">Open Demo Account</button>
                </a>  --}}
              </div>
              <!-- <small class="small-font">Losses can exceed your deposits</small> -->
              <!-- <div class="flex-container">
                <div>
                  <img src="{{asset('img/login_1st_img_'.app()->getLocale().'.png')}}" alt="">
                  <small class="small-font">{{$general_info_others->login_1st_img_text}}</small>
                </div>
                <div>
                  <img src="{{asset('img/login_2nd_img_'.app()->getLocale().'.png')}}" alt="">
                  <small class="small-font">{{$general_info_others->login_2nd_img_text}}</small>
                </div>
                <div>
                  <img src="{{asset('img/login_3rd_img_'.app()->getLocale().'.png')}}" alt="">
                  <small class="small-font">{{$general_info_others->login_3rd_img_text}}</small>
                </div>
              </div> -->
            </div>
          </div>
                      </div>
                    </div>
                  </section>
                  @endsection
                  

                  @section('js-link')
                  <script type="text/javascript">
                    $(function(){
                      
                      var twoToneButton = document.querySelector('.mat-form-button');
                      
                      twoToneButton.addEventListener("click", function() {
                        twoToneButton.innerHTML = "Signing In";
                        twoToneButton.classList.add('spinning');
                        
                        setTimeout( 
                          function  (){  
                            twoToneButton.classList.remove('spinning');
                            twoToneButton.innerHTML = "Sign In";
                            
                          }, 2000);
                      }, false);
                      
                    });
                  </script>
                  
                  @endsection
                  