<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class SearchingComposerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->searchingshare();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function searchingshare(){
       View::composer(
           ['frontend.home',
           'frontend.result',
           'frontend.show_all_hotels',
           'frontend.hotelresult'
           ],'App\Http\ViewComposers\SearchingComposer');

    }
}
