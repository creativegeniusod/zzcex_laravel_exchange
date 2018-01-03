@extends('layouts.main')

@section('body')
<div class="indexblock">
	<h1 style="color: #FFF; font-size: 38px; font-weight: bold; text-shadow: 1px 1px 1px #333;">Welcome to ZZC Exchange!</h1>
	<p style="text-transform: uppercase; color: #FFF; font-size: 18px; font-weight: bold; text-shadow: 1px 1px 1px #333;">Exchange Cryptocurrency With Ease!</p>
	<br />
	<p><a class="btn btn-lg btn-primary" href="<?=url('/', $parameters = array(), $secure = null);?>/user/register">Create an Account</a> <a class="btn btn-lg btn-success" href="<?=url('/', $parameters = array(), $secure = null);?>/login">Login</a></p>
<br />
<div class="row m-auto" style="max-width: 1190px; text-shadow: 1px 1px 1px #333; color: #FFF; background-color:#444;border-radius:5px;padding:30px;">
<div class="col-md-3"><h3><i class="fa fa-bar-chart"></i> Trade Engine</h3><p style="color: #cccccc;">Our cryptocurrency trade engine is developed using cutting-edge technologies to provide a fast real-time interface.</p></div>
<div class="col-md-3"><h3><i class="fa fa-database"></i> Low Fees</h3><p style="color: #cccccc;">At just 0.15% per trade for both BUY and SELL orders, we have some of the lowest trading fees in the industry.</p></div>
<div class="col-md-3"><h3><i class="fa fa-cog"></i> API</h3><p style="color: #cccccc;">We've developed an easy to use expansive API from our market for developers and mining pools.</p></div>
<div class="col-md-3"><h3><i class="fa fa-cubes"></i> Secured Platform</h3><p style="color: #cccccc;">2FA Authentication is available and we use the latest security encryption techniques, to keep your account and funds safe!</p></div>
</div>
<div class="row m-auto m-t" style="max-width: 1190px; text-shadow: 1px 1px 1px #333; color: #FFF; font-family: 'Lato', sans-serif;background-color:#444;border-radius:5px;padding:30px;">
	<?php
	$number_btc = isset($statistic_btc->number_trade)? $statistic_btc->number_trade:0;
	$volumn_btc = (isset($statistic_btc->total) && !empty($statistic_btc->total))? sprintf('%.8f',$statistic_btc->total):0;
	$number_ltc = isset($statistic_ltc->number_trade)? sprintf('%.8f',$statistic_ltc->number_trade):0;
	$volumn_ltc = (isset($statistic_ltc->total) && !empty($statistic_ltc->total))? sprintf('%.8f',$statistic_ltc->total):0;
	?>
<div class="row m-b">
<div class="col-md-4"><h3>Total BTC Volume</h3><p style="font-family: 'Lato', sans-serif;font-weight:100;font-size:32px;">{{$volumn_btc}} BTC</p><em style="color: #ccc;">Last 24 hours</em></div>
<div class="col-md-4"><h3>Total Trades</h3><p style="font-family: 'Lato', sans-serif;font-weight:100;font-size:32px;">{{$number_ltc+$number_btc}}</p><em style="color: #ccc;">Last 24 hours</em></div>
<div class="col-md-4"><h3>Total LTC Volume</h3><p style="font-family: 'Lato', sans-serif;font-weight:100;font-size:32px;">{{$volumn_ltc}} LTC</p><em style="color: #ccc;">Last 24 hours</em></div>
</div>
<div class="indexmarket">BTC Markets</div><p>
@foreach($btc_markets as $btc_market)
<?php
	$total_btc = isset($btc_datainfo[$btc_market->id]['total'])? $btc_datainfo[$btc_market->id]['total']:0;
	$curr_price = isset($btc_datainfo[$btc_market->id][0]['price'])? $btc_datainfo[$btc_market->id][0]['price']:0;
	$pre_price = isset($btc_datainfo[$btc_market->id][1]['price'])? $btc_datainfo[$btc_market->id][1]['price']:0;
	$change = ($pre_price!=0)? sprintf('%.2f',(($curr_price-$pre_price)/$pre_price)*100):100;
	//echo "Cur: ".$curr_price." -- Pre: ".$pre_price;
	//if($change>0) $change = '+'.$change;
