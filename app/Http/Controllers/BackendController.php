<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatable;
use App\Models\Company;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Facility;
use App\Models\Tour;
use App\Models\Car;
use App\Models\City;
use App\Models\Rating;
use App\Models\HotelBooking;
use App\Models\Emailcontact;
use App\Models\Packagebooking;
use App\Models\Package;
use App\Models\Type;
use Session;
use  Auth;
use Carbon\Carbon;
use DB;
use App\Models\Feedback;

class BackendController extends Controller

{

    public function partnership(){
        

        return view('backend.company');
    }


    //for backend admin. view
    public function companyDetail($id){
        $company=Company::find($id);

        return view('backend.company_detail',compact('company'));
    }

    public function getPartnershipAjax(){

        $companies=Company::all();

        $datatables=Datatable::of($companies)->with('user')
        ->addColumn('created_at',function($company){
               $date=date_create($company->created_at);
              $date= date_format($date,"Y M dS ");
              return $date;
        })
        ->addColumn('action',function($company){
                $status='';

                if($company->status ==2){
                    $color="outline-success";
                    $status='assign';
                }else{
                    $color="danger";
                    $status="revoke";
                }

                return "<button class='btn btn-danger btn-delete' data-id=".$company->id."><i class='fas fa-trash'></i></button>

               


                <a href=detail/cp/$company->id class='btn btn-info btn-edit' data-id=".$company->id."><i class='fas fa-info-circle'></i></a>

                <button class='btn btn-$color btn-partner' data-id=".$company->id." data-status=".$company->status." >".$status." </button>
                ";
            } );
        return  $datatables->make(true);

        
    }

    public function confirmPartner($id,$status){
        $company=Company::find($id);
        if($status ==1){
            $company->status=2;
        }else{
            $company->status=1;
        }
        $company->save();

        return response()->json(['success'=>'Success!']);
    }

    // car booking list for admin

    public function carBookingList(){
        $role=Auth::user()->roles[0];

            if($role->name=="car"){
                $company_id=Auth::user()->company->id;
                $bookings=Booking::whereHas('car',function($q) use ($company_id){
                    return $q->where('company_id',$company_id);
                })->get();
            }else{
                $bookings=Booking::all();
            }

        return  view('backend.carbookinglist',compact('bookings'));
    }

    public function bookingConfirmed($id,$status,$type){
        //1 for pending
        //2 for confirm
        //3 for cancel
        $booking=null;

       if($type== 1){
           //hotel confirm
           $booking=HotelBooking::find($id);
           $room=Room::find($booking->room_id);
           if($status ==2){
                $booking->status =2;
                $room->status=2;
            }

            if($status == 3){
                $booking->status =3;
                $room->status=1;
            }

            $booking->save();
            $room->save();
       }

       if($type ==2){
           //car confirm
            $booking=Booking::find($id);
            $car=Car::find($booking->car_id);
            if($status ==2){
                $booking->status =2;
                $car->status=2;
            }

            if($status == 3){
                $booking->status =3;
                $car->status=1;
            }

            $booking->save();
            $car->save();

            
       }

       if($type==3){
           //package confirm
       }

       return back();
    }

    public function carBookingDetail($id){
        $booking=Booking::find($id);

        return view('backend.car_booking_detail',compact('booking'));
    }

    // +================Aco Room Controller==========

    public function roomIndex(){
        // echo "you make";
        return view('backend.room');
    }

    public function roomCreate(){

        $types=Type::where('parent_id',1)->get();

        $facilities=Facility::whereHas('fcategory',function($q){
            $q->where('type_id',1);
        })->with('fcategory')->get();
        $data=collect($facilities);
        $data=$data->groupBy('fcategory.name')->toArray();

        return view('backend.roomcrud', ['room' => new Room(),'types'=>$types,'facilities'=>$data]);
    }

    public function roomShow($id){
        $room=Room::find($id);

        $facilities=$room->facilities;
         $data=collect($facilities);
        $data=$data->groupBy('fcategory.name')->toArray();

        // dd($data);

        return view('frontend.room_detail',compact('room','data'));
    }

