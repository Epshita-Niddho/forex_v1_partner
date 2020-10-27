
@extends('backEnd.auth.signin-layout')
@section ('title')
Register as Person
@endsection

@section('css-link')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
<link type="text/css" rel="stylesheet" href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}"/>
<!-- main css file -->
<link type="text/css" rel="stylesheet" href="{{asset('css/pages/login5.css')}}"/>
<style type="text/css">
.rules{
  position: absolute;
  top: 100%;
  font-size: 12px;
  width: 95%
}
#message{
  position: absolute;
  font-size: 10px;
  top: 100%;
}
.message{
  position: absolute;
  font-size: 10px;
  
  left: 60%;
  top: 30%

}
</style>
@endsection



@section('main-body')

<section class="main-body">
        <div class="container">
          <div class="row clearfix">
            <div class="col-md-12 col-xs-12">
              <form class="reset-form clearfix" id="reset" method="POST" action="/reset-password">
                @if ($errors->has('msg'))
          
              <span class="help-block" style="text-align:center; color:red">
                  <strong>{{ $errors->first('msg') }}</strong>
              </span>
          
          @endif
  
          @if (Session::has('notExist'))
                                  <span class="help-block">
                                      <strong style="color: #f00;">{{ Session::get('notExist') }}</strong>
                                  </span>
                                  @endif 
  
          @if (Session::has('link'))
                                  <span class="help-block">
                                      <strong style="color: #00BF86;">{{ Session::get('link') }}</strong>
                                  </span>
                                  @endif
  
          {{ csrf_field() }}
              <h4 class="form-reset-h4">Reset password</h4>
              <small>In order to reset your password, please provide us with your email address.</small>
              <div class="form-group">
                <!-- <div class="reset-group">
                  <input type="email" name="email"><span class="highlight"></span><span class="bar"></span>
                  <label>Email</label>
                </div> -->
                <div class="form-group">
                          <input type="email" id="email" name="email" style="color: #777" required="required" />
                          <label class="control-label" for="input">Email</label><i class="bar"></i>
                        </div>
                
              </div>
                <div class="col-md-6 col-xs-12 no-padding">
                  <button type="submit" class="reset-mat-form-button">Submit</button>
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </section>
  
      @endsection
  
  
  
     @section('js-link')
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
  
          $("#reset").bootstrapValidator({
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
             
          }
          
  
    });
  
        });
      </script>
  
      @endsection
      
    