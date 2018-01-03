<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



#################################################################################
// Config route site frontend

Route::get('/','IndexController@index'); //call home page
Route::get('market', 'HomeController@index'); // call trade page
Route::get('market/{market}', 'HomeController@index');
Route::get('page/{page}', 'HomeController@routePage');
Route::post('get-chart', 'HomeController@getChart');
Route::post('voting', 'VoteCoinController@doVoting');
Route::get('maintenance', 'HomeController@maintenanceMode');
Route::get('/locale/{locale}', 'BaseController@setLocale' ); //link guide: http://laravel-vsjr.blogspot.com/2013/08/managing-laravel-4-localization-language.html
//pages , news
Route::get('post/{post}', 'HomeController@viewPost');
#################################################################################

//trading
Route::post('dobuy', 'OrderController@doBuy');
Route::post('dosell', 'OrderController@doSell');
Route::post('docancel', 'OrderController@doCancel');
Route::post('dotest', 'HomeController@doTest');
Route::post('get-orderdepth-chart', 'OrderController@getOrderDepthChart');

// Confide routes
Route::get( 'referral/{referral}','UserController@create');
Route::get( 'user/register','UserController@create');
/*Route::post('user','UserController@store');*/
Route::post('user','Auth\RegisterController@store');
Route::get( 'login','UserController@login');
Route::post('user/login','Auth\LoginController@do_login');
Route::get( 'user/confirm/{code}','UserController@confirm');
Route::get( 'user/forgot_password','UserController@forgot_password');
Route::post('user/forgot','UserController@do_forgot_password');
Route::get( 'user/reset_password/{token}','UserController@reset_password');
Route::post('user/reset_password','UserController@do_reset_password');
Route::get('user/logout','UserController@logout');
Route::get('check-captcha','UserController@checkCaptcha');
Route::post('user/update-setting','UserController@updateSetting');
Route::post('user/add-infoverify','UserController@addInfoVerify');


//user profile
Route::group(array('before' => 'auth','prefix' => 'user','middleware' => 'auth'), function () {

  Route::get('profile', 'UserController@viewProfile');
  Route::get('profile/{page}', 'UserController@viewProfile');
  Route::post('profile/{page}', 'UserController@viewProfile');
  Route::get('profile/{page}/{filter}', 'UserController@viewProfile');
  Route::post('profile/{page}/{filter}', 'UserController@viewProfile');
  Route::get('deposit/{wallet_id}', 'UserController@formDeposit');
  Route::get('withdraw/{wallet_id}', 'UserController@formWithdraw');
  Route::post('withdraw', 'UserController@doWithdraw');
  Route::get('withdraw-comfirm/{withdraw_id}/{confirmation_code}', 'UserController@comfirmWithdraw');
  Route::post('referrer-tradekey', 'UserController@referreredTradeKey');
  Route::post('cancel-withdraw', 'UserController@cancelWithdraw');
  
  //transfer
  Route::get('transfer-coin/{wallet_id}', 'UserController@formTransfer');
  Route::post('transfer-coin', 'UserController@doTransfer');
  /* Route::post('viewtranfer/{type}', 'UserController@viewTransferOut');*/
  Route::post('notify-deposit', 'UserController@addDepositCurrency');
  Route::post('notify-withdraw', 'UserController@addWithdrawCurrency');
  
});

//authy two-factor auth
Route::post( '/postrequestauth', 'AuthController@ajaxRequestInstallation' );
/*Route::post( '/first_auth', 'UserController@firstAuth' );*/
Route::post( '/first_auth', 'Auth\LoginController@firstAuth' );
Route::post( 'user/verify_token', 'AuthController@ajVerifyToken' );
Route::post( '/postuninstalltwoauth', 'AuthController@ajaxUninstallation' );

//trading
Route::post('dobuy', 'OrderController@doBuy');
Route::post('dosell', 'OrderController@doSell');
Route::post('docancel', 'OrderController@doCancel');
Route::post('dotest', 'HomeController@doTest');
Route::post('get-orderdepth-chart', 'OrderController@getOrderDepthChart');

//deposit
Route::post('generate-addr-deposit', 'DepositController@generateNewAddrDeposit');
Route::get('cron-update-deposit', 'DepositController@cronUpdateDeposit');
Route::get('callback-update-deposit/{wallet_type}', 'DepositController@callbackUpdateDeposit');
Route::get('callback-update-deposit-test/{wallet_type}', 'DepositController@callbackUpdateDeposit_test');
Route::get('blocknotify-update-deposit/{wallet_type}', 'DepositController@blocknotifyUpdateDeposit');

//HybridAuth
//http://www.mrcasual.com/on/coding/laravel4-package-management-with-composer/
Route::get('social/{action?}', array("as" => "hybridauth",'uses' => 'UserController@socialLogin'));
Route::get('sms-verify', 'UserController@formSMSVerify');
Route::post( 'user/social_verify_token', 'AuthController@socialAjVerifyToken' );