    public function roomStore(Request $request){
          // dd($request);
        $galary=[];
        if($request->hasFile('galary')){

            foreach($request->file('galary') as  $k=>$file){
             $filenameWithExt = $file->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $file->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $file->storeAs('galary',$fileNameToStore,'public');
              array_push($galary,$path);
            
           }
        }

       $room= Room::create([
            'name'=>$request->name,
            'type_id'=>$request->type_id,
            'photos'=>json_encode($galary),
            'wide'=>$request->wide,
            'single'=>$request->single,
            'double'=>$request->double,
            'king'=>$request->king,
            'queen'=>$request->queen,
            'ppl'=>$request->people,
            'pricepernight'=>$request->price,
            'company_id'=>Auth::user()->company->id,
            'common'=>$request->common,
            'status'=>1,

        ]);

       $room->facilities()->attach($request->facilities); 
        // dd(json_encode($galary));

       return redirect()->route('room.index')->with('status', 'Data added!');;


    }

    public function roomEdit($id){
        $room=Room::find($id);
        
        $types=Type::where('parent_id',1)->get();

        $facilities=Facility::whereHas('fcategory',function($q){
            $q->where('type_id',1);

        })->with('fcategory')->get();


        $data=collect($facilities);
        $facilities=$data->groupBy('fcategory.name')->toArray();

        return view('backend.roomcrud',compact('room','types','facilities'));
    }
   
    public function roomUpdate(Request $request,$id){
        $room=Room::find($id);

         $oldphoto=json_decode($request->oldphoto,true);
        // dd($request);
         $galary=[];$photo='';

        if($request->hasFile('galary')){

            foreach($request->file('galary') as  $k=>$file){
             $filenameWithExt = $file->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $file->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $file->storeAs('galary',$fileNameToStore,'public');

              array_push($galary,$path);

              

              foreach($oldphoto as $v){
                // dd($v);
                 unlink(storage_path('app/public/'.$v));
               }
            
           }
           $photo=json_encode($galary);

        }else{
            $photo=json_encode($oldphoto);
        }

       $room= Room::find($id);
            $room->name=$request->name;
            $room->type_id=$request->type_id;
            $room->photos=$photo;
            $room->wide=$request->wide;
            $room->single=$request->single;
            $room->double=$request->double;
            $room->king=$request->king;
            $room->queen=$request->queen;
            $room->ppl=$request->people;
            $room->pricepernight=$request->price;
            $room->company_id=Auth::user()->company->id;
            $room->common=$request->common;
            $room->status=1;
            $room->save();
            $roomid=$room->id;
            $room->facilities()->detach();
       $room->facilities()->attach($request->facilities);

        return redirect()->route('room.index')->with('status', 'Data updated!');

    }

    public function roomDestroy($id){
       $room=Room::find($id);
       $room->delete();

       // Session::flash('status', 'data deleted successfully!');
       return response()->json(['success'=>"Successfully deleted"]);
    }

   

    
    public function  getRoomAjax(){
        // dd(Auth::user()->company->id);
        $rooms=null;
         if(Auth::check()){
            $role=Auth::user()->roles[0];

            if($role->name=="hotel"){

                $rooms= Room::with(['type','company','facilities'])
                    ->where('company_id','=',Auth::user()->company->id)->get();

            }else{
                $rooms= Room::with(['type','company','facilities'])->get();
            }
        }

       
        
        $datatables=Datatable::of($rooms)->with(['type','company','facilities'])
            ->addColumn('action',function($room){

                return "<button class='btn btn-danger btn-delete' data-id=".$room->id."><i class='fas fa-trash'></i></button>

                <a href=room/$room->id/edit class='btn btn-warning btn-edit' data-id=".$room->id."><i class='fas fa-edit'></i></a>



                <a href=room/$room->id class='btn btn-info btn-detail' data-id=".$room->id."><i class='fas fa-info-circle'></i></a>
                ";
            });

       return $datatables->make(true);

    }


    // +================ end==========



