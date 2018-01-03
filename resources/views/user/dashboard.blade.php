<!-- Edit Profile -->
@section('title')
{{{ trans('user_texts.dashboard') }}}
@stop
<div id="dashboard">
    <h2>{{{ trans('user_texts.dashboard') }}}</h2>
    <div class="panel panel-default">
      <div class="panel-heading bg-lightBlue fg-white"><h2 class="panel-title"><i class="fa fa-key"></i> Trade Key</h2></div>
      <div class="panel-body">
        <div class="form-group">
              <label for="">Your Trade Key: </label>
              <table style="border:1px solid #dddddd;" class="table table-striped">
              <tbody><tr><td align="center"><strong>{{$user->trade_key}}</strong></td></tr>
              </tbody></table>
            </div>
        <p>Your trade key allows other users to send you funds for any available currency type. User to User transfers are free and require no waiting for confirmations. Trade keys are receive only addresses and thus you may give this key to anyone you wish.</p>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading bg-lightBlue fg-white"><h2 class="panel-title"><i class="fa fa-globe"></i> Your Stats</h2></div>
      <div class="panel-body">
        <table class="table striped hovered">
          <tbody>
            <tr><td width="50%" align="right">Total Trades</td><td width="50%">{{ HTML::link('user/profile/trade-history', $total_trades) }}</td></tr>
            <tr><td width="50%" align="right">Open Orders</td><td width="50%">{{ HTML::link('user/profile/orders', $total_openordes) }}</td></tr>
            <tr><td width="50%" align="right">Deposits Last 24 Hrs</td><td width="50%">{{ HTML::link('user/profile/deposits', $deposit_twentyfourhours) }}</td></tr>
            <tr><td width="50%" align="right">Withdrawals Last 24 Hrs</td><td width="50%">{{ HTML::link('user/profile/withdrawals', $withdraw_twentyfourhours) }}</td></tr>
            <tr><td width="50%" align="right">Pending Deposits</td><td width="50%">{{ HTML::link('user/profile/deposits', $deposit_pendings) }}</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading bg-lightBlue fg-white">
          <h2 class="panel-title"><i class="fa fa-users"></i> Your Referrals</h2>
        </div>
        <div class="panel-body">
            <center><i></i></center>
            <h4>Referral Link Code:</h4>

            <table style="border:1px solid #dddddd;" class="table table-striped">
            <tbody><tr><td align="center">{{URL::to('/')}}/referral/{{$user->username}}</td></tr>
            </tbody></table>

            <h4>Stats:</h4>

            <table style="border:1px solid #dddddd;" class="table table-striped">
            <tbody><tr><td align="center">Total Users Referred {{$total_referred}}</td></tr>
            </tbody></table>

            <h4>I Was Referred By:</h4>
            @if ( Session::get('error') )
                  <div class="notice marker-on-bottom bg-darkRed fg-white">
                      @if ( is_array(Session::get('error')) )
                          {{ head(Session::get('error')) }}
                      @else
                         {{ Session::get('error') }}
                      @endif
                  </div>
              @endif

              @if ( Session::get('notice') )
                  <div class="notice marker-on-bottom fg-white">{{ Session::get('notice') }}</div>
              @endif
            @if(empty($user->referral))
              No referring user found. If you would like to tell us who referred you, then enter their trade key below.
              <p><form class="form-horizontal" method="POST" action="{{{ URL::action('UserController@referreredTradeKey')  }}}">
                 {{ csrf_field() }}
                <div class="form-group">
                  <label for="inputEmail" class="col-md-3 text-right">Referrer Trade Key</label>
                  <div class="input-group col-md-8">
                    <input type="text" class="form-control" name="trade_key" required>
                    <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit">Submit Trade Key</button>
                    </span>
                  </div>
                </div>
              </form></p>
            @else
            <table style="border:1px solid #dddddd;" class="table table-striped">
              <tbody>
                <tr><td align="center"><strong>{{$user->referral}}</strong></td></tr>
              </tbody>
            </table>
            @endif
        </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading bg-lightBlue fg-white"><h2 class="panel-title"><i class="fa fa-user"></i> Your Gravatar</h2></div>
      <div class="panel-body text-center">
        <p><img src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim(Auth::user()->email ) ) ); ?>" border="0" style="border-radius: 60px;" /></p>
        <p>You may change your Gravatar by changing the Gravatar associated with your email address by clicking <a href="https://en.gravatar.com/" target="_blank">here</a>.</p>
      </div>
    </div>
  </div>
