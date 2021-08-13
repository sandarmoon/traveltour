<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Car;

use App\Models\Booking;
use Auth;

use App\Models\Room;

class FrontController extends Controller
{
    public function index()
    {
        $cities=City::whereNull('parent_id')->get();

        $rooms=Room::all();

        return view('frontend.home',compact('cities','rooms'));
    }

    public function searchCar(Request $request){
        $pickup=$request->p_city_id;
        $drop=$request->d_city_id;
        $s_date=$request->start_date;
        $e_date=$request->end_date;

        $cars=Car::where('city_id',$pickup)->get();
        $pickup=City::find($pickup);
        $drop=City::find($drop);

        // if($startdate == null && $enddate ==null)
        // {
        //     $cars=Car::where('city_id',$from_city)->get();
        
        // }
         $cities=City::whereNull('parent_id')->get();
         // dd($cars);
         $search=1;
        return view('frontend.result',compact('cities','cars','s_date','e_date','pickup','drop','search'));
    }


    // +=========== booking detail========
    public function bookingdetail($value='')
    {
        $bookings = Booking::where('user_id',Auth::id())->get();
        return view('frontend.bookingdetail',compact('bookings'));
    }

    // ===================hotel bookin start now======================
    public function searchHotel(Request $request){
        // echo "helo worl";

        $drop=$request->d_city_id;
        $s_date=$request->start_date;
        $e_date=$request->end_date;
        $common_type=$request->common_type;

       
        $cities=City::whereNull('parent_id')->get();
        $drop=City::find($drop);
        $search=2;
        return view('frontend.hotel',compact('cities','s_date','e_date','drop','search'));
    }
}
