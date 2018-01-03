@extends('admin.layouts.master')
@section('content')	
{{ HTML::script('assets/js/bootstrap-paginator.js') }}
<h2>{{trans('admin_texts.time_limit_trade')}}</h2>
@if ( Session::get('error') )
      <div class="alert alert-error">{{{ Session::get('error') }}}</div>
	@endif
	@if ( Session::get('success') )
      <div class="alert alert-success">{{{ Session::get('success') }}}</div>
	@endif

	@if ( Session::get('notice') )
	      <div class="alert">{{{ Session::get('notice') }}}</div>
	@endif
<a href="javascript:void()" id="add_limittrade_link">{{trans('admin_texts.add_time_limit_trade')}}</a>
<form class="form-horizontal" role="form" id="add_limit_trade" method="POST" action="{{{ url('/admin/add-time-limit-trade') }}}">	
    {{ csrf_field() }}
	<div class="form-group">
	    <label for="inputEmail3" class="col-sm-2 control-label">{{trans('admin_texts.wallet')}}</label>
	    <div class="col-sm-10">
	    	<div class="input-append">
			  <select name="wallet_id">
			  	@foreach($wallets as $wallet)
			  		<option value="{{$wallet->id}}" @if(Input::old('wallet_id')==$wallet->id) selected @endif>{{$wallet->name}}</option>
			  	@endforeach
			  </select>			  
			</div>	      	      
	    </div>
	</div>		 
	<div class="form-group">
	    <label for="inputEmail3" class="col-sm-2 control-label">{{trans('admin_texts.limit_amount')}}</label>
	    <div class="col-sm-10">
	    	<div class="input-append">
			  <input type="text" class="form-control" name="limit_amount" id="min_amount" value="{{{ Input::old('min_amount') }}}">			  
			</div>	      	      
	    </div>
	</div>	
	<div class="form-group">
	    <label for="inputPassword3" class="col-sm-2 control-label">{{trans('admin_texts.time_limit')}}</label>
	    <div class="col-sm-10">
	    	<div class="input-append">
			  <select class="valid" name="time_limit">
					<option value="per day">per day</option>
					<option value="per week">per week</option>
				</select>
			</div>	      
	    </div>
	</div>
	  
	<div class="form-group">
		<input type="hidden" class="form-control" id="market_id" name="market_id">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-primary" id="do_edit">{{trans('admin_texts.save')}}</button>
	    </div>
	</div>
</form>
<div id="messages"></div>
<table class="table table-striped" id="list-fees">
	<tr>
	 	<th>{{trans('admin_texts.wallet')}}</th>
	 	<th>{{trans('admin_texts.limit_amount')}}</th>
	 	<th>{{trans('admin_texts.time_limit')}}</th>
	 	<th>{{trans('admin_texts.action')}}</th>
	</tr> 
	@foreach($limit_trades as $limit_trade)
	<tr>
		<td><strong>{{$limit_trade->wallet_name}}</strong></td>
		<td>{{$limit_trade->limit_amount}} {{$limit_trade->wallet_type}}</td>
		<td>{{$limit_trade->time_limit}} </td>
		<td><a href="{{URL::to('admin/edit-time-limit-trade')}}/{{$limit_trade->wallet_id}}" class="edit_limittrade">{{trans('admin_texts.edit')}}</a></td>
	</tr>
	@endforeach 
</table>
<div id="pager"></div>
{{ HTML::script('assets/js/jquery.validate.min.js') }}
<script type="text/javascript">
(function($){ 
	$(document).ready(function(){
		$('#add_limit_trade').hide();
		$('#add_limittrade_link').click(function(event) {
        	$('#add_limit_trade').toggle("slow");
        });
		$("#add_limit_trade").validate({
                rules: {
                	min_amount: {
				      required: true,
				      number: true
				    },
				    max_amount: {
				      required: true,
				      number: true
				    }                   
                },
                messages: {
                    min_amount: {
                        required: "Please enter minimal amount.",
                        number: "Please enter a number."
                    },
                    max_amount: {
                        required: "Please enter maximum amount.",
                        number: "Please enter a number."
                    }                    
                }
             });
	});
})(jQuery);
</script>
<script type='text/javascript'>
    var options = {
        currentPage: <?php echo $cur_page ?>,
        totalPages: <?php echo $total_pages ?>,
        alignment:'right',
        pageUrl: function(type, page, current){
        	return "<?php echo URL::to('admin/setting/time-limit-trade'); ?>"+'/'+page; 
        }
    }
    $('#pager').bootstrapPaginator(options);
</script>
@stop