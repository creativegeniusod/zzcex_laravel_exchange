<!-- Edit Profile -->
<div id="cryptoexchange-points">
  <div class="panel panel-default">
    <div class="panel-heading"> 
      <span class="glyphicon glyphicon-contact-info"></span> {{{ trans('user_texts.cryptoexchange_points') }}}
    </div>
    <div class="generaltext">
        <!-- <br>          
        <strong>CryptoExchange has committed 5% of our trade revenue to go towards our CryptoExchange Points reward program</strong>         
        <br><br> -->         

        <h4>What Are CryptoExchange Points?</h4>
        CryptoExchange Points are rewards points for doing what you are already doing.  At the end of each day we review your activity from trades and referred users and award you points for that activity.
        <br><br>          

        <h4>What Can I Do With CryptoExchange Points?</h4>
        CryptoExchange Points can be traded on the exchange under the "Points/BTC" trading pair.  You can transfer CryptoExchange Points to other users.  You can also use your CryptoExchange Points to enter weekly drawings for some pretty awesome prizes.   
        We will also have a standing buy order on the exchange if you would simply like to cash them out.                  
        <br><br>
                
        <h4>How Do I Refer Users?</h4>
        There is a referral link on your dashboard page which you can use to refer users.                  
        <br><br>
        
        <h4>I Already Referred Users In The Past.  How Can I Get Credit For Those?</h4>
        Have those users enter your trade key in the "I Was Referred By" section of the dashboard.                  
        <br><br>

        <h4>How Many Points Will I Earn?</h4>
        Each point has a reward value of {{$point_per_btc}} BTC.  You will earn points based on {{$percent_point_reward_trade}}% of the trade fees collected on your account.   You will also earn points based on {{$percent_point_reward_referred_trade}}% of the trade fees collected from your referrals.
        <br><br>
        So lets say you paid out 0.1 BTC in trade fees in a given day and you had 10 referred users which also paid 0.1 BTC in trade fees each on that day.
        <br><br>
        <table border="0">
          <?php 
            $points_directly=(($percent_point_reward_trade*0.1)/100)/$point_per_btc;
            $points_referrals=(($percent_point_reward_referred_trade*0.1*10)/100)/$point_per_btc;
          ?>
        <tbody><tr><td>Points Earned Directly&nbsp;&nbsp;</td><td>{{$points_directly}} EP</td></tr>
        <tr><td>Points Earned from Referrals&nbsp;&nbsp;</td><td>{{$points_referrals}} EP</td></tr>
        <tr><td><strong>Total Points Earned that Day&nbsp;&nbsp;</strong></td><td><strong>{{($points_directly+$points_referrals)}} CP</strong></td></tr>
        </tbody></table>
                  
        <br>                  
        <h4>When Do I Get Paid My CryptoExchange Points?</h4>
        The program which calculates payouts and makes disbursements runs after midnight EST every day.                  
        <br><br>
                
        <h4>What Does It Cost To Enter The Drawing?</h4>
        Each entry will cost 0.1 CryptoExchange Point.   Users may place up to 100 entries into any single drawing.
        <br><br>
                
        <h4>What Kind of Prizes Will There Be?</h4>
        It will vary.  Graphics Cards, iPads, Script Mining Blades, etc.    We will also allow for trading your prize for BTC instead (at a reasonable conversion rate determined by us) should you reside in an area that we can not easily ship to.
        <br><br>               
    </div>  
  </div>
</div>