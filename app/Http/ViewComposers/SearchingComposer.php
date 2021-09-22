<?php
namespace App\Http\ViewComposers;
use Illuminate\View\View;
use App\Models\City;
use App\Models\Package;
use App\Models\Car;
use App\Models\Type;
use App\Models\Company;
use App\Models\Feedback;
use App\Models\Room;
use Carbon\Carbon;


class SearchingComposer 
{
  public $packages;
  public $cities;
  public $car_data;
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

     $this->car_data=Car::orderBy('model','desc')->get();

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

  public function hotels(View $view){
      $view->with(['all_hotels'=>Company::where('type',1)->get()]);
  }

  public function hoteltypes(View $view){
     $view->with('hoteltypes',Type::where('parent_id',1)->get());
  }

  public function popularfeedback(View $view){
      $feedbacks = Feedback::all();
        if(count($feedbacks) > 8){

            $feedback_data = Feedback::all()->random(8);

        }else{

            $feedback_data = Feedback::orderBy('id','DESC')->get();

        }
     $view->with('feedback_data',$feedback_data);
  }
}
?>
