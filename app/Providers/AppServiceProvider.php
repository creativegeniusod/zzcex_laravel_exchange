<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Models\Post;
use App\Models\User;
use HomeController;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

     /*   $user = User::where('is_admin',1)->first();      
        // View::share('user',$user);      
        View::share('fname',$user->fname);      
        View::share('lname',$user->lname);*/


      View::composer('layouts.main', function($view)
      {
        $menu_pages = Post::where('type','page')->where('show_menu',1)->get();
        $view->with('menu_pages', $menu_pages); 

        $ltc_usd=app('App\Http\Controllers\HomeController')->getJsonFeed('ltc_usd'); 
        $btc_usd=app('App\Http\Controllers\HomeController')->getJsonFeed('btc_usd'); 
        //echo "<pre>ltc_usd: "; print_r($ltc_usd); echo "</pre>"; die;
        $ltc_usd=$ltc_usd['last'];
        $btc_usd=$btc_usd['last'];
        $view->with('btc_usd', $btc_usd);   
        $view->with('ltc_usd', $ltc_usd);   

        //get all locales
        /*$locales=Config::get( 'app.locales' );*/
        $locales = config()->get( 'app.locales' );
        $view->with('locales', $locales);
       });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
