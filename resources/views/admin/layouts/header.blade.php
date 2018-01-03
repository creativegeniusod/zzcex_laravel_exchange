<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="#" class="navbar-brand">Admin Management Panel</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-cog"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu multi-level" role="menu">
            <li>{{ HTML::link('admin/setting', trans('admin_texts.general')) }}</li>
            <li>{{ HTML::link('admin/setting/limit-trade', trans('admin_texts.limit_trade')) }}</li>
            <li>{{ HTML::link('admin/setting/time-limit-trade', trans('admin_texts.time_limit_trade')) }}</li>
            <li class="divider"></li>
            <li class="dropdown-submenu">{{ HTML::link('admin/setting/fee', trans('admin_texts.fee')) }}
              <ul class="dropdown-menu">
                <li>{{ HTML::link('admin/setting/fee', trans('admin_texts.fee_buy_sell')) }}</li>
                <li>{{ HTML::link('admin/setting/fee-withdraw', trans('admin_texts.fee_withdraw')) }}</li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-stats"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu multi-level" role="menu">
            <li>{{ HTML::link('admin/statistic/statistic-coin-exchanged', 'Exchange Stats') }}</li>
            <li class="divider"></li>
            <li class="dropdown-submenu">{{ HTML::link('admin/statistic/statistic-fees', 'Fee Stats') }}
              <ul class="dropdown-menu">
                <li>{{ HTML::link('admin/statistic/statistic-fees', trans('admin_texts.fee_buy_sell')) }}</li>
                <li>{{ HTML::link('admin/statistic/statistic-fee-withdraw', trans('admin_texts.fee_withdraw')) }}</li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu multi-level" role="menu">
            <li>{{ HTML::link('admin/manage/users', trans('admin_texts.users')) }}</li>
            <li>{{ HTML::link('admin/manage/login-histories', trans('admin_texts.login_histories')) }}</li>
            <li>{{ HTML::link('admin/manage/orders', trans('admin_texts.orders')) }}</li>
            <li class="divider"></li>
            <li class="dropdown-submenu">{{ HTML::link('admin/manage/funds', trans('admin_texts.finances')) }}
              <ul class="dropdown-menu">
                <li>{{ HTML::link('admin/manage/withdraws-queue', trans('admin_texts.withdraws_queue')) }}</li>
                <li>{{ HTML::link('admin/manage/deposits-queue', trans('admin_texts.deposits_queue')) }}</li>
                <li>{{ HTML::link('admin/manage/funds', trans('admin_texts.funds')) }}</li>
              </ul>
            </li>
            <li class="divider"></li>
            <li>{{ HTML::link('admin/manage/markets', trans('admin_texts.markets')) }}</li>
            <li>{{ HTML::link('admin/manage/wallets', trans('admin_texts.wallets')) }}</li>
            <li>{{ HTML::link('admin/manage/balance-wallets', trans('admin_texts.balance_wallets')) }}</li>
            <li>{{ HTML::link('admin/manage/coins-voting', 'Coin Voting') }}</li>
            <li>{{ HTML::link('admin/manage/method-deposit', trans('admin_texts.method_deposit')) }}</li>
            <li>{{ HTML::link('admin/manage/method-withdraw', trans('admin_texts.method_withdraw')) }}</li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-align-left"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu multi-level" role="menu">
            <li class="dropdown-submenu">{{ HTML::link('admin/content/all-page', trans('admin_texts.page')) }}
              <ul class="dropdown-menu">
                <li>{{ HTML::link('admin/content/add-page', trans('admin_texts.add_page')) }}</li>
                <li>{{ HTML::link('admin/content/all-page', trans('admin_texts.all_pages')) }}</li>
              </ul>
            </li>
            <li class="divider"></li>
            <li class="dropdown-submenu">{{ HTML::link('admin/content/all-news', trans('admin_texts.news')) }}
              <ul class="dropdown-menu">
                <li>{{ HTML::link('admin/content/add-news', trans('admin_texts.add_news')) }}</li>
                <li>{{ HTML::link('admin/content/all-news', trans('admin_texts.all_news')) }}</li>
              </ul>
            </li>
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?=url('/', $parameters = array(), $secure = null);?>"><i class="glyphicon glyphicon-home"></i></a></li>
                  </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

  <script>
	(function($){ //create closure so we can safely use $ as alias for jQuery
		$(document).ready(function(){
			// initialise plugin
			var example = $('#main-menu').superfish({
				//add options here if required
			});
		});
	})(jQuery);
</script>
