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
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\Booking;
use Auth;
use DB;
use Carbon;



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
        $booking_historys = HotelBooking::where('user_id',Auth::id())->get()->groupBy(function($data){

            $date = $data->created_at->format('Y-m-d');
            // $check_in = $data->check_in;
            $array = array(
                        'date' =>$date,  
                        );
            return $array;

        });

        $booking = array();;

        return view('frontend.bookinghistory',compact('bookings','booking_historys','view','booking'));
    }


    public function bookingdetail(Request $request,$id){
        
        $view = 2;
        $booking_historys = array();

        $bookings = array();;
        $booking = Booking::find($id);
        return view('frontend.bookinghistory',compact('bookings','view','booking','booking_historys'));

    }


    public function roombookingdetail(Request $request,$data){

        $view = 3;
        $booking_historys = array();
        $bookings = array();
        $booking = array();
        $hotelbooking = HotelBooking::where('user_id',Auth::id())->whereDate('created_at',$data)->get();
        // dd($hotelbooking);

        return view('frontend.bookinghistory',compact('bookings','view','booking','hotelbooking','booking_historys'));

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
}
