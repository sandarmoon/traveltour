<?php
namespace App\Http\ViewComposers;
use Illuminate\View\View;
use App\Models\City;
use App\Models\Package;
use Carbon\Carbon;


class SearchingComposer 
{
  public $packages;
  public $cities;
  /**
  * Create a movie composer.
  *
  * @return void
  */
  public function __construct()
  {
     $today=Carbon::today();
     

     $this->cities=City::whereNull('parent_id')->get();
     $this->packages=Package::where('start','>=',$today)
     ->orWhere('end','<=',$today) ->get();

  }

  /**
  * Bind data to the view.
  *
  * @param View $view
  * @return void
  */
  public function compose(View $view)
  {
     $view->with(['cities'=>$this->cities, 'packages'=>$this->packages ]);
  }
}
?>