    // +=============== company detail  ============
     public function edit_company_logo(Request $request)
    {
        // dd($request);
        if($request->hasFile('file')){

            $photo = $request->file('file');
            $fileName = time().'_'.$photo->getClientOriginalName();
             
            $filepath =$photo->storeAs('logo',$fileName,'public');
            $path = $filepath;
            

        }else{
            $path = $request->old_image;
        }
   

        $company = Company::find($request->company_id);
        // dd($company->logo);
        $company->logo = $path;
        $company->save();
        return response()->json(['success'=>'Successfully']);
    }

    public function edit_main_info(Request $request)
    {
       $company = Company::find($request->id);
       $company->user->name = $request->username;
       $company->user->email = $request->email;

       $company->user->save();

       $company->name = $request->company_name;
       $company->ceo_name = $request->ceo_name;
       $company->phone = $request->phone;
       $company->addresss = $request->address;
       $company->incharge_name = $request->incharge_name;
       $company->incharge_phone = $request->incharge_phone;
       $company->incharge_position = $request->incharge_position;
       $company->save();
       return response()->json(['success'=>'Successfully']);

    }


    public function edit_company_service_info(Request $request)
    {
        // dd($request);
        if($request->service_label_one_data){

            $company = Company::find($request->id);
            $company->service_label_one = $request->service_label_one_data;
            $company->save();

        }elseif($request->service_label_two_data){

            $company = Company::find($request->id);
            $company->service_label_two = $request->service_label_two_data;
            $company->save();

        }elseif($request->service_label_three_data){

            $company = Company::find($request->id);
            $company->service_label_three = $request->service_label_three_data;
            $company->save();

        }elseif($request->service_desc_one_data){

            $company = Company::find($request->id);
            $company->service_desc_one = $request->service_desc_one_data;
            $company->save();

        }elseif($request->service_desc_two_data){
           
           $company = Company::find($request->id);
           $company->service_desc_two = $request->service_desc_two_data;
           $company->save();
            
        }elseif($request->service_desc_three_data){

            $company = Company::find($request->id);
            $company->service_desc_three = $request->service_desc_three_data;
            $company->save();
            
        }
        return response()->json(['success'=>'Successfully']);
       


    }


    public function edit_company_photo(Request $request)
    {
        // dd($request);
        if($request->hasFile('photo')){

            $photo = $request->file('photo');
            $fileName = time().'_'.$photo->getClientOriginalName();
             
            $filepath =$photo->storeAs('license',$fileName,'public');
            $path = $filepath;
            

        }else{
            $path = $request->old_photo;
        }
   

        $company = Company::find($request->company_id);
        // dd($company->logo);
        $company->photo = $path;
        $company->save();
        return response()->json(['success'=>'Successfully']);
    }

    // +============= end =======

    // hotel booking list for admin

    public function  getBackendHotelBooking(){
        $bookings=HotelBooking::all();
        return view('backend.hotel_booking_list',compact('bookings'));
    }


    public function hotelBookingDetail($id){
        $booking=HotelBooking::find($id);

        return view('backend.hotel_booking_detail',compact('booking'));
    }



    // +============= end =======

    // hotel booking list for user

    public function packageIndex(){
        return view('backend.package_list');  
    }

    public function packageCreate(){
        $tours=Tour::all();
        
        $cities=City::whereNull('parent_id')->get();
        $hotels=Company::where('type',1)->where('status',1)->get();
        $cars=Car::where('seats','>=',5)->where('status',1)->get();
        
        return view('backend.package_crud', ['package' => new Package(),'tours'=>$tours,'hotels'=>$hotels,'cars'=>$cars,'cities'=>$cities]); 
    }

    public function packageStore(Request $request){
        // start date 
        $start_date = $request->start;

        // end date 
        $end_date = $request->end;

        // call dateDifference() function to find the number of days between two dates
        $dateDiff = $this->dateDifference($start_date, $end_date);

       $package= Package::create([
            'name'=>$request->name,
            'desc'=>$request->desc,
            'depart_id'=>$request->departure,
            'arrive_id'=>$request->destination,
            'start'=>$request->start,
            'end'=>$request->end,
            'priceperperson'=>$request->priceperperson,
            'discount'=>$request->discount,
            'days'=>$dateDiff,
            'ppl'=>$request->ppl,
            'company_hotel_id'=>$request->hotel,
            'company_car_id'=>$request->car,

        ]);
        $package->tours()->attach($request->tours);
        return redirect()->route('package.index');
    }


