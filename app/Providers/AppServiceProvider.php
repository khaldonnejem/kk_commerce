<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Paginator::useBootstrapFour();

        $ip = request()->ip();
        if($ip == '127.0.0.1') {
            $ip = '85.114.107.10';
            // the first ip "85.114.107.10" in dream cafe, this point stop the server and server not working coz the ip is different vs home or anywhere ip
            // you should change the ip compared to the area you are in.
            // $ip = '206.62.153.14';
        }
        $country = Http::get('http://www.geoplugin.net/json.gp?ip='.$ip)->json();
        // dd($country);
        $weather = Http::get('https://api.openweathermap.org/data/2.5/weather?q='.$country['geoplugin_regionName'].'&appid=52ab9b1eb8a8d53b7623f156fdf40e33&units=metric')->json();
        // dd(request()->ip());
        // dd($weather);
        //85.114.107.10



        View::share('weather',$weather);
        // View::share('name','khaldon');
    }
}
