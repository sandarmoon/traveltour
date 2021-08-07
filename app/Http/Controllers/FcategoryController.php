<?php

namespace App\Http\Controllers;

use App\Models\Fcategory;
use App\Models\Type;
use Illuminate\Http\Request;
use Datatable;

class FcategoryController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types=Type::whereNull('parent_id')->get();
        return view('backend.fcategory',compact('types'));
    }

    public function getFcategoryAjax(){
        $facilities=Fcategory::with('type')->orderBy('id','desc')->get();
        // dd($facilities);
        $datatables=Datatable::of($facilities)
                    
                    ->addIndexColumn()
                    ->addColumn('action',function($f){
                        return "<button class='btn btn-danger btn-delete' data-id=".$f->id."><i class='fas fa-trash'></i></button>

                <a href='#' class='btn btn-warning btn-edit' data-id=".$f->id."
                data-name='".$f->name."'".
                "data-type='".$f->type_id."'"

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
            'name' => 'required|unique:fcategories',
            'type_id' => 'required',
                    
        ]);  

        $name=$request->name;
        
        $type=$request->type_id;
        Fcategory::create([
            'name'=>$name,
            'type_id'=>$type
        ]);
        return response()->json(['success'=>'Successfully added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show(Fcategory $fcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function edit(Fcategory $fcategory)
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
    public function update(Request $request, Fcategory $fcategory)
    {
        $name=$request->ename;
        $type=$request->etype_id;

        $fcategory->name=$name;

        $fcategory->type_id=$type;
        $fcategory->save();
        return response()->json(['success'=>'Successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fcategory $fcategory)
    {
        $fcategory->delete();
        return response()->json(['success'=>'Successfully deleted!']);
    }
}
