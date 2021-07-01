<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Datatable;
use DB;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.city');
    }

    public function getCityAjax(Request $request){

        // $cities=City::all();
        // return Datatable::of($cities)->addIndexColumn()->toJSON();
        DB::statement(DB::raw('set @rownum=0'));
        $cities = City::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'name',
            'created_at',
            'updated_at']);



        
        $datatables = Datatable::of($cities)
            ->addColumn('action',function($city){
                return "<button class='btn btn-danger btn-delete' data-id=".$city->id.">Delete</button>";
            } )
            ;

        if ($keyword = $request->get('search')['value']) {
             $datatables->filterColumn('rownum', function($q,$keyword){
                $q->whereRaw("@rownum +1  like ?", ["%{$keyword}%"]);
             });
            
        }

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
            'name'=>$request->name
        ]);
        
        return response()->json(['success'=>'Successfully added!']);
        
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
        $city=City::find($id);
        $city->name=$request->name;
        $city->save();
        return response()->json(['success'=>'Successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city=City::find($id);
        $city->delete();
         return response()->json(['success'=>'Success!']);
    }
}
