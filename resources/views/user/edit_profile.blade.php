@section('title')
{{Lang::get('frontend_texts.account_profile')}}
@stop
<!-- Edit Profile -->
<h2>{{Lang::get('frontend_texts.account_profile')}}</h2>
    @if ( Session::get('error') )
      <div class="alert alert-danger" role="alert">
            @if ( is_array(Session::get('error')) )
                {{ head(Session::get('error')) }}
            @else
                {{ Session::get('error') }}
            @endif
        </div>
    @endif

    @if ( Session::get('notice') )
      <div class="alert alert-success" role="alert">
            {{ Session::get('notice') }}
        </div>
    @endif
<div class="panel panel-default">
  <div class="panel-heading bg-lightBlue fg-white"><h2 class="panel-title"><i class="fa fa-cog"></i> {{Lang::get('user_texts.your_details')}}</h2></div>
  <div class="panel-body text-center">
    <form id="registerForm" method="POST" action="{{ url('/user/update-setting') }}">
     {{ csrf_field() }}
    <table class="table register">
        <tbody>
            <tr>
                <th style="width:180px;">{{trans('frontend_texts.firstname')}}</th>
                <td><input type="text" value="{{$profile['firstname']}}" id="firstname" name="firstname" class="form-control" required="" minlength="2" class="valid"></td>
            </tr>
            <tr>
                <th style="width:180px;">{{trans('frontend_texts.lastname')}}</th>
                <td><input type="text" value="{{$profile['lastname']}}" id="lastname" name="lastname" class="form-control" required="" minlength="2" class="valid"></td>
            </tr>
            <tr>
                <th>{{{ Lang::get('confide::confide.e_mail') }}}</th>
                <td><strong>{{$profile['email']}}</strong><br>
                <span><em>{{Lang::get('user_texts.note_change_email')}}</em></span></td>
            </tr>
            <tr>
                <th>{{Lang::get('user_texts.autologout')}}</th>
                <td>
                    <select name="timeout" class="form-control valid">
                        <option value="45 minutes" @if(trim($profile['timeout'])=='45 minutes') selected @endif>Default (45 Minutes)</option>
                        <option value="1 hour" @if(trim($profile['timeout'])=='1 hour') selected @endif>1 Hour</option>
                        <option value="2 hours" @if(trim($profile['timeout'])=='2 hours') selected @endif>2 Hours</option>
                        <option value="6 hours" @if(trim($profile['timeout'])=='6 hours') selected @endif>6 Hours</option>
                        <option value="12 hours" @if(trim($profile['timeout'])=='12 hours') selected @endif>12 Hours</option>
                        <option value="24 hours" @if(trim($profile['timeout'])=='24 hours') selected @endif>24 Hours</option>
                    </select></td>
            </tr>
        </tbody>
    </table>
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading bg-lightBlue fg-white"><h2 class="panel-title"><i class="fa fa-cog"></i> {{Lang::get('user_texts.your_pass')}}</h2></div>
  <div class="panel-body text-center">
    {{Lang::get('user_texts.note_change_pass')}}<br><br>
    <table class="table register">
        <tbody>
            <tr>
                <th style="width:180px;">{{{ Lang::get('confide::confide.password') }}}</th>
                <td><input type="password" autocomplete="off" value="" class="form-control" id="password" name="password"><br>
                <span>{{Lang::get('user_texts.note_input_pass')}}</span></td>
            </tr>
            <tr>
                <th>{{{ Lang::get('confide::confide.password_confirmation') }}}</th>
                <td><input type="password" autocomplete="off" value="" class="form-control" id="password2" name="password2"><br>
                <span>{{Lang::get('user_texts.note_input_pass2')}}</span></td>
            </tr>
        </tbody>
    </table>
   <button type="submit" class="btn btn-primary btn-lg btn-block">{{Lang::get('user_texts.update_profile')}}</button>
    </form>
</div>
</div>
@section('script.footer')
@parent
 {{ HTML::script('assets/js/jquery.validate.min.js') }}
    <script type="text/javascript">
        $(document).ready(function() {
            $("#registerForm").validate({
                rules: {
                    firstname: "required",
                    lastname: "required",
                    password: {
                        required: false,
                        minlength: 8
                    },
                    password2: {
                        required: false,
                        minlength: 8,
                        equalTo: "#password"
                    }
                },
                messages: {
                    firstname: "<?php echo Lang::get('user_texts.please_add_firstname') ?>",
                    lastname: "<?php echo Lang::get('user_texts.please_add_lastname') ?>",
                    password: {
                        required: "<?php echo Lang::get('user_texts.please_add_password') ?>",
                        minlength: "<?php echo Lang::get('user_texts.note_length_pass') ?>"
                    },
                    confirm_password: {
                        required: "<?php echo Lang::get('user_texts.please_add_confirmpassword') ?>",
                        minlength: "<?php echo Lang::get('user_texts.note_length_pass') ?>",
                        equalTo: "<?php echo Lang::get('user_texts.please_add_samepassword') ?>"
                    }
                }
             });
       });
    </script>
@stop
