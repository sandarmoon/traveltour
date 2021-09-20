<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Car;
use App\Models\Company;
use App\Models\Facility;
use App\Models\Room;
use App\Models\User;
use App\Models\HotelBooking;
use App\Models\Packagebooking;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\Booking;
use App\Models\Package;
use Auth;
use DB;
use Carbon\Carbon;
use App\Models\Rating;
use App\Models\Tour;
use App\Models\Feedback;


class FrontController extends Controller
{
    public function index()
    {
        $cities=City::whereNull('parent_id')->get();

        $rooms=Room::all();
        
        $today=Carbon::today();
        $packages=Package::where('start','>=',$today)
                            ->orWhere('end','<=',$today)
                            ->get();

        
        $cars=Car::where('status','=',1)->get();
       
        //company -> type -> 1 ->hotel
        //company -> type ->2 ->car
        $partners = Company::all();
        $hotels=Company::where('type','=',1)->get();
        $tour = Tour::all();

        if(count($tour) > 10){
            $tours_carousel = Tour::all()->random(4);
        }else{
            $tours_carousel = Tour::orderBy('id','DESC')->get();
        }
        


        // $tours = Tour::inRandomOrder()->get();
        $feedbacks = Feedback::all();
        if(count($feedbacks) > 8){

            $feedback_data = Feedback::all()->random(8);

        }else{

            $feedback_data = Feedback::orderBy('id','DESC')->get();

        }


        return view('frontend.home',compact('cities','rooms','packages','cars','rooms','hotels','partners','tours_carousel','feedback_data'));

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

     //car detail view from home blade  
    public function carDetailUserView($id){
       return view('frontend.car_user_detail');
    }

    //car detail get by carid using ajax
    public function carDetailbyIdAjax($id){
       $car=Car::with('pickuppivot.parent','company')->find($id);

       return response()->json(['car'=>$car]);
    }



    // +=========== booking detail========
    public function bookinghistory($value='')
    {
        $view = 1;
        $bookings = Booking::where('user_id',Auth::id())->orderBy('id','DESC')->get();

        $booking_historys = HotelBooking::where('user_id',Auth::id())->orderBy('id','DESC')->get()->groupBy(function($data){

            $date = $data->created_at->format('Y-m-d');
            // $check_in = $data->check_in;
            $array = array(
                        'date' =>$date,  
                        );
            return $array;

        });

        $packages_booking = Packagebooking::where('user_id',Auth::id())->orderBy('id','DESC')->get();

        $booking = array();;

        return view('frontend.bookinghistory',compact('bookings','booking_historys','view','booking','packages_booking'));
    }


    public function bookingdetail(Request $request,$id){
        
        $view = 2;
        $booking_historys = array();
        $package_booking = array();
        $packages_booking = array();
        $bookings = array();;
        $booking = Booking::find($id);

        return view('frontend.bookinghistory',compact('bookings','view','booking','booking_historys','packages_booking','package_booking'));

    }


    public function roombookingdetail(Request $request,$data){

        $view = 3;
        $booking_historys = array();
        $bookings = array();
        $booking = array();
        $package_booking = array();
        $packages_booking = array();
        $hotelbooking = HotelBooking::where('user_id',Auth::id())->whereDate('created_at',$data)->get();
        // dd($hotelbooking);

        return view('frontend.bookinghistory',compact('bookings','view','booking','hotelbooking','booking_historys','package_booking','packages_booking'));

    }


    public function pacakgebooking_detail($id)
    {
        $view = 4;
        $package_booking = Packagebooking::find($id);
        $booking_historys = array();
        $bookings = array();
        $booking = array();
        $packages_booking = array();
        $hotelbooking = array();

        return view('frontend.bookinghistory',compact('bookings','view','booking','hotelbooking','booking_historys','packages_booking','package_booking'));
    }




    // ===================hotel bookin start now======================
    public function searchHotel(Request $request){
        // echo "helo worl";
       
         $validator = Validator::make($request->all(), [
            'd_city_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error_code', 2);
        }

        $drop=$request->d_city_id;
        $s_date=$request->start_date;
        $e_date=$request->end_date;
        $common_type=1;
        // dd($common_type);

       // $hotels=Company::where('type',1)->where('city_id',$drop)
       //  ->get();

        $hotels=Company::whereHas('room',function($q){
            $q->where('status','=','1')
                ->orderBy('pricepernight','asc');

        })->with('room')->where('type','=','1')->get();

        // dd($hotels);


        $cities=City::whereNull('parent_id')->get();
        $drop=City::find($drop);
        $search=1;

        // dd($hotels);
        return view('frontend.hotelresult',compact('cities','s_date','e_date','drop','search','hotels','common_type'));
    }

    // rooms result from hotel id aco
    public  function  roomsByHotelId(Request $request){
        
        $h_id=$request->h_id;
        $drop_id=$request->drop_id;
        $s_date=$request->s_date;
        $e_date=$request->e_date;
        $sdate=date_create($request->s_date );
         $start_date=date_format($sdate,"m/d/Y");
        

        $edate=date_create($request->e_date );
         $end_date=date_format($edate,"m/d/Y");
        
       
        $search=$request->search;
        $common_type=$request->c_type;

         $cities=City::whereNull('parent_id')->get();
         $h=Company::find($h_id);

         $rooms=Room::whereDoesntHave('hotelBookings',function($q) use ($start_date,$end_date){
                $q->whereDate('check_in','>=',$start_date)
                ->whereDate('check_out','<=',$end_date);
         })->where('company_id',$h->id)->with(['facilities','type'])->get();
        
        
         

         $facilities = Facility::whereHas('rooms', function($q) use($h_id) {
                        $q->where('company_id', $h_id);
                    })
                    ->get();

        $data=collect($facilities);
        $popular_facilities=$data->groupBy('fcategory.name')->toArray();
        

         
         

         
        return view('frontend.hotel_rooms_list',compact('cities','h','popular_facilities','rooms','drop_id','s_date','e_date'));
    }

    public  function filterByPplCount(Request $request,$c,$hid){
        
        
        $data=$request->data;
       $ppl=collect($data['r']);
       $max_ppl=$ppl->max('total');
       $min_ppl=$ppl->min('total');

       
        $drop_id=$data['desti'];
        $s_date=$data['start'];
        $e_date=$data['end'];

        $rooms=Room::where('company_id',$hid)
                    ->where('ppl','>=',$max_ppl)
                    ->with(['facilities','type'])
                    ->get();

        return response()->json(['data'=>json_encode($rooms)]);

      

        
    }

    // Room booking startng from user

   public function bookingRoom($id){
       $room=Room::find($id);
         return view('frontend.room_booking_detail',compact('room'));
   }

    
    public function roomBooking(Request $request){
        
        $cart=json_decode($request->data,true);
        $mycart=(object)($cart);

        $destination=City::find($mycart->desti);
        $start_date=$mycart->start;
        $end_date=$mycart->end;
        
        
        $id=$request->r_id;
        $room=Room::find($id);
        

        return view('frontend.room_booking_detail',compact('destination','start_date','end_date','room'));
        

        

    }

    //hotel-email-booking-validation
    public function customEmailValidation(Request $request){
      
         $validated = $request->validate([
        'email' => 'required|unique:users|max:255',
        
        ]);

        return response()->json(['msg'=>'0']);
    }


    //hotel-booking-chcekout
    public function hotelBookingCheckout(Request $request){
     
         $booking_date=date("d/m/Y");
         $tax=10;
        
        $booking_code = $this->generateRandomString(5);

        if(empty($request->user_id)){
             $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
             event(new Registered($user));
            $user->assignRole('customer');
             Auth::login($user);
             $request->user_id=$user->id;
        }

        $room=Room::find($request->room_id);
        $price=$room->pricepernight;
        $total=($price * $request->days) + $tax;

        
        HotelBooking::create([
            'user_id'=>$request->user_id,
            'codeno'=>$booking_code,
            'booking_date'=>$booking_date,
            'check_in'=>$request->check_in,
            'check_out'=>$request->check_out,
            'room_id'=>$room->id,
            'days'=>$request->days,
            'total'=>$total,
            'taxfee'=>$tax,
            'adult'=>$request->adult,
            'child'=>$request->child,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'msg'=>$request->msg
            ]);

        return response()->json(['success'=>'Success booking']);


    }

    function generateRandomString($length = 20) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }



