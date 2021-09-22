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
        $this->sharingcars();
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
           [ 'components.searchingnew',
                'frontend.home',
                'frontend.result'
           ],'App\Http\ViewComposers\SearchingComposer');
        $this->sharinghoteltypes();

    }

    public function sharingcars(){
       View::composer(
           [
           'components.fliter-component',
           'frontend.show_all_hotels',
           
           
           ],'App\Http\ViewComposers\SearchingComposer@hotels');

    }

    public function sharinghoteltypes(){
        View::composer(
           [
           'components.fliter-component'
           
           ],'App\Http\ViewComposers\SearchingComposer@hoteltypes');
    }
}