    public function packageEdit($id){
        $package=Package::find($id);
        $tours=Tour::all();
        
        $cities=City::whereNull('parent_id')->get();
        $hotels=Company::where('type',1)->where('status',1)->get();
        $cars=Car::where('seats','>=',5)->where('status',1)->get();
        
        return view('backend.package_crud', ['package' => $package,'tours'=>$tours,'hotels'=>$hotels,'cars'=>$cars,'cities'=>$cities]); 
    }

    public function packageUpdate(Request $request,$id){
         $start_date = $request->start;

        // end date 
        $end_date = $request->end;

        // call dateDifference() function to find the number of days between two dates
        $dateDiff = $this->dateDifference($start_date, $end_date);

       $package= Package::find($id);
            $package->name=$request->name;
            $package->desc=$request->desc;
            $package->depart_id=$request->departure;
            $package->arrive_id=$request->destination;
            $package->start=$request->start;
            $package->end=$request->end;
            $package->priceperperson=$request->priceperperson;
            $package->discount=$request->discount;
            $package->days=$dateDiff;
            $package->ppl=$request->ppl;
            $package->company_hotel_id=$request->hotel;
            $package->company_car_id=$request->car;

            $package->save();
        $package->tours()->detach();
        $package->tours()->attach($request->tours);
        return redirect()->route('package.index');
    }

    function packageShow($id){
        $package=Package::find($id);
        return view('backend.package_detail',compact('package'));
    }

    function packageDestroy($id){
       
        $package=Package::find($id);
       $package->delete();

       // Session::flash('status', 'data deleted successfully!');
       return response()->json(['success'=>"Successfully deleted"]);
    }

    function getPackageAjax(){
        $package=Package::with(['depart','destination','hotel','car'=>function($q){
            return $q->with('company')->get();
        }])->get();

        $datatables=Datatable::of($package)
            ->addColumn('action',function($package){

                return "<button class='btn btn-danger btn-delete' data-id=".$package->id."><i class='fas fa-trash'></i></button>

                <a href=package/$package->id/edit class='btn btn-warning btn-edit' data-id=".$package->id."><i class='fas fa-edit'></i></a>



                <a href=package/$package->id class='btn btn-info btn-detail' data-id=".$package->id."><i class='fas fa-info-circle'></i></a>
                ";
            });

       return $datatables->make(true);

    }

    
    function dateDifference($start_date, $end_date)
    {
        // calulating the difference in timestamps 
        $diff = strtotime($start_date) - strtotime($end_date);
        
        // 1 day = 24 hours 
        // 24 * 60 * 60 = 86400 seconds
        return ceil(abs($diff / 86400));
    }


    

    




    // Tour 

    public function tourIndex(){
        $tour = Tour::all();
        return view('backend/tour',compact('tour'));
    }

