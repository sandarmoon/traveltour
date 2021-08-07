<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Fcategory;
use App\Models\Type;
use Illuminate\Http\Request;
use Datatable;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types=Fcategory::all();
        return view('backend.facility',compact('types'));
    }

    public function getFacilityAjax(){
        $facilities=Facility::with('fcategory')->orderBy('id','desc')->get();
        $datatables=Datatable::of($facilities)
                    
                    ->addIndexColumn()
                    ->addColumn('action',function($f){
                        return "<button class='btn btn-danger btn-delete' data-id=".$f->id."><i class='fas fa-trash'></i></button>

                <a href='#' class='btn btn-warning btn-edit' data-id=".$f->id."
                data-name='".$f->name."'".
                "data-price='".$f->price."'
                data-type='".$f->fcategory_id."'"

                ."><i class='fas fa-edit'></i></a>



                <a href='#' class='btn btn-info btn-edit' data-id=".$f->id."><i class='fas fa-info-circle'></i></a> ";
                    } );

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:facilities,name,NULL,id,deleted_at,NULL',
            'type_id' => 'required',
            'price'=>'sometimes'         
        ]);  

        $name=$request->name;
        $cost=$request->price;
        $type=$request->type_id;
        Facility::create([
            'name'=>$name,
            'price'=>$cost,
            'fcategory_id'=>$type
        ]);
        return response()->json(['success'=>'Successfully added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show(Facility $facility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function edit(Facility $facility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facility $facility)
    {
        $name=$request->ename;
        $price=$request->eprice;
        $type=$request->etype_id;

        $facility->name=$name;
        $facility->price=$price;
        $facility->fcategory_id=$type;
        $facility->save();
        return response()->json(['success'=>'Successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facility $facility)
    {
        $facility->delete();
        return response()->json(['success'=>'Successfully deleted!']);
    }
}
