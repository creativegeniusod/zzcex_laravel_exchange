@extends('layouts.main')
@section('title')
{{Lang::get('frontend_texts.member_login')}}
@stop
@section('body')
<script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'clean'
 };
 </script>
<div class="container">
    <div class="content">
      <div id="loginfrom" class="formuser">
        <h2>{{Lang::get('frontend_texts.member_login')}}</h2>
        <hr><div class="rowform m-auto">
        @if ( Session::get('error') )
            <div class="alert alert-danger" role="alert">{{{ Session::get('error') }}}</div>
        @endif
        @if ( Session::get('notice') )
            <div class="alert alert-success" role="alert">{{{ Session::get('notice') }}}</div>
        @endif
        <form id="registerForm" method="POST" action="{{ url('/user/login') }}" >
        {{ csrf_field() }}
          <div class="form-group text">
              <input type="text" class="form-control" name="email" id="email" value="{{{ Input::old('email') }}}" placeholder="{{{ Lang::get('Username or Email') }}}"/>
          </div>
          <div class="form-group text">
            <input type="password" class="form-control" name="password" id="password" value="" placeholder="{{{ Lang::get('Password') }}}" autocomplete="off"/>
          </div>
          <div class="col-md-6 text-center">
          <div class="form-group">
               <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                               
            </div></div>
            <div class="col-md-6 text-center"><a href="<?=url('/user/forgot_password', $parameters = array(), $secure = null);?>">Forgot Password?</a></div>

          <p><div class="control-group text-center">
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
          <button type="button" class="btn btn-primary btn-lg btn-block" onclick="_tryLogin()">{{Lang::get('frontend_texts.login')}}</button>
        </form>
        <form id="login_verify_1" onsubmit="return _tryVerify()" action="{{{ URL::to('/user/verify_token') }}}" method="post" style="margin-bottom:4px;display:none;">
             {{ csrf_field() }}

            <div class="form-group text">
              <input type="text" id="token" class="form-control" name="token" placeholder="Authy Token">
            </div>
            <input type="hidden" id="authy_id" name="authy_id">
            <button type="button" class="btn btn-lg btn-primary" id="do_verify" onclick="_tryVerify()">{{trans('user_texts.verify')}}</button>
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
  $('#password').keypress(function(e) {
      if (e.keyCode == '13') {
          _tryLogin();
      }
  });
    function _tryVerify(){
      var token = $('#login_verify_1').find('#token').val();
      var authy_id = $('#login_verify_1 #authy_id').val();
      var _token = $('meta[name="csrf-token"]').attr('content');
      $.post('<?php echo action('AuthController@ajVerifyToken')?>', {isAjax: 1, token: token,authy_id:authy_id,_token:_token}, function(response){
          var obj = $.parseJSON(response);
          console.log('ajVerifyToken: ',obj);
          if(obj.status == 'success'){
            document.getElementById("registerForm").submit();
          }else {
            alert(obj.message);
          }
      });
      return false;
    }
    function _tryLogin(){
        var email = $('#registerForm #email').val();
        var password = $('#registerForm #password').val();
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.post('<?php echo action('Auth\LoginController@firstAuth')?>', {isAjax: 1, email: email, password: password,_token:_token}, function(response){
            console.log('befor Obj: ',obj);
            var obj = $.parseJSON(response);
            console.log('Obj: ',obj);
            if(obj.status == 'one_login_success'){
              captchaLogin();
              return true;
            }else if(obj.status == 'two_login'){
              $('#registerForm').hide();
              $('#login_verify_1').show();
              $('#login_verify_1 #authy_id').val(obj.authy_id);
            }else {
              alert(obj.message);
            }
        });
        return false;
    }
    function captchaLogin(){
      var challengeField = $("input#recaptcha_challenge_field").val();
      var responseField = $("input#recaptcha_response_field").val();
      var _token = $('meta[name="csrf-token"]').attr('content');
      console.log('responseField',responseField);
      $.get('<?php echo action('UserController@checkCaptcha')?>', {recaptcha_challenge_field: challengeField, recaptcha_response_field: responseField,_token:_token}, function(response){
          if(response == 1)
          {
            $('button[type=button]').hide();
              document.getElementById("registerForm").submit();
              return true;
          }
          else
          {
              $("#captchaStatus").html("<label class='error'>Your captcha is incorrect. Please try again</label>");
              Recaptcha.reload();
              return false;
          }
      });
      // return false;
    }
</script>
@stop