    public function getTourAjax($value='')
    {
        // DB::statement(DB::raw('set @rownum=0'));
        // $tours = Tour::select([
        //     DB::raw('@rownum  := @rownum  + 1 AS rownum')]);
       

        DB::statement(DB::raw('set @rownum=0'));
        $tours = Tour::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'title',
            'city_id',
            'photo',
            'desc',
            'created_at',
            'updated_at']);

        // $tours = Tour::all();
        $datatables = Datatable::of($tours)->with(['city'])

            ->addColumn('title',function($tours){
                return $tours->title;
            } )
            ->addColumn('city',function($tours){
                return $tours->city->name;
            } )
            ->addColumn('action',function($tours){
            return '<td class="dropdown"><a class="btn btn-default actionButton"
                    data-toggle="dropdown" href="#"> Action </a></td>
                    <ul id="contextMenu" class="dropdown-menu" role="menu">
                        <li>'."<a href='#' class='nav-link text-danger btn-delete' data-id=".$tours->id.">Delete</a>".'</li>
                        <li>'."<a href=tour/$tours->id/edit class='nav-link text-warning btn-edit' data-id=".$tours->id.">Edit</a>".'</li>
                        <li>'."<a href=tour/$tours->id class='nav-link text-info btn-edit' data-id=".$tours->id.">Detail</a>".'</li>
                        
                      </ul>';
           });

        // if ($keyword = $request->get('search')['value']) {
        //      $datatables->filterColumn('rownum', function($q,$keyword){
        //         $q->whereRaw("@rownum +1  like ?", ["%{$keyword}%"]);
        //      });
            
        // }

        return $datatables->make(true);
    }


    public function tourCreate($value='')
    {
        $cities = City::whereNull('parent_id')->get();
        return view('backend.tourcrud',['tour' => new Room(),'cities'=>$cities]);
    }

    public function tourStore(Request $request)
    {
        $request->validate(['title'=>'required',
                            'city' => 'required',
                            'photo' => 'required',
                            'description' => 'required']);

        $galary=[];
        if($request->hasFile('photo')){

            foreach($request->file('photo') as  $k=>$file){
             $filenameWithExt = $file->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $file->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $file->storeAs('tour',$fileNameToStore,'public');
              array_push($galary,$path);
            
           }
        }


        $tour = new Tour;
        $tour->title = $request->title;
        $tour->city_id = $request->city;
        $tour->photo = json_encode($galary);
        $tour->desc = $request->description;
        $tour->save();
        return redirect()->route('tour.index');
    }

    public function tourEdit(Request $request,$id)
    {
        $tour = Tour::find($id);
        $cities = City::all();
        return view('backend.tourcrud',compact('tour','cities'));
    }

    public function tourUpdate(Request $request,$id)
    {
        $request->validate(['title'=>'required',
                            'city' => 'required',
                            
                            'description' => 'required']);

        $galary=[];
        if($request->hasFile('photo')){


            foreach($request->file('photo') as  $k=>$file){
             $filenameWithExt = $file->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $file->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $file->storeAs('tour',$fileNameToStore,'public');
              array_push($galary,$path);
            
           }
           $path = json_encode($galary);
        }else{
            $path = $request->oldphoto;
        }


        $tour = Tour::find($id);
        $tour->title = $request->title;
        $tour->city_id = $request->city;
        $tour->photo = $path;
        $tour->desc = $request->description;
        $tour->save();
        return redirect()->route('tour.index');
    }

    public function tourShow($id)
    {
        $tour = Tour::find($id);
        return view('backend.tourshow',compact('tour'));
    }

    public function tourDestroy($id)
    {
        $tour = Tour::find($id);
        $tour->delete();
        return response()->json(['success'=>'Successfully updated!']);
    }



    //admin packagebooking list 
    public function packageBookingList(){
        $packages=Package::withCount('pbookings')
                    ->orderBy('start','asc')
                    ->get();
                   
        
         return view('backend.package_booking_list',compact('packages'));

    }

    public function boolingListByPackageId($id){
        $package=Package::find($id);
        $bookings=Packagebooking::where('package_id',$id)
                ->orderBy('id','desc')
                ->get();
        return view('backend.pbookinglist_by_pid',compact('bookings','package'));
    }


    //for email contact user message accept

    public function contactedWithEmail(Request $request){
     
         
       
        $result = Emailcontact::create([
            'name'=>$request->name,
            'email'=>$request->name,
            'message'=>$request->message,
        ]);
        if($result){ 
        	$arr = array('msg' => 'Contact Added Successfully!', 'status' => true);
        }
        return Response()->json($arr);
        
    }


//============dashboard start============

public function carDashboard(){
    $today=Carbon::today();
    if(Auth::check()){
        $id=Auth::user()->company->id;
        $report=Company::withCount(['cars as total_car',

        'cars as car_booking'=>function($q){
            return $q->whereHas('booking',function($r){
                return $r->where('status',2);
            });
        },
        'cars as today_unconfirmed_booking'=>function($q) use ($today){
            return $q->whereHas('booking',function($r) use ($today){
                return $r->where('status',1)->whereDate('booking_date',$today);
            });
        }
        ])->find($id);

        $month = '9';
        $data=DB::table('bookings')
                    ->select('created_at as dan',DB::raw('count(id) as ukupno'))
                    ->whereDate('created_at',$today)
                    ->groupBy('dan')
                    ->get();

    
        
    }
    return view('dashboard.car',compact('report'));

    
    
}


