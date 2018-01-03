@extends('layouts.main')
@section('title')
Api
@stop
@section('body')
<div class="container">
  	<div class="content">
  		<h1>Project Exchange API</h1>
			<div id="fees_trade" style="background-color:#fff; padding:20px 30px;min-height:600px">
				<div class="public_title" style="color:#428BCA;font-size: 18px;cursor: pointer;margin-bottom:10px;">Public API</div>
				<div class="public_content hidean" style="display:none">
					<b>Public API Methods </b><br>
					Public methods do not require the use of an api key and can be accessed via the GET method. <br><br>

					<b>General Market Data (All Markets):</b> <br>

					<?=url('/', $parameters = array(), $secure = null);?>/page/api?method=allmarket <br><br>

					<b>General Market Data (Single Market):</b> <br>

					<?=url('/', $parameters = array(), $secure = null);?>/page/api?method=singlemarket&marketid={MARKET ID} <br><br>

					<b>General Orderbook Data (All Markets):</b> <br>

					<?=url('/', $parameters = array(), $secure = null);?>/page/api?method=allorder <br><br>

					<b>General Orderbook Data (Single Market):</b> <br>

					<?=url('/', $parameters = array(), $secure = null);?>/page/api?method=singlemarket&marketid={MARKET ID}  <br><br>
				</div>
				<div class="auth_title" style="color:#428BCA;font-size: 18px;cursor: pointer;margin-bottom:10px;"> Authenticated API</div>
				<div class="auth_content hidean" style="display:none">
					<b>Authenticated API Methods</b> <br>
					Authenticated methods require the use of an api key and can only be accessed via the POST method.<br><br>

					<b>URL</b> - The URL you will be posting to is:<b> <?=url('/', $parameters = array(), $secure = null);?>/page/api?method=METHOD&key=KEY&sign=SIGN </b><br>
					Ex: <?=url('/', $parameters = array(), $secure = null);?>/page/api?method=getmarkets&key=admin@123&sign=thuythuy <br>

					<b>key</b> - Your password<br>

					<b>sign</b> - Your username<br>

					<b>Other Variables</b><br>

					<b>method</b> - The method from the list below which you are accessing.<br>

					<b>General Return Values</b><br>

					<b>success</b> - Either a 1 or a 0. 1 Represents sucessful call, 0 Represents unsuccessful<br>
					<b>error </b>- If unsuccessful, this will be the error message<br>
					<b>return</b> - If successful, this will be the data returned<br><br><br>

					<b>Method List</b> <br><br><hr>
					Method:<b>getmarkets</b><br>
					Inputs:<b>n/a</b><br>
					Outputs: Array of Active Markets <br>
					<table width="100%">
						<tr style="background: #eeeeee;"><td><b>marketid</b></td><td>Integer value representing a market</td></tr>
						<tr><td><b>label</b></td><td>Name for this market, for example: AMC/BTC</td></tr>
						<tr style="background: #eeeeee;"><td><b>primary_currency_code</b></td><td>Primary currency code, for example: AMC</td></tr>
						<tr><td><b>primary_currency_name</b></td><td>	Primary currency name, for example: AmericanCoin</td></tr>
						<tr style="background: #eeeeee;"><td><b>secondary_currency_code</b></td><td>	Secondary currency code, for example: BTC</td></tr>
						<tr><td><b>secondary_currency_name</b></td><td>	Secondary currency name, for example: BitCoin</td></tr>
						<tr style="background: #eeeeee;"><td><b>last_trade</b></td><td>Last trade price for this market</td></tr>
						<tr><td><b>high_trade</b></td><td>	24 hour highest trade price in this market</td></tr>
						<tr style="background: #eeeeee;"><td><b>low_trade</b></td><td>	24 hour lowest trade price in this market</td></tr>
						<tr><td><b>created</b></td><td>	Datetime (EST) the market was created</td></tr>
					</table>
					<br>
					<hr>
					Method:<b>getwallets</b><br>
					Inputs:<b>n/a</b><br>
					Outputs: Array of Active Wallets <br>
					<table width="100%">
						<tr style="background: #eeeeee;"><td><b>currencyid</b></td><td>Integer value representing a wallet</td></tr>
						<tr><td><b>name</b></td><td>Name for this wallet, for example: Bitcoin</td></tr>
						<tr style="background: #eeeeee;"><td><b>code</b></td><td>	Currency code, for example: BTC</td></tr>
						<tr><td><b>withdrawfee</b></td><td>Fee charged for withdrawals of this currency</td></tr>
					</table>
					<br>
					<hr>
					Method:<b>mydeposits</b><br>
					Inputs:<b>n/a</b><br>
					Outputs: Array of Deposits on your account <br>
					<table width="100%">
						<tr style="background: #eeeeee;"><td><b>currencyid</b></td><td>Integer value representing a wallet</td></tr>
						<tr><td><b>created</b></td><td>	The time the activity posted</td></tr>
						<tr style="background: #eeeeee;"><td><b>updated</b></td><td>The time the activity updated</td></tr>
						<tr><td><b>address</b></td><td>	Address to which the deposit posted was sent</td></tr>
						<tr style="background: #eeeeee;"><td><b>amount</b></td><td>	Amount of transaction (Not including any fees)</td></tr>
						<tr><td><b>transactionid</b></td><td>Network Transaction ID (If available)</td></tr>
					</table>
					<br>
					<hr>
					Method:<b>mywithdraws</b><br>
					Inputs:<b>n/a</b><br>
					Outputs: Array of Withdraws on your account <br>
					<table width="100%">
						<tr style="background: #eeeeee;"><td><b>currencyid</b></td><td>Integer value representing a wallet</td></tr>
						<tr ><td><b>created</b></td><td>	The time the activity posted</td></tr>
						<tr style="background: #eeeeee;"><td><b>toaddress</b></td><td>	Address to which the withdraws posted was received</td></tr>
						<tr><td><b>amount</b></td><td>	Amount of transaction (Not including any fees)</td></tr>
						<tr style="background: #eeeeee;"><td><b>feeamount</b></td><td>	Fee (If any) Charged for this Transaction (Generally only on Withdrawals)</td></tr>
						<tr><td><b>receiveamount</b></td><td>	Amount of transaction was received</td></tr>
						<tr style="background: #eeeeee;"><td><b>transactionid</b></td><td>Network Transaction ID (If available)</td></tr>
					</table>
					<br>
					<hr>
					Method:<b>mytransfers</b><br>
					Inputs:<b>n/a</b><br>
					Outputs: Array of Transfers on your account <br>
					<table width="100%">
						<tr style="background: #eeeeee;"><td><b>currency</b></td><td>Name representing a wallet</td></tr>
						<tr ><td><b>time</b></td><td>	The time the activity created</td></tr>
						<tr style="background: #eeeeee;"><td><b>sender</b></td><td>	Username sending transfer</td></tr>
						<tr><td><b>receiver</b></td><td>	Username receiving transfer</td></tr>
						<tr style="background: #eeeeee;"><td><b>amount</b></td><td>Amount of transaction</td></tr>
						</table>
					<br>
					<hr>
					Method:<b>getmydepositaddresses</b><br>
					Inputs:<b>n/a</b><br>
					Outputs: Array <br>
					<table width="100%">
						<tr style="background: #eeeeee;"><td><b>coincode</b></td><td>Type of wallet</td></tr>
						<tr ><td><b>despositaddress</b></td><td>Your deposit address</td></tr>
						</table>
					<br>
					<hr>
					Method:<b>allmyorders</b><br>
					Inputs:<b>n/a</b><br>
					Outputs: Array of all open orders for your account. <br>
					<table width="100%">
						<tr style="background: #eeeeee;"><td><b>orderid</b></td><td>Order ID for this order</td></tr>
						<tr ><td><b>marketid</b></td><td>	The Market ID this order was created for</td></tr>
						<tr style="background: #eeeeee;"><td><b>created</b></td><td>Datetime the order was created</td></tr>
						<tr ><td><b>ordertype</b></td><td>Type of order (Buy/Sell)</td></tr>
						<tr style="background: #eeeeee;"><td><b>price</b></td><td>The price per unit for this order</td></tr>
						<tr ><td><b>fromvalue</b></td><td>Amount from sender</td></tr>
						<tr style="background: #eeeeee;"><td><b>tovalue</b></td><td>Amount which receiver was received</td></tr>
						</table>
					<br>
					<hr>
					Method:<b>myorders</b><br>
					Inputs:<b>marketid</b>	Market ID for which you are querying<br>
					Outputs: Array of your orders for this market listing your current open sell and buy orders. <br>
					<table width="100%">
						<tr style="background: #eeeeee;"><td><b>orderid</b></td><td>Order ID for this order</td></tr>
						<tr><td><b>created</b></td><td>Datetime the order was created</td></tr>
						<tr  style="background: #eeeeee;"><td><b>ordertype</b></td><td>Type of order (Buy/Sell)</td></tr>
						<tr ><td><b>price</b></td><td>The price per unit for this order</td></tr>
						<tr  style="background: #eeeeee;"><td><b>fromvalue</b></td><td>Amount from sender</td></tr>
						<tr><td><b>tovalue</b></td><td>Amount which receiver was received</td></tr>
						</table>
					<br>
					<hr>

					Example PHP Code for making API calls: <br>
					<div>
						<pre>
		function api($method, array $req = array()) {

			$req['key'] = '';  // your password account
			$req['sign'] = '';  // your username account
			$req['method'] = $method;

			// generate the POST data string
			$post_data = http_build_query($req, '', '&');

			$re = file_get_contents('<?=url('/', $parameters = array(), $secure = null);?>/page/api?'. $post_data, true);

			$dec = json_decode($re, true);
			return $dec;
		}

		$result = api("getmarkets");
		//$result = api("getwallets");
		//$result = api("mydeposits");
		//$result = api("mywithdraws");
		//$result = api("mytransfers");
		//$result = api("getmydepositaddresses");
		//$result = api("allmyorders");
		//$result = api("myorders");

		//print_r($result, true);
						</pre>
					</div>
				</div>
				<div class="push_title" style="color:#428BCA;font-size: 18px;cursor: pointer;margin-bottom:10px;"> Push API</div>
				<div class="push_content hidean" style="display:none">
					<div class="generaltext">
						<h4>Get instant notification of trades and buy/sell ticker data</h4>

						<br>
						Using our Push API service you can get information on trades and market data in real time.   Using a client to connect to the service, you can subscribe to channels you wish to receive data on.  You can subscribe to as many channels as you wish.
						<br><br>

						<b>Channel: "trade.X"</b>&nbsp;(X is the Market ID for which you would like to subscribe. For example "trade.3" would be the LTC/BTC market)
						<br><br>
						Data format (event "message"):
						<pre>
	{
	  "channel": "trade.53",
	  "trade": {
	    "timestamp": <?=time()?>,
	    "datetime": <?php echo date("Y-m-d H:i:s T",time()); ?>,
	    "marketid": "53",
	    "marketname": "CAP/BTC",
	    "amount": "0.02523500",
	    "price": "0.00001060",
	    "total": "0.00000027",
	    "type": "Sell"
	  }
	}
						</pre>

						<br>
						<b>Channel: "ticker.X"</b>&nbsp;(X is the Market ID for which you would like to subscribe. For example "ticker.3" would be the LTC/BTC market)
						<br><br>
						Data format (event "message"):
						<pre>
	{
	  "channel": "ticker.160",
	  "trade": {
	    "timestamp": <?=time()?>,
	    "datetime": <?php echo date("Y-m-d H:i:s T",time()); ?>,
	    "marketid": "160",
	    "topsell": {
	      "price": "0.00451039",
	      "amount": "12.31881709"
	    },
	    "topbuy": {
	      "price": "0.00450001",
	      "amount": "49.28204222"
	    }
	  }
	}
						</pre>
						<br><br>
						<h4>Client Libraries</h4>
						You can find client libraries in several programming languages here:   <a href="http://pusher.com/docs/client_libraries" target="_blank">http://pusher.com/docs/client_libraries</a>
						<br><br>
						When connecting to our service you will need to use the following API Key:
						<pre>APP_KEY = '{{$pusher_app_key}}'
						</pre>
						<br>
						<h4>Sample Client Code</h4>
						<div>
							<pre>
	<xmp>
		<head>
		  <title>Pusher Test</title>
		  <script src="{{ asset('assets/js/pusher.min.js') }}"></script>
		  <!-- http://js.pusher.com/2.2/pusher.min.js -->
		  <script type="text/javascript">
		    // Enable pusher logging - don't include this in production
		    Pusher.log = function(message) {
		      if (window.console && window.console.log) {
		        window.console.log(message);
		      }
		    };

		    var pusher = new Pusher("{{$pusher_app_key}}");
		    var channel = pusher.subscribe("trade.33");
		    channel.bind("message", function(data) {
		      console.log("trade.33",data);
		    });

		    var channel2 = pusher.subscribe("ticker.33");
		    channel2.bind("message", function(data) {
		      console.log("ticker.33",data);
		    });
		  </script>
		</head>
		<body>
		  <h2>Test Pusher Client</h2>
		  <p>Please press F12 and click tab "Console" to view result</p>
		</body>
	</xmp>
						</pre>
						</div>
					</div>
				</div>
			</div>
  	</div>
</div>
@stop
@section('script.footer')
@parent
<script>
	$( ".public_title" ).click(function() {
	  $( '.hidean' ).hide();
	  $( '.public_content' ).show();
	});
	$( ".auth_title" ).click(function() {
	  $( '.hidean' ).hide();
	  $( '.auth_content' ).show();
	});
	$( ".push_title" ).click(function() {
	  $( '.hidean' ).hide();
	  $( '.push_content' ).show();
	});
</script>
@stop
