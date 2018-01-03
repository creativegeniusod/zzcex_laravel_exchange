@extends('layouts.main')
@section('title')
{{Lang::get('frontend_texts.open_account')}}
@stop
@section('body')

<div class="container">
    <div class="content">
        <div id="signupfrom" class="formuser">
            <script type="text/javascript">
             var RecaptchaOptions = {
                theme : 'clean'
             };
             </script>
            <h2>{{Lang::get('frontend_texts.open_account')}}</h2>
            <hr><div class="rowform text-center m-auto">
            <p>Register below to open your <span style="color:green;text-transform: uppercase">FREE</span> account</p>
            @if ( Session::get('error') )
              <div class="alert alert-danger" role="alert">
                    @if ( is_array(Session::get('error')) )
                        {{ head(Session::get('error')) }}
                    @endif
                </div>
            @endif

            @if ( Session::get('notice') )
              <div class="alert alert-success" role="alert">{{ Session::get('notice') }}</div>
            @endif
            <form id="registerForm" method="POST" action="{{ route('UserController@store') ?: URL::to('user')  }}}" accept-charset="UTF-8">
  
                <div class="form-group text">
                    <input minlength="2" type="text" required="" name="firstname" id="firstname" class="form-control" value="{{{ Input::old('firstname') }}}"  placeholder="{{trans('frontend_texts.firstname')}}">
                </div>
                <div class="form-group text">
                    <input type="text" required="" name="lastname" id="lastname" class="form-control" value="{{{ Input::old('lastname') }}}" placeholder="{{Lang::get('frontend_texts.lastname')}}"/>
                </div>
                <div class="form-group text">
                    <input type="text" name="email" id="email" required="" class="form-control" placeholder="" value="{{{ Input::old('email') }}}">
                </div>
                <div class="form-group text">
                    <input minlength="2" type="text" required="" class="form-control" placeholder="" name="username" id="username" value="{{{ Input::old('username') }}}">
                </div>
                <input type="hidden" value="@if(isset($referral)){{$referral}}@else{{{Input::old('referral')}}}@endif" name="referral">
                <p><div class="control-group">
  						    <script type="text/javascript" src="https://www.google.com/recaptcha/api/challenge?k={{$recaptcha_publickey}}"></script>
  				        <script type="text/javascript" src="https://www.google.com/recaptcha/api/js/recaptcha.js"></script>
  				        <noscript>
  				        &lt;iframe src="https://www.google.com/recaptcha/api/noscript?k={{$recaptcha_publickey}}" height="300" width="300" frameborder="0"&gt;&lt;/iframe&gt;&lt;br/&gt;
  				        &lt;textarea name="recaptcha_challenge_field" rows="3" cols="40"&gt;&lt;/textarea&gt;
  				        &lt;input type="hidden" name="recaptcha_response_field" value="manual_challenge"/&gt;
  				        </noscript>
  				        <div id="captchaStatus"></div>
                </div>
                </p>
                <p>{{Lang::get('frontend_texts.id_pass_send_to_mail')}}</p>
                <button type="submit" class="btn btn-primary btn-lg btn-block">{{Lang::get('frontend_texts.register')}}</button>
            </form>
        </div>
    </div>
</div>
</div>
@stop
@section('script.footer')
@parent
{{ HTML::script('assets/js/jquery.validate.min.js') }}
<script type="text/javascript">
    $(document).ready(function() {
        $("#registerForm").validate({
            rules: {
                firstname: "required",
                lastname: "required",
                email: {
                    required: true,
                    email: true
                },
                termsofservice: "required"
            },
            messages: {
                firstname: "Please enter your first name.",
                lastname: "Please enter your last name.",
                email: "Please enter a valid email address.",
                termsofservice: "Please accept our TOS."
            },
            submitHandler: function(form) {
              var challengeField = $("input#recaptcha_challenge_field").val();
            var responseField = $("input#recaptcha_response_field").val();
            console.log('responseField',responseField);
            $.post('<?php echo action('UserController@checkCaptcha')?>', {recaptcha_challenge_field: challengeField, recaptcha_response_field: responseField }, function(response){
                if(response == 1)
                {
                  $('button[type=submit]').hide();
                    document.getElementById("registerForm").submit();
                    //return true;
                }
                else
                {
                    $("#captchaStatus").html("<label class='error'>Your captcha is incorrect. Please try again</label>");
                    Recaptcha.reload();
                    //return false;
                }
            });
          }
	    });
  });
</script>
@stop