?>
<span style="display: inline-block; padding: 5px; background-color: #222; border-radius: 10px; margin: 5px;"><a href="{{{ URL::to('/market/') }}}/{{$btc_market->id}}"  id="volume-{{$btc_market->id}}" title="Vol: {{sprintf('%.8f',$total_btc)}} BTC" alt="Vol: {{sprintf('%.8f',$total_btc)}} BTC"><img src="{{ asset('assets/img') }}/{{$btc_market->type}}.png" width="20px" border="0" /> <span class="name marquee-label">{{$btc_market->type}}</span>
	<span class="price" style="color: #eee;" yesterdayPrice="{{sprintf('%.8f',$pre_price)}}" id="spanPrice-{{$btc_market->id}}">{{sprintf('%.8f',$curr_price)}}</span>
	@if($change>=0)
	<span class="change up" id="spanChange-{{$btc_market->id}}">+{{$change}}%</span>
	@else
	<span class="change down" id="spanChange-{{$btc_market->id}}">{{$change}}%</span>
	@endif</a>
</span>
@endforeach
</p><div class="indexmarket">LTC Markets</div><p>
@foreach($ltc_markets as $ltc_market)
<?php
	$total_ltc = isset($ltc_datainfo[$ltc_market->id]['total'])? $ltc_datainfo[$ltc_market->id]['total']:0;
	$curr_price = isset($ltc_datainfo[$ltc_market->id][0]['price'])? $ltc_datainfo[$ltc_market->id][0]['price']:0;
	$pre_price = isset($ltc_datainfo[$ltc_market->id][1]['price'])? $ltc_datainfo[$ltc_market->id][1]['price']:0;
	$change = ($pre_price!=0)? sprintf('%.2f',(($curr_price-$pre_price)/$pre_price)*100):0;
?>
<span style="display: inline-block; padding: 5px; background-color: #222; border-radius: 10px; margin: 5px;"><a href="{{{ URL::to('/market/') }}}/{{$ltc_market->id}}" id="volume-{{$ltc_market->id}}" title="Vol: {{sprintf('%.8f',$total_ltc)}} LTC" alt="Vol: {{sprintf('%.8f',$total_ltc)}} LTC"><img src="{{ asset('assets/img') }}/{{$ltc_market->type}}.png" width="20px" border="0" /> <span class="name marquee-label">{{$ltc_market->type}}</span>
	<span class="price" style="color: #eee;" yesterdayPrice="{{sprintf('%.8f',$pre_price)}}" id="spanPrice-{{$ltc_market->id}}">{{sprintf('%.8f',$curr_price)}}</span>
	@if($change>=0)
	<span class="change up" id="spanChange-{{$ltc_market->id}}">+{{$change}}%</span>
	@else
	<span class="change down" id="spanChange-{{$ltc_market->id}}">{{$change}}%</span>
	@endif</a>
</span>
@endforeach
</p>
</div>
</div>
@stop

