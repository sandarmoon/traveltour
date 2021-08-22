<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Car;
use App\Models\Company;
use App\Models\Facility;
use App\Models\Room;

use App\Models\Booking;
use Auth;



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
    public function bookinghistory($value='')
    {
        $view = 1;
        $bookings = Booking::where('user_id',Auth::id())->get();
        $booking = array('data' => 'null');;

        return view('frontend.bookinghistory',compact('bookings','view','booking'));
    }


    public function bookingdetail(Request $request,$id){

        $view = 2;
        $bookings = array('data' => 'null');;
        $booking = Booking::find($id);
        return view('frontend.bookinghistory',compact('bookings','view','booking'));

    }

    // ===================hotel bookin start now======================
    public function searchHotel(Request $request){
        // echo "helo worl";

        $drop=$request->d_city_id;
        $s_date=$request->start_date;
        $e_date=$request->end_date;
        $common_type=$request->common_type;
        // dd($common_type);

       // $hotels=Company::where('type',1)->where('city_id',$drop)
       //  ->get();

        $hotels=Company::whereHas('room',function($q){
            $q->where('status','=','1')->orderBy('pricepernight','asc');

        })->with('room')->where('type','=','1')->get();

        // dd($hotels);


        $cities=City::whereNull('parent_id')->get();
        $drop=City::find($drop);
        $search=2;

        // dd($hotels);
        return view('frontend.hotelresult',compact('cities','s_date','e_date','drop','search','hotels'));
    }

    // rooms result from hotel id aco
    public  function  roomsByHotelId($id){
         $cities=City::whereNull('parent_id')->get();
         $h=Company::find($id);

         $rooms=Room::where('company_id',$h->id)->with('facilities')->get();

         $facilities = Facility::whereHas('rooms', function($q) use($id) {
                        $q->where('company_id', $id);
                    })
                    ->get();

            $data=collect($facilities);
            $popular_facilities=$data->groupBy('fcategory.name')->toArray();
        

         
         

         $rooms=Room::where('company_id',$h->id)->get();
        return view('frontend.hotel_rooms_list',compact('cities','h','popular_facilities','rooms'));
    }
}
