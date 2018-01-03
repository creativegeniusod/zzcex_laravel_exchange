<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top dash-navbar-top dnl-visible">
      <div class="container-sm">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          @if (Request::is('market', 'market/*'))
          <button class="dnl-btn-toggle hidden-xs">
              <span class="fa fa-arrow-left"></span>
          </button>
          @endif
          <a class="navbar-brand" href="<?=url('/', $parameters = array(), $secure = null);?>"><img src="{{ asset('assets/img/logo.svg') }}" border="0" width="167px"/></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li @if(Request::is('market', 'market/*')) {{'class="active"'}} @endif><a href="<?=url('/market', $parameters = array(), $secure = null);?>">Markets</a></li>
          <!--   <li @if(Request::is('page/voting')) {{'class="active"'}} @endif>{{ HTML::link('page/voting', trans('user_texts.voting'), array('class' => Request::is('page/voting')?'active':'')) }}</li> -->
            <li @if(Request::is('page/fees')) {{'class="active"'}} @endif>{{ HTML::link('page/fees', trans('user_texts.fees'), array('class' => Request::is('page/fees')?'active':'')) }}</li>
            <li><a href="#" data-toggle="modal" data-target="#HelpModal"><i class="fa fa-question-circle"></i> Help</a></li>
            <li><a href="#" class="text-small"><img src="{{ asset('assets/img/btc.png') }}" border="0" height="33px" /> <span class="text-small blue">${{sprintf('%.2f',$btc_usd)}} USD</span></a></li>
            <li><a href="#" class="text-small"><img src="{{ asset('assets/img/ltc.png') }}" border="0" height="33px" /> <span class="text-small blue">${{sprintf('%.2f',$ltc_usd)}} USD</span></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          @if ( Auth::guest() )
            <li @if(Request::is('register')) {{'class="active"'}} @endif><a href="<?=url('/', $parameters = array(), $secure = null);?>/user/register" class="navitem text-small {{Request::is('register')?'active':''}}">{{trans('user_texts.register')}}</a></li>
            <li @if(Request::is('login')) {{'class="active"'}} @endif><a href="<?=url('/', $parameters = array(), $secure = null);?>/login" class="navitem text-small {{Request::is('login')?'active':''}}">{{trans('user_texts.login')}}</a></li>
            <!-- <li><a href="<?=url('/social/facebook', $parameters = array(), $secure = null);?>" class="navitem text-small"><img width="20px" src="{{asset('assets/img/face_login.png')}}"></a></li> -->
            <!-- <li><a href="<?=url('/social/google', $parameters = array(), $secure = null);?>" class="navitem text-small"><img width="20px" src="{{asset('assets/img/google_login.png')}}"></a></li> -->
          @if(!empty($locales))
           <!--  <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-flag"></i> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                @foreach($locales as $locale)
                  <li @if(Session::get( 'locale' )==$locale) {{'class="active"'}} @endif>{{ HTML::link('locale/'.$locale, trans('frontend_texts.'.$locale)) }}</li>
                @endforeach
              </ul>
            </li> -->
          @endif

          
          @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim(Auth::user()->email)) ); ?>" height="33px" border="0" style="border-radius:60px;" /> {{trans('user_texts.hello')}} {{Auth::user()->username}} <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                      <li @if(Request::is('user/profile/dashboard')) {{'class="active"'}} @endif>{{ HTML::link('user/profile/dashboard', trans('user_texts.dashboard')) }}</li>
                      <li @if(Request::is('user/profile/verify')) {{'class="active"'}} @endif>{{ HTML::link('user/profile/verify', trans('user_texts.verify_account')) }}</li>
                      <li @if(Request::is('user/profile')) {{'class="active"'}} @endif>{{ HTML::link('user/profile', trans('user_texts.profile')) }}</li>
                      <li @if(Request::is('user/profile/two-factor-auth')) {{'class="active"'}} @endif>{{ HTML::link('user/profile/two-factor-auth', trans('user_texts.security')) }}</li>
                      <li @if(Request::is('user/profile/balances')) {{'class="active"'}} @endif>{{ HTML::link('user/profile/balances', trans('user_texts.balance')) }}</li>
                      <li @if(Request::is('user/profile/deposits')) {{'class="active"'}} @endif>{{ HTML::link('user/profile/deposits', trans('user_texts.deposits')) }}</li>
                      <li @if(Request::is('user/profile/withdrawals')) {{'class="active"'}} @endif>{{ HTML::link('user/profile/withdrawals', trans('user_texts.withdrawals')) }}</li>
                      <li @if(Request::is('user/profile/orders')) {{'class="active"'}} @endif>{{ HTML::link('user/profile/orders', trans('user_texts.orders')) }}</li>
                      <li @if(Request::is('user/profile/trade-history')) {{'class="active"'}} @endif>{{ HTML::link('user/profile/trade-history', trans('user_texts.trade_history')) }}</li>
                      <li class="divider"></li>
                      <li>{{ HTML::link('user/logout', trans('user_texts.logout')) }}</li>
              </ul>
            </li>
          @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Help Modal -->
<div class="modal fade" id="HelpModal" tabindex="-1" role="dialog" aria-labelledby="HelpModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="HelpModalLabel">Help</h2>
      </div>
      <div class="modal-body">
        <h4>Welcome to Project Exchange!</h4>
        If you are looking for our API, please click here: {{ HTML::link('page/api', trans('user_texts.api'), array('class' => Request::is('page/api')?'active':'')) }}
        <p>If you are needing support please use our ticket system located here: <a href="#">Ticket Support</a></p>
        <p>We are a next generation cryptocurrency exchange. Project Exchange utilizies the latest technologies to provide a top-notch secure trading engine and real-time updates.</p>
        <p><em>Copyright &copy; 2015 Project Exchange. All Rights Reserved.</em></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