    // packagedetail
    public function packagedetail($id)
    {
        $package = Package::withCount('pbookings')->find($id);
        
        return view('frontend.packagedetail',compact('package'));
    }
    // ----- ----- ----- ----- -- package booking of user view start  ----- ----- ----- ----- ----- ----- ----- -----
    public function packagebooking($id,$ppl){
       
       $package=Package::find($id);
       return view('frontend.package_booking_detail',compact('ppl','package'));

    }

    public function packageBookingCheckout(Request $request){
        $data=(object)$request->data;

       $ppl=$data->ppl;
       $msg=$data->msg;
       $phone=$data->phone;
       $address=$data->address;
       $package=Package::find($data->id);
        $codeno=$this->generateRandomString(5);
        $userid=Auth::user()->id;
        $total=$package->priceperperson * $ppl;
        

        Packagebooking::create([
            'codeno'=>$codeno,
            'user_id'=>$userid,
            'package_id'=>$package->id,
            'msg'=>$msg,
            'phone'=>$phone,
            'ppl'=>$ppl,
            'total'=>$total,
            'address'=>$address
        ]);

        return response()->json(['msg'=>'1']);
        
        

    }


    // Rating
    public function rating(Request $request)
    {
        $array = [];
        $hotel_array = [];
        $rate = Rating::where('user_id',Auth::id())->get();

        
            if($request->car_id){
                if(count($rate) > 0){
                    foreach($rate as $value){

                        if($value->car_id == $request->car_id){
                            array_push($array,$request->car_id);
                        }
                    }

                }
            }


            if($request->hotel_id){
                if(count($rate) > 0){
                    foreach($rate as $value){
                        if($value->company_hotel_id == $request->hotel_id){
                            array_push($hotel_array,$value->rate);
                        }
                    }

                }
            }

            if(count($array) > 0){

                $rating = Rating::where('car_id',$request->car_id)->where('user_id',Auth::id())->first();

            }elseif(count($hotel_array) > 0){

                $rating = Rating::where('company_hotel_id',$request->hotel_id)->where('user_id',Auth::id())->first();

            }

            else{

                $rating = new Rating;

            }
        

        
        if($request->car_id){

            $rating->car_id = $request->car_id;

        }elseif($request->hotel_id){

            $rating->company_hotel_id = $request->hotel_id;

        }
        $rating->type_id = $request->type_id;
        $rating->rate = $request->rating;

        $rating->user_id = Auth::id();
        $rating->save();
        return "Ok";

    }


    public function tour_guide_detail($id)
    {
        $tour_guide = Tour::find($id);
        $cities = City::all();
        return view('frontend.tour_guide_detail',compact('tour_guide','cities'));
    }




    public function ajax_tour_guide(Request $request)
    {
        $tour_guide = Tour::find($request->id);
        $cities = City::with('tours')->get();
        $array = array('city'=>$cities,'tour_guide'=>$tour_guide);
        


        return $array;
    }




}
