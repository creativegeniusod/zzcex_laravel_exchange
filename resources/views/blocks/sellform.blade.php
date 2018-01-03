<div class="row rowform m-auto m-t-xl"><div class="panel panel-default"><div class="panel-heading">
  <h3>{{{ trans('texts.sell')}}} {{{ $coinmain }}}</h3>
  {{{ trans('texts.your_balance')}}}: <a href="javascript:void(0)" onclick="a_calc(17)"><b><span id="cur_to" class="money_rur">{{{ $balance_coinmain }}}</span> {{{ $coinmain }}}</b></a></center>
</div><div class="panel-body">
  <form>

    <div class="col-md-6 col-xs-4">
      <label>{{{ trans('texts.amount')}}} {{{ $coinmain }}}</label><br /><br />
      <label>{{{ trans('texts.price_per')}}} {{{ $coinmain }}}</label><br /><br /><br /><br />
      <label>{{{ trans('texts.total')}}}</label><br /><br />
      <label>{{{ trans('texts.trading_fee')}}}</label><br /><br />
      <label>{{{ trans('texts.net_total')}}}</label><br /><br />
    </div>

    <div class="col-md-6 col-xs-8">
      <div class="input-group text">
          <input id="s_amount" class="form-control" name="s_amount" type="text" value="0" maxlength="15">
          <span class="input-group-addon">{{{ $coinmain }}}</span>
      </div><br />
      <div class="input-group text" data-role="input-control">
          <input id="s_price" class="form-control" name="s_price" type="text"  maxlength="10" value="{{$sell_lowest}}">
          <span class="input-group-addon">{{{ $coinsecond }}}</span>
      </div><br /><br />
      <b id="s_all"></b> <b>{{{ $coinsecond }}}</b><br /><br />
      <b id="s_fee"></b> <b>{{{ $coinsecond }}} (<span id="fee_sell">{{$fee_sell}}</span>%)</b><br /><br />
      <b id="s_net_total"></b> <b>{{{ $coinsecond }}}</b><br /><br />
    </div>
    <div class="col-md-12 col-xs-12 text-center">
    <span id="s_message"></span>
    <input type="hidden" name="sell_market_id" id="sell_market_id" value="{{{Session::get('market_id')}}}">
    <button type="button" class="btn btn-lg btn-primary" id="do_sell">{{ trans('texts.sell')}} {{{ $coinmain }}}</button>
  </div>
  </form>
</div></div></div>
@section('script.footer')
@parent
<script type="text/javascript">
  function updateDataSell(){
    var amount = $('#s_amount').val();
    var price = $('#s_price').val();
    var fee = $('#fee_sell').html();
    var total = amount*price;
    var fee_amount = total*(fee/100);
    $('#s_all').html(total.toFixed(8));
    $('#s_fee').html(fee_amount.toFixed(8));
    $('#s_net_total').html((total-fee_amount).toFixed(8));
  }
  $(function(){
    updateDataSell();
    $('#s_amount, #s_price').keyup(function(event) {
      updateDataSell();
    });
    $('#do_sell').click(function(e) {
      $(this).hide();
      e.preventDefault();
        var market_id = $('#sell_market_id').val();
        var price = parseFloat($('#s_price').val()).toFixed(8);
        var amount = parseFloat($('#s_amount').val()).toFixed(8);
        var balance = parseFloat($('#cur_from').html());
        var fee = $('#fee_sell').html();
        var total = amount*price;
        var fee_amount = total*(fee/100);
        var net_total = total+fee_amount;
        if(!$('body').hasClass('logged')) {
          $('#s_message').html('<div class="alert alert-danger">{{trans('messages.login_to_buy')}}</div>');
          $(this).show();
        }else if(isNaN(price) || price < 0.00000001){
          $('#s_message').html('<div class="alert alert-danger">{{trans('messages.message_min_price',array('price'=> '0.00000001'))}}</div>');
          $(this).show();
        }
        else if(isNaN(amount) || amount < {{$limit_trade['min_amount']}} || amount > {{$limit_trade['max_amount']}}){
          $('#s_message').html('<div class="alert alert-danger">{{trans('messages.message_limit_trade',array('min_amount'=> $limit_trade['min_amount'],'max_amount'=> $limit_trade['max_amount']))}}</div>');
          $(this).show();
        }
        else if(balance < amount){
          $('#s_message').html('<div class="alert alert-danger">{{trans('messages.sell_not_enough')}}</div>');
          $(this).show();
        }
		else if((net_total +{{$amount_sum_day}}) > {{$limit_day}}){
			$('#s_message').html('<div class="alert alert-danger">{{trans('messages.limit_sum_day')}} {{$limit_day}} {{ $coinsecond }}</div>');
			$(this).show();
		  }
        /*else if(amount>10){
          $('#s_message').html('<p style="color:red; font-weight:bold;text-align:center;">{{trans('messages.message_max_amount',array('amount'=> '10'))}}</p>');
        }*/else{ $('#s_message').html('<p style="color:red; font-weight:bold;text-align:center;"></p>');
          $.post('<?php echo action('OrderController@doSell')?>', {isAjax: 1, price: price, amount: amount, market_id:market_id }, function(response){
            var obj = $.parseJSON(response);
            //app.BrainSocket.message('doTrade',obj.message_socket);
            socket.emit( 'doTrade', obj.message_socket);
            if(obj.status == 'success'){

			  /*
			  $.Dialog({ shadow: true, overlay: true, draggable: true, icon: '',  title: 'Message', width: 500, padding: 10, content: 'This Window is draggable by caption.', sysButtons: {  btnClose: true  },
                  sysBtnCloseClick: function(e){
                      //location.reload();
                  },
                  onShow: function(){
                      //$.Dialog.title();
                      $.Dialog.content('<p style="color:#008B5D; font-weight:bold;text-align:center;">'+obj.message+'</p>');
                      /*$('body').click(function(event) {
                        location.reload();
                      });
                    $("#do_sell").show();
                  }
                });
				*/

				$('#s_message').html('<p style="color:red; font-weight:bold;text-align:center;">'+obj.message+'</p>');
				$("#do_sell").show();

            }else{
              /*$.Dialog({  shadow: true, overlay: true, draggable: true, icon: '', title: 'Message', width: 500, padding: 10, content: 'This Window is draggable by caption.',  onShow: function(){  $.Dialog.content('<p style="color:red; font-weight:bold;text-align:center;">'+obj.message+'</p>'); } });*/
			  $('#s_message').html('<p style="color:red; font-weight:bold;text-align:center;">'+obj.message+'</p>');
              $("#do_sell").show();
            }
          });
        }
    });
  });
</script>
@stop
