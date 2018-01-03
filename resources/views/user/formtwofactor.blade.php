<!-- Security -->
@section('title')
{{{ trans('user_texts.security') }}}
@stop
<h2>{{{ trans('user_texts.security')}}}</h2>
<div class="panel panel-default">
  <div class="panel-heading bg-lightBlue fg-white"><h2 class="panel-title"><i class="fa fa-key"></i> Authy Two-Factor Authentication</h2></div>
  <div class="panel-body text-center">
    @if(empty(Auth::user()->authy))
      <h3><img src="{{asset('assets/img/authy_icon.png')}}"> {{{ trans("user_texts.two_factor_auth")}}}: <span class="label label-danger">DISABLED</span></h3>
      <!-- <button type="submit" id="install-two-auth" class="btn btn-lg btn-primary">{{{ trans('user_texts.install')}}}</button> -->
      <!-- Modals -->
		      <form class="rowform m-auto" role="form">
					<div class="form-group">
				      <label class="control-label" for="inputEmail">{{{ trans('user_texts.code_country')}}}</label><br />
				      	<input id="authy-countries" name="country-code" required>
				    </div>
				    <div class="form-group">
				      <label class="control-label" for="inputPassword">{{{ trans('user_texts.phone_number')}}}</label><br />
				        <input id="phone" name="phone" type="text" maxlength="10">
				    </div>
				    <br>
				    <div class="form-group notice marker-on-top bg-darkRed fg-white" id="mesage-errors" style="display:none">
				    </div>
		      </form>
		      	<button type="submit" id="post-two-auth" class="btn btn-primary btn-lg">Enable Authy 2FA</button>
        </div>
      </div>
      <script type="text/javascript">
    		$(function(){
    			$('#install-two-auth').click(function(e) {
    		      //$('#messageModal').modal({show:true});
    		  });
    		  $('#post-two-auth').click(function(e) {
    		      var phone = $('#phone').val();
    		      var code_area = $('input[name=country-code]').val();
              var _token =  $('meta[name="csrf-token"]').attr('content');
    		      	$.post('<?php echo action('AuthController@ajaxRequestInstallation')?>', {isAjax: 1, phone:phone, code_area:code_area,
                  _token:_token}, function(response){
    		      		console.log('response: ',response);
    			        var obj = $.parseJSON(response);
    			        if(obj.status=='error'){
    			        	var errors = obj.errors;
    			        	var html = '<p>'+errors.message+'</p><p>'+errors.country_code+'</p><p>'+errors.cellphone+'</p>';
    			        	$('#mesage-errors').html(html).show();
    			        }else{
    			        	location.reload();
    			        }

    			    });
    		    });

    		});
  		</script>
    @else
      <h3><img src="{{asset('assets/img/authy_icon.png')}}"> {{{ trans("user_texts.two_factor_auth")}}}: <span class="label label-success">ENABLED</span></h3>
      <button type="submit" id="uninstall-two-auth" class="btn btn-lg btn-primary">{{{ trans('user_texts.uninstall')}}}</button>
      <p><div class="alert alert-danger">We recommend you keep 2FA enabled on your account for security purposes!</div></p>
      <script type="text/javascript">
    		$(function(){
    		    $('#uninstall-two-auth').click(function(e) {
    		      	$.post('<?php echo action('AuthController@ajaxUninstallation')?>', {isAjax: 1}, function(response){
    		      		console.log('response: ',response);
    			        var obj = $.parseJSON(response);
    			        if(obj.status=='error'){
    			        	var errors = obj.errors;
    			        	var html = '<p>'+errors.message+'</p><p>'+errors.country_code+'</p><p>'+errors.cellphone+'</p>';
    			        	$('#mesage-errors').html(html);
    			        }else{
    			        	location.reload();
    			        }

    			    });
    		    });
    		});
  		</script>
    @endif
</div>
{{HTML::style('assets/css/flags.authy.css')}}
{{HTML::style('assets/css/form.authy.css')}}
{{ HTML::script('assets/js/form.authy.js') }}