public function getReportCar(){
        $company=Auth::user()->company->id;
        $data_array=Booking::wherehas('car',function($q)use($company){
            return $q->where('company_id',$company);
            })->get()->take(6)
            ->sortByDESC(function ($item) {
            return $item->created_at->month;
            })
            ->groupBy(function ($item) {
                return $item->created_at->format("F");
            })
            ->map
            ->sum('total');

       $data_array=collect($data_array)->toArray();
       
           // dd($data_array);
            

        $report['labels']=[];
        $report['data']=[];

        $rating['labels']=[];
        $rating['data']=[];
        $month=[];
        for($i=1; $i<6;$i++){
             
            $month[]=\Carbon\Carbon::now()->subMonth($i)->format('F');
            
        }

        foreach($month as $k=>$m){
            
            $report['labels'][]=$m;
            if(array_key_exists($m,$data_array)){
                
                $report['data'][$k]=$data_array[$m];

            }else{
                $report['data'][$k]=0;
            }
        }

        $ratings=Rating::wherehas('car',function($q)use($company){
            return $q->where('company_id',$company);
            })->get()->take(6)
            ->sortByDESC(function ($item) {
            return $item->created_at->month;
            })
            ->groupBy(function ($item) {
                return $item->created_at->format("F");
            })
            ->map
            ->sum('rate');

             $ratings=collect($ratings)->toArray();

            //dd($ratings);

        foreach($month as $k=>$m){
            
            $rating['labels'][]=$m;
            if(array_key_exists($m,$ratings)){
                
                $rating['data'][$k]=$ratings[$m];
                

            }else{
                $rating['data'][$k]=0;
            }
        }
        
        

      
        return Response()->json(['report'=>$report,'rating'=>$rating]);
    }



    

    public function hotelDashboard(){
        $today=Carbon::today();
        if(Auth::check()){
            $id=Auth::user()->company->id;
            
            $report=Company::withCount('rooms')->find($id);
            dd($report);
            
            
        }
        return view('dashboard.hotel',compact('report'));

        
        
    }

    public function getReportHotel(){
        dd('helo');
    }








//============dashboard end============




    public function feedback($value='')
    {
        $feedbacks = Feedback::all();
        $email_contact = Emailcontact::all();

        return view('backend.feedback',compact('feedbacks','email_contact'));
    }

    public function getfeedbackdataTable(Request $request){
        DB::statement(DB::raw('set @rownum=0'));
        $feedback_datas = Feedback::with('user')->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'user_id',
            'message',
            'created_at',
            'updated_at']);

        $datatables = Datatable::of($feedback_datas)->with('user')
                        ->addColumn('name',function($feedback_data){
                            return $feedback_data->user->name;
                        // })
                        // ->addColumn('action',function($feedback_data){
                        //     return "<button class='btn btn-success' data-id=". $feedback_data->id.  ">
                        //                 Confirm
                        //               </button>

                        //               <button class='btn btn-danger' data-id =".$feedback_data->id.">
                        //                 Cancel
                        //               </button>";
                        } );

        return $datatables->make(true);
    }


    public function getemailcontactdataTable(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $email_contact_datas = Emailcontact::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'name',
            'email',
            'message',
            'created_at',
            'updated_at']);

        $datatables = Datatable::of($email_contact_datas);
                        
                        // ->addColumn('action',function($email_contact_data){
                        //     return "<button class='btn btn-success' data-id=". $email_contact_data->id.  ">
                        //                 Confirm
                        //               </button>

                        //               <button class='btn btn-danger' data-id =".$email_contact_data->id.">
                        //                 Cancel
                        //               </button>";
                        // } );

        return $datatables->make(true);
    }




    














}
