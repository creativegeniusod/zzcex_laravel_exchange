<ul class="market" id="ticker">
@foreach($btc_markets as $btc_market)
<?php
  $total_btc = isset($btc_datainfo[$btc_market->id]['total'])? $btc_datainfo[$btc_market->id]['total']:0;
  $curr_price = isset($btc_datainfo[$btc_market->id][0]['price'])? $btc_datainfo[$btc_market->id][0]['price']:0;
  $pre_price = isset($btc_datainfo[$btc_market->id][1]['price'])? $btc_datainfo[$btc_market->id][1]['price']:0;
  $change = ($pre_price!=0)? sprintf('%.2f',(($curr_price-$pre_price)/$pre_price)*100):100;
  //echo "Cur: ".$curr_price." -- Pre: ".$pre_price;
  //if($change>0) $change = '+'.$change;
?>
<li><span><a href="{{{ URL::to('/market/') }}}/{{$btc_market->id}}"><span class="name">{{$btc_market->type}}</span>
  <span class="price" yesterdayPrice="{{sprintf('%.8f',$pre_price)}}" id="spanPrice-{{$btc_market->id}}">{{sprintf('%.8f',$curr_price)}}</span>
  @if($change>=0)
  <span class="change up" id="spanChange-{{$btc_market->id}}">+{{$change}}%</span>
  @else
  <span class="change down" id="spanChange-{{$btc_market->id}}">{{$change}}%</span>
  @endif</a>
  </span></li>
@endforeach
</ul>
