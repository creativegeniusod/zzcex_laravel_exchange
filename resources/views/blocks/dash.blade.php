<div class="dashhead"><img src="{{ asset('assets/img/btc.png') }}" border="0" height="50px" style="display: inline-block;" /> <h2>BTC Markets</h2></div>
<ul class="market dnl-nav">
<li class="title"><span class="name">COIN</span><span class="price">PRICE</span><span class="change">CHANGE</span></li>

@foreach($btc_markets as $btc_market)
<?php
	$total_btc = isset($btc_datainfo[$btc_market->id]['total'])? $btc_datainfo[$btc_market->id]['total']:0;
	$curr_price = isset($btc_datainfo[$btc_market->id][0]['price'])? $btc_datainfo[$btc_market->id][0]['price']:0;
	$pre_price = isset($btc_datainfo[$btc_market->id][1]['price'])? $btc_datainfo[$btc_market->id][1]['price']:0;
	$change = ($pre_price!=0)? sprintf('%.2f',(($curr_price-$pre_price)/$pre_price)*100):100;
	//echo "Cur: ".$curr_price." -- Pre: ".$pre_price;
 	//if($change>0) $change = '+'.$change;
?>
 
   @if($btc_market->name =="Bitcoin" || $btc_market->name =="LiteCoin" || $btc_market->name =="DogeCoin" || $btc_market->name =="Ethereum")

    <li>
     <a href="{{{ URL::to('/market/') }}}/{{$btc_market->id}}" id="volume-{{$btc_market->id}}" title="Vol: {{sprintf('%.8f',$total_btc)}} BTC" alt="Vol: {{sprintf('%.8f',$total_btc)}} BTC"><span class="name">{{$btc_market->type}}</span>
	 <span class="price" yesterdayPrice="{{sprintf('%.8f',$pre_price)}}" id="spanPrice-{{$btc_market->id}}">{{sprintf('%.8f',$curr_price)}}</span>
	 @if($change>=0)
	  <span class="change up" id="spanChange-{{$btc_market->id}}">+{{$change}}%</span>
	 @else
	  <span class="change down" id="spanChange-{{$btc_market->id}}">{{$change}}%</span>
	 @endif
	 </a>
	</li>

    @endif
@endforeach
</ul>
<div class="dashhead"><img src="{{ asset('assets/img/ltc.png') }}" border="0" height="50px" style="display: inline-block;" /> <h2>LTC Markets</h2></div>
<ul class="market dnl-nav">
<li class="title"><span class="name">COIN</span><span class="price">PRICE</span><span class="change">CHANGE</span></li>
	@foreach($ltc_markets as $ltc_market)
	<?php
		$total_ltc = isset($ltc_datainfo[$ltc_market->id]['total'])? $ltc_datainfo[$ltc_market->id]['total']:0;
		$curr_price = isset($ltc_datainfo[$ltc_market->id][0]['price'])? $ltc_datainfo[$ltc_market->id][0]['price']:0;
		$pre_price = isset($ltc_datainfo[$ltc_market->id][1]['price'])? $ltc_datainfo[$ltc_market->id][1]['price']:0;
		$change = ($pre_price!=0)? sprintf('%.2f',(($curr_price-$pre_price)/$pre_price)*100):0;
	?>
    
	@if($ltc_market->name =="Bitcoin" || $ltc_market->name =="Litecoin" || $ltc_market->name =="DogeCoin" || $ltc_market->name =="Ethereum")

    	<li>
    	<a href="{{{ URL::to('/market/') }}}/{{$ltc_market->id}}" id="volume-{{$ltc_market->id}}" title="Vol: {{sprintf('%.8f',$total_ltc)}} LTC" alt="Vol: {{sprintf('%.8f',$total_ltc)}} LTC"><span class="name">{{$ltc_market->type}}</span>
		<span class="price" yesterdayPrice="{{sprintf('%.8f',$pre_price)}}" id="spanPrice-{{$ltc_market->id}}">{{sprintf('%.8f',$curr_price)}}</span>
		@if($change>=0)
		<span class="change up" id="spanChange-{{$ltc_market->id}}">+{{$change}}%</span>
		@else
		<span class="change down" id="spanChange-{{$ltc_market->id}}">{{$change}}%</span>
		@endif</a>
		</li>

     @endif

	@endforeach
</ul>
<?php
$number_btc = isset($statistic_btc->number_trade)? $statistic_btc->number_trade:0;
$volumn_btc = (isset($statistic_btc->total) && !empty($statistic_btc->total))? sprintf('%.8f',$statistic_btc->total):0;
$number_ltc = isset($statistic_ltc->number_trade)? sprintf('%.8f',$statistic_ltc->number_trade):0;
$volumn_ltc = (isset($statistic_ltc->total) && !empty($statistic_ltc->total))? sprintf('%.8f',$statistic_ltc->total):0;
?>
<div class="dashhead"><h2 style="padding-left:5px;"><i class="fa fa-bar-chart"></i> 24 Hour Stats</h2></div>
<ul class="market stats" style="color: #FFF;">
<li>BTC Volume<span class="change">{{$volumn_btc}} BTC</span></li>
<li>LTC Volume<span class="change">{{$volumn_ltc}} LTC</span></li>
<li>Number of Trades<span class="change">{{$number_ltc+$number_btc}}</span></li>
</ul>
