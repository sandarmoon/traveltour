<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatable;
use App\Models\Company;
use App\Models\Booking;

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

    // +================ nyi ye lin==========

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

    


    // +================ nyi ye lin==========







































}
