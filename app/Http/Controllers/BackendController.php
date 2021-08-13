<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatable;
use App\Models\Company;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Facility;
use App\Models\Type;
use Session;

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

                <a href=company/$company->id/edit class='btn btn-warning btn-edit' data-id=".$company->id."><i class='fas fa-edit'></i></a>



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
        $bookings=Booking::all();
        return  view('backend.carbookinglist',compact('bookings'));
    }

    public function bookingConfirmed($id,$status){
        //1 for pending
        //2 for confirm
        //3 for cancel

        $booking=Booking::find($id);
        if($status ==2){
            $booking->status =2;
        }

        if($status == 3){
            $booking->status =3;
        }

        $booking->save();

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
          dd($request);
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
            'company_id'=>1,
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
            $room->company_id=1;
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
        $rooms= Room::with(['type','company','facilities'])->get();

        $datatables=Datatable::of($rooms)
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


    public function edit_general_info(Request $request)
    {
        $tab=1;
        $company = Company::find($request->id);
        $company->service_label_one = $request->service_label_one;
        $company->service_label_two = $request->service_label_two;
        $company->service_label_three = $request->service_label_three;
        $company->service_desc_one = $request->service_desc_one;
        $company->service_desc_two = $request->service_desc_two;
        $company->service_desc_three = $request->service_desc_three;
        $company->save();
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




































}
