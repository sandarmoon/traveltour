<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Car;
use Datatable;

class PickPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities=City::whereNull('parent_id')->get();
        return view('backend.pickup',compact('cities'));
    }
    public function getPickupAjax(){

         $pickups=City::whereNotNull('parent_id')->orderBy('id','desc')->get();
         

         $datatables = Datatable::of($pickups)->with('parent')
            ->addIndexColumn()
            ->addColumn('action',function($type){
                return "<button class='btn btn-danger btn-delete' data-id=".$type->id.">Delete</button>
                        <button class='btn btn-warning btn-Edit' data-id=".$type->id. 
                        " data-name=".$type->name." data-parent=".$type->parent_id.">Edit</button>";
            } )
            ->addColumn('city',function($type){
                return $type->parent->name;
            } )
            ;

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
            'name' => 'required|unique:cities|max:255',
            
        ]);

        
        // $data=Category::all();
        City::create([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id
        ]);
        
        return back()->with('success','New Pickup Location added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pickup=City::find($id);
        $pickup->name=$request->name;
        $pickup->parent_id=$request->parent_id;
        $pickup->save();
         return back()->with('success',' Location updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place=City::find($id);
        $place->delete();
        return response()->json(['success'=>'Successfully deleted!']);
    }

    public function pickupRoute(Request $request){
        $data=$request->states;
        $car=Car::find($request->carid);
        $car->pickuppivot()->attach($data);
        return back()->with('success',' Location added successfully');
    }
}