//Only logged in admin can access or send requests to these pages
Route::group(['prefix' => 'admin','middleware' =>array('auth','admin_auth')], function(){

   /* Route::post('admin_logout', 'AdminAuth\LoginController@logout');*/
    Route::get('/', 'AdminAuth\Admin_SettingController@routePage');
    Route::get('setting', 'AdminAuth\Admin_SettingController@routePage');
    Route::get('setting/{page}', 'AdminAuth\Admin_SettingController@routePage');
    Route::get('setting/{page}/{pager_page}', 'AdminAuth\Admin_SettingController@routePage');
    Route::get('statistic/{page}', 'AdminAuth\Admin_SettingController@routePage');

    //content
    Route::get('content/{page}', 'AdminAuth\Admin_SettingController@routePage');
    Route::get('content/{page}/{pager_page}', 'AdminAuth\Admin_SettingController@routePage');

    //manage
    Route::get('manage/{page}', 'AdminAuth\Admin_SettingController@routePage');
    Route::post('manage/{page}', 'AdminAuth\Admin_SettingController@routePage');
    Route::post('manage/{page}/{pager_page}', 'AdminAuth\Admin_SettingController@routePage');
    Route::get('manage/{page}/{pager_page}', 'AdminAuth\Admin_SettingController@routePage');
    Route::post('update-setting', 'AdminAuth\Admin_SettingController@updateSetting');
    Route::post('set-fee-trade', 'AdminAuth\Admin_SettingController@setFeeTrade');
    Route::post('set-fee-withdraw', 'AdminAuth\Admin_SettingController@setFeeWithdraw');
    Route::post('add-coin-vote', 'AdminAuth\Admin_SettingController@addNewCoinVote');
    Route::post('delete-coin-vote', 'AdminAuth\Admin_SettingController@deleteCoinVote');

    //user
    Route::post('add-user', 'AdminAuth\Admin_SettingController@addNewUser');
    Route::get('edit-user/{user}', 'AdminAuth\Admin_SettingController@editUSer');
    Route::post('edit-user', 'AdminAuth\Admin_SettingController@doEditUSer');
    Route::post('delete-user', 'AdminAuth\Admin_SettingController@deleteUSer');
    Route::post('ban-user', 'AdminAuth\Admin_SettingController@banUSer');

    //wallet
    Route::post('add-wallet', 'AdminAuth\Admin_SettingController@addNewWallet');
    Route::get('edit-wallet/{wallet}', 'AdminAuth\Admin_SettingController@editWallet');
    Route::post('edit-wallet', 'AdminAuth\Admin_SettingController@doEditWallet');
    Route::post('delete-wallet', 'AdminAuth\Admin_SettingController@deleteWallet');

    //market
    Route::post('add-market', 'AdminAuth\Admin_SettingController@addNewMarket');
    Route::post('delete-market', 'AdminAuth\Admin_SettingController@deleteMarket');
    Route::post('disable-market', 'AdminAuth\Admin_SettingController@disableMarket');

    //pages , news
    Route::post('add-post', 'AdminAuth\Admin_SettingController@addNewPost');
    Route::get('edit-post/{post}', 'AdminAuth\Admin_SettingController@editPost');
    Route::post('edit-post', 'AdminAuth\Admin_SettingController@doEditPost');
    Route::post('delete-post', 'AdminAuth\Admin_SettingController@deletePost');
    Route::post('send-coin', 'AdminAuth\Admin_SettingController@doSendCoin');
    Route::get('backup', 'AdminAuth\Admin_SettingController@formBackup');
    Route::post('restore', 'AdminAuth\Admin_SettingController@doBackup');
    Route::get('restore', 'AdminAuth\Admin_SettingController@formRestore');
    Route::post('restore', 'AdminAuth\Admin_SettingController@doRestore');

    //limit trade
    Route::post('add-limit-trade', 'AdminAuth\Admin_SettingController@addNewLimitTrade');
    Route::get('edit-limit-trade/{wallet}', 'AdminAuth\Admin_SettingController@editLimitTrade');
    Route::post('edit-limit-trade', 'AdminAuth\Admin_SettingController@doEditLimitTrade');
    Route::post('delete-limit-trade', 'AdminAuth\Admin_SettingController@deleteLimitTrade');

  //time limit trade
    Route::post('add-time-limit-trade', 'AdminAuth\Admin_SettingController@addNewTimeLimitTrade');
    Route::get('edit-time-limit-trade/{wallet}', 'AdminAuth\Admin_SettingController@editTimeLimitTrade');
    Route::post('edit-time-limit-trade', 'AdminAuth\Admin_SettingController@doEditTimeLimitTrade');
    Route::post('delete-time-limit-trade', 'AdminAuth\Admin_SettingController@deleteTimeLimitTrade');
    Route::get('verify-user/{user}', 'AdminAuth\Admin_SettingController@verifyUSer');
    Route::post('verify-user', 'AdminAuth\Admin_SettingController@doVerifyUSer');

    //method deposit currency
    Route::post('add-method-deposit', 'AdminAuth\Admin_SettingController@addNewMethodDeposit');
    Route::get('edit-method-deposit/{method}', 'AdminAuth\Admin_SettingController@editMethodDeposit');
    Route::post('edit-method-deposit', 'AdminAuth\Admin_SettingController@doEditMethodDeposit');
    Route::post('delete-method-deposit', 'AdminAuth\Admin_SettingController@deleteMethodDeposit');
    Route::post('update-send-deposit', 'AdminAuth\Admin_SettingController@doUpdateSendDeposit');

    //method withdraw currency
    Route::post('add-method-withdraw', 'AdminAuth\Admin_SettingController@addNewMethodWithdraw');
    Route::get('edit-method-withdraw/{method}', 'AdminAuth\Admin_SettingController@editMethodWithdraw');
    Route::post('edit-method-withdraw', 'AdminAuth\Admin_SettingController@doEditMethodWithdraw');
    Route::post('delete-method-withdraw', 'AdminAuth\Admin_SettingController@deleteMethodWithdraw');
    Route::post('update-takemoney-withdraw', 'AdminAuth\Admin_SettingController@doUpdateTakeMoneyWithdraw');

});
