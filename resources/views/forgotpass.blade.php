@extends('layouts.main')
@section('title')
{{Lang::get('frontend_texts.forgetpass')}}
@stop
@section('body')
<div class="container">
    <div class="content">
    <script type="text/javascript">
     var RecaptchaOptions = {
        theme : 'clean'
     };
     </script>

        <div id="forgetpass" class="formuser">
            <h2>{{Lang::get('frontend_texts.forgetpass')}}</h2>
            <hr><div class="rowform m-auto text-center">
            @if ( Session::get('error') )
            <div class="alert alert-danger" role="alert">{{{ Session::get('error') }}}</div>
            @endif

            @if ( Session::get('notice') )
            <div class="alert alert-success" role="alert">{{{ Session::get('notice') }}}</div>
            @endif
            <form method="POST" id="forgotForm" action="{{URL::to('/user/forgot')}}" accept-charset="UTF-8">
              {{ csrf_field() }}
            <div class="form-group text">
              <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
            </div>
            <p><div class="control-group">
              <script type="text/javascript" src="https://www.google.com/recaptcha/api/challenge?k={{$data['recaptcha_publickey']}}"></script>
              <script type="text/javascript" src="https://www.google.com/recaptcha/api/js/recaptcha.js"></script>
              <noscript>
              &lt;iframe src="https://www.google.com/recaptcha/api/noscript?k={{$data['recaptcha_publickey']}}" height="300" width="300" frameborder="0"&gt;&lt;/iframe&gt;&lt;br/&gt;
              &lt;textarea name="recaptcha_challenge_field" rows="3" cols="40"&gt;&lt;/textarea&gt;
              &lt;input type="hidden" name="recaptcha_response_field" value="manual_challenge"/&gt;
              </noscript>
              <div id="captchaStatus"></div>
            </div>
            </p>
            <button class="btn btn-lg btn-block btn-primary" type="submit" value="">{{{ Lang::get('confide::confide.forgot.submit') }}}</button>
        </form>
        </div>
    </div>
</div></div>
<!-- End Reset password -->
@stop
@section('script.footer')
@parent
{{ HTML::script('assets/js/jquery.validate.min.js') }}
<script type="text/javascript">
    $(document).ready(function() {
        $("#forgotForm").validate({
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
            $.get('<?php echo action('UserController@checkCaptcha')?>', {recaptcha_challenge_field: challengeField, recaptcha_response_field: responseField }, function(response){
                if(response == 1)
                {
                  $('button[type=submit]').hide();
                    document.getElementById("forgotForm").submit();
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