@section('script.footer')
@parent
{{ HTML::script('assets/websocket/node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.js') }}
<script>
	function use_price(type, price, total_amount){
		// var pre = 'b_';
		// if(type==2) pre = 's_';
		// $('#'+pre+'price').val(price.toFixed(8));
		// $('#'+pre+'amount').val(total_amount.toFixed(8));
		$('#s_price').val(price.toFixed(8));
		$('#s_amount').val(total_amount.toFixed(8));
		$('#b_price').val(price.toFixed(8));
		$('#b_amount').val(total_amount.toFixed(8));
		updateDataSell();
		updateDataBuy();
	}
	$(function(){
		window.socket = {};
		socket = io.connect( 'http://localhost:8081' );
		socket.on( 'doTrade', function( data ) {
			console.log('data socket:',data);
			var market_id=data.market_id;
            //update order buy
            console.log('data message_socket: ',data.message_socket);
			$.each(data.message_socket, function(key, value){
				//console.log('obj aaa: ',key);
			    //console.log("data: "+key + ": " + value);
			    //console.log("data: "+key + ": " + value['history_trade']);
			    if(value['order_b']!== undefined){  console.log('order_b',value['order_b']);
               		var amount = parseFloat(value['order_b']['amount']).toFixed(8);
               		var total = parseFloat(value['order_b']['total']).toFixed(8);
               		var price = parseFloat(value['order_b']['price']).toFixed(8);
               		var class_price = price.replace(".","-");
            		var class_price = class_price.replace(",","-");
            		//console.log('class_price',class_price);
            		//console.log('action',value['order_b']['action']);
               		switch(value['order_b']['action']){
               			case "insert":
               				//console.log('insert orders_buy_',$('#orders_buy_'+market_id+' .price-'+class_price));
               				if($('#orders_buy_'+market_id+' .price-'+class_price).html()!==undefined){
	               				//console.log('Update buy:');
	               				var amount_old=parseFloat($('#orders_buy_'+market_id+' .price-'+class_price+' .amount').html());
	               				var total_old=parseFloat($('#orders_buy_'+market_id+' .price-'+class_price+' .total').html());

	               				$('#orders_buy_'+market_id+' .price-'+class_price+' .amount').html((parseFloat(amount_old)+parseFloat(amount)).toFixed(8));
	               				$('#orders_buy_'+market_id+' .price-'+class_price+' .total').html((parseFloat(total_old)+parseFloat(total)).toFixed(8));
	               				$('#orders_buy_'+market_id+' .price-'+class_price).addClass('blue');
	               				$('#orders_buy_'+market_id+' .price-'+class_price).attr('onclick','use_price(2,'+price +','+(parseFloat(amount_old)+parseFloat(amount)).toFixed(8)+')');
	               			}else{
	               				//console.log('Insert buy');
	               				var buy_order='<tr id="order-'+value['order_b']['id'] +'" class="order blue price-'+class_price+'" onclick="use_price(2,'+value['order_b']['price'] +','+amount+')" data-sort="'+price+'"><td class="price">'+price+'</td><td class="amount">'+amount+'</td><td class="total">'+total+'</td></tr>';
	               				if($('#orders_buy_'+market_id+' > table > tbody tr.order').length){
	               					var i_d=0;
		               				$( '#orders_buy_'+market_id+' tr.order').each(function( index ) {
							            var value = $(this).val();
							            var price_compare = parseFloat($(this).attr('data-sort'));
							            if(price>price_compare){
							            	i_d=1;
							            	$(this).before(buy_order);
							            	return false;
							            }
							        });
							        if(i_d==0){
							        	console.log( "add to the end");
							        	$('#orders_buy_'+market_id+' > table > tbody tr:last-child').after(buy_order);
							        }
	               				}else{
               						$('#orders_buy_'+market_id+' > table > tbody').html(buy_order);
               					}
	               			}
	               			//insert your order
	               			var your_order='<tr id="yourorder-'+value['order_b']['id'] +'" class="order blue price-'+class_price+'"><td><b style="color:green">Buy</b></td> <td class="price">'+price+'</td><td class="amount">'+amount+'</td><td class="total">'+total+'</td><td><span>'+value['order_b']['created_at']['date'] +'</span></td><td><a href="javascript:cancelOrder('+value['order_b']['id'] +');">Cancel</a></td></tr>';
	               			$('#yourorders_'+market_id+' > table tr.header-tb').after(your_order);
	               			//console.log('insert buy end');
               				break;
               			case "update":
               				//console.log('update buy init');
               				var amount_old=parseFloat($('#orders_buy_'+market_id+' .price-'+class_price+' .amount').html());
               				var total_old=parseFloat($('#orders_buy_'+market_id+' .price-'+class_price+' .total').html());

           					var new_amount = (parseFloat(amount_old)-parseFloat(amount)).toFixed(8);
           					var new_total = (parseFloat(total_old)-parseFloat(total)).toFixed(8);

           					if(new_amount=='0.00000000' || new_amount==0.00000000){
           						$('#orders_buy_'+market_id+' .price-'+class_price).remove();
           					}else{
           						$('#orders_buy_'+market_id+' .price-'+class_price).attr('onclick','use_price(2,'+price +','+new_amount+')');
           						$('#orders_buy_'+market_id+' .price-'+class_price+' .amount').html(new_amount);
	               				$('#orders_buy_'+market_id+' .price-'+class_price+' .total').html(new_total);
	               				$('#orders_buy_'+market_id+' .price-'+class_price).addClass('red');
           					}
               				//console.log('update buy end');

               				//update your order
               				if($('#yourorders_'+market_id+' #yourorder-'+value['order_b']['id']+' .amount')!==undefined){
               					//console.log('update your buy order init');
               					var y_amount_old=parseFloat($('#yourorders_'+market_id+' #yourorder-'+value['order_b']['id']+' .amount').html());
	               				var y_total_old=parseFloat($('#yourorders_'+market_id+' #yourorder-'+value['order_b']['id']+' .total').html());
	               				var y_new_amount = (parseFloat(y_amount_old)-parseFloat(amount)).toFixed(8);
               					if(y_new_amount=='0.00000000' || y_new_amount==0.00000000){
	           						$('#yourorders_'+market_id+' #yourorder-'+value['order_b']['id']).remove();
	           					}else{
	           						$('#yourorders_'+market_id+' #yourorder-'+value['order_b']['id']+' .amount').html(y_new_amount);
		               				$('#yourorders_'+market_id+' #yourorder-'+value['order_b']['id']+' .total').html((parseFloat(y_total_old)-parseFloat(total)).toFixed(8));
		               				$('#yourorders_'+market_id+' #yourorder-'+value['order_b']['id']).addClass('red');
	           					}
	               				//console.log('update your buy order end');
               				}
               				break;
               			case "delete":
               				$('#orders_buy_'+market_id+' .price-'+class_price).remove();
               				//$('#yourorders_'+market_id+' #yourorder-'+value['order_b']['id']).remove();
               				console.log('Delete '+'#orders_buy_'+market_id+' .price-'+class_price);
               				//$('#orders_buy_'+market_id+' #order-'+value['order_b']['id']).remove();
               				break;
               		}
               	}
               	//update order sell
               	if(value['order_s'] !== undefined){
               		var amount = parseFloat(value['order_s']['amount']).toFixed(8);
               		var total = parseFloat(value['order_s']['total']).toFixed(8);
               		var price = parseFloat(value['order_s']['price']).toFixed(8);
               		var class_price = price.replace(".","-");
            		var class_price = class_price.replace(",","-");
            		//console.log('order_s',value['order_s']);
            		//console.log('action',value['order_s']['action']);
            		//console.log('class_price',class_price);
               		switch(value['order_s']['action']){
               			case "insert":
               				//console.log('insert orders_sell_',$('#orders_sell_'+market_id+' .price-'+class_price));
               				if($('#orders_sell_'+market_id+' .price-'+class_price).html()!==undefined){
               					//console.log('Update sell:');
               					var amount_old=parseFloat($('#orders_sell_'+market_id+' .price-'+class_price+' .amount').html());
	               				var total_old=parseFloat($('#orders_sell_'+market_id+' .price-'+class_price+' .total').html());

	               				$('#orders_sell_'+market_id+' .price-'+class_price+' .amount').html((parseFloat(amount_old)+parseFloat(amount)).toFixed(8));
	               				$('#orders_sell_'+market_id+' .price-'+class_price+' .total').html((parseFloat(total_old)+parseFloat(total)).toFixed(8));
	               				$('#orders_sell_'+market_id+' .price-'+class_price).addClass('blue');
	               				$('#orders_sell_'+market_id+' .price-'+class_price).attr('onclick','use_price(1,'+price +','+(parseFloat(amount_old)+parseFloat(amount)).toFixed(8)+')');
               				}else{
	               				//console.log('Insert sell');
               					var orders_sell='<tr id="order-'+value['order_s']['id'] +'" class="order blue price-'+class_price+'" onclick="use_price(1,'+value['order_s']['price'] +','+amount+')" data-sort="'+price+'"><td class="price">'+price+'</td><td class="amount">'+amount+'</td><td class="total">'+total+'</td></tr>';
               					//$('#orders_sell_'+market_id+' > table tr.header-tb').after(orders_sell);
               					if($('#orders_sell_'+market_id+' > table > tbody tr.order').length){
               						var i_d=0;
	               					$( '#orders_sell_'+market_id+' tr.order').each(function( index ) {
							            var value = $(this).val();
							            var price_compare = parseFloat($(this).attr('data-sort'));
							            if(price<price_compare){
							            	i_d=1;
							            	$(this).before(orders_sell);
							            	return false;
							            }
							        });
							        if(i_d==0){
							        	console.log( "add to the end");
							        	$('#orders_sell_'+market_id+' > table > tbody tr:last-child').after(orders_sell);
							        }
               					}else{
               						$('#orders_sell_'+market_id+' > table > tbody').html(orders_sell);
               					}
               				}
               				//insert your order
	               			var your_order='<tr id="yourorder-'+value['order_s']['id'] +'" class="order blue price-'+class_price+'"><td><b style="color:red">Sell</b></td> <td class="price">'+price+'</td><td class="amount">'+amount+'</td><td class="total">'+total+'</td><td><span>'+value['order_s']['created_at']['date'] +'</span></td><td><a href="javascript:cancelOrder('+value['order_s']['id'] +');">Cancel</a></td></tr>';
	               			$('#yourorders_'+market_id+' > table tr.header-tb').after(your_order);
               				//console.log('insert sell init');
               				break;
               			case "update":
               				//console.log('update sell init');
               				var amount_old=parseFloat($('#orders_sell_'+market_id+' .price-'+class_price+' .amount').html());
               				var total_old=parseFloat($('#orders_sell_'+market_id+' .price-'+class_price+' .total').html());

           					var new_amount = (parseFloat(amount_old)-parseFloat(amount)).toFixed(8);
           					var new_total = (parseFloat(total_old)-parseFloat(total)).toFixed(8);
           					if(new_amount=='0.00000000' || new_amount==0.00000000){
           						$('#orders_sell_'+market_id+' .price-'+class_price).remove();
           					}else{
           						$('#orders_sell_'+market_id+' .price-'+class_price).attr('onclick','use_price(1,'+price +','+new_amount+')');
           						$('#orders_sell_'+market_id+' .price-'+class_price+' .amount').html(new_amount);
	               				$('#orders_sell_'+market_id+' .price-'+class_price+' .total').html(new_total);
	               				$('#orders_sell_'+market_id+' .price-'+class_price).addClass('red');
           					}
           					//console.log('update sell end');
               				//update your order
               				if($('#yourorders_'+market_id+' #yourorder-'+value['order_s']['id']+' .amount')!==undefined){
               					console.log('update your order sell init');
               					var y_amount_old=parseFloat($('#yourorders_'+market_id+' #yourorder-'+value['order_s']['id']+' .amount').html());
               					var y_total_old=parseFloat($('#yourorders_'+market_id+' #yourorder-'+value['order_s']['id']+' .total').html());

               					var y_new_amount = (parseFloat(y_amount_old)-parseFloat(amount)).toFixed(8);
               					if(y_new_amount=='0.00000000' || y_new_amount==0.00000000){
	           						$('#yourorders_'+market_id+' #yourorder-'+value['order_s']['id']).remove();
	           					}else{
	           						$('#yourorders_'+market_id+' #yourorder-'+value['order_s']['id']+' .amount').html(y_new_amount);
		               				$('#yourorders_'+market_id+' #yourorder-'+value['order_s']['id']+' .total').html((y_total_old-total).toFixed(8));
		               				$('#yourorders_'+market_id+' #yourorder-'+value['order_s']['id']).addClass('red');
	           					}
	           					//console.log('update your order sell end');
               				}
               				break;
               			case "delete":
               				$('#orders_sell_'+market_id+' .price-'+class_price).remove();
               				//$('#yourorders_'+market_id+' #yourorder-'+value['order_s']['id']).remove();
               				console.log('Delete '+'#orders_sell_'+market_id+' .price-'+class_price);
               				//$('#orders_sell_'+market_id+' #order-'+value['order_s']['id']).remove();
               				break;
               		}
               	}
               	//update trade history
               	if(value['history_trade']!== undefined){console.log('history_trade',value['history_trade']);
               		//console.log('history_trade init');
               		console.log('history_trade',value['history_trade']);
               		var trade_new = '<tr id="trade-'+value['history_trade']['id'] +'" class="order blue">';
               		trade_new += '<td><span>'+value['history_trade']['created_at']+'</span></td>';
               		if(value['history_trade']['type'] == 'sell')
			            trade_new += '<td><b style="color:red;text-transform: capitalize;">'+value['history_trade']['type']+'</b></td>';
			        else
			            trade_new += '<td><b style="color:green;text-transform: capitalize;">'+value['history_trade']['type']+'</b></td>';
			        var total = parseFloat(value['history_trade']['price'])*parseFloat(value['history_trade']['amount']);
			        var amount = parseFloat(value['history_trade']['amount']).toFixed(8);

			        trade_new += '<td>'+parseFloat(value['history_trade']['price']).toFixed(8)+'</td>';
			        trade_new += '<td>'+amount+'</td>';
          			trade_new += '<td>'+total.toFixed(8)+'</td>';
               		trade_new+='</tr>';
               		$('#trade_histories_'+market_id+' > table tr.header-tb').after(trade_new);
               		$('#yourorders_'+market_id+' #yourorder-'+value['history_trade']['order_id']).remove();
               	}
			});

           	//update % change price
           	//console.log('change_price init: ',data.change_price);
           	if(data.change_price !== undefined){
          		var pre_price = parseFloat($('#spanPrice-'+market_id).html());
          		var curr_price = data.change_price.cur_price;
          		var volume=parseFloat(data.change_price.total_volume).toFixed(8);
          		var change = 100;//data.change_price.change
          		if(pre_price!=0) change = (((curr_price-pre_price)/pre_price)*100).toFixed(2);
          		console.log('pre_price: '+pre_price+' -- curr_price: '+curr_price+' -- change: '+change);
          		$('#spanPrice-'+market_id).html(parseFloat(curr_price).toFixed(8));
          		$('#spanPrice-'+market_id).attr('yesterdayPrice',parseFloat(pre_price).toFixed(8));
          		//$('#volume-'+market_id).html(parseFloat(data.change_price.total_volume).toFixed(8));
          		$('#volume-'+market_id).attr('data-hint','Vol: '+volume+' BTC');
          		//console.log('change: ',change);
          		//console.log('change 1: ',data.change_price.change);
           		if(change>=0){
           			//console.log('Up ');
           			$('#spanChange-'+market_id).removeClass('up down').addClass('up');
           			$('#spanChange-'+market_id).html('+'+change+'%');
           			//console.log('Up 1a ');
           		}else{
           			//console.log('Down ');
           			$('#spanChange-'+market_id).removeClass('up down').addClass('down');
           			$('#spanChange-'+market_id).html(''+change+'%');
           			//console.log('Down a');
           		}
           	}
           	//update block price
           	if(data.data_price !== undefined){
           		console.log('data_price: ',data.data_price);
           		var old_lastprice = $('#spanLastPrice-'+market_id).html();
           		var new_lastprice=parseFloat(data.data_price.lastest_price).toFixed(8);
           		if(new_lastprice<old_lastprice) $('#lastprice-'+market_id).addClass('red');
           		else $('#lastprice-'+market_id).addClass('blue');
           		$('#spanLastPrice-'+market_id).html(new_lastprice);
           		$('#spanHighPrice-'+market_id).html(parseFloat(data.data_price.get_prices.max).toFixed(8));
           		$('#spanLowPrice-'+market_id).html(parseFloat(data.data_price.get_prices.min).toFixed(8));
           		$('#spanVolume-'+market_id).html(parseFloat(data.data_price.get_prices.volume).toFixed(8));
           		$('#cur_to').html(data.data_price.balance_coinsecond);
           		$('#cur_from').html(data.data_price.balance_coinmain);
           	}

           	setTimeout(function(){
           		$('table tr').removeClass("new");
           		$('table tr,li, div.box').removeClass("blue red");
           		$('#s_message, #b_message').html('');
           	},10000);
		});
	});
</script>
@stop
