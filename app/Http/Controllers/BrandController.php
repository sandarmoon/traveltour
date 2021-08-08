<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Datatable;
use DB;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.brand');
    }


    public function getBrand(Request $request){

        DB::statement(DB::raw('set @rownum=0'));
        $brands = Brand::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'name',
            'created_at',
            'updated_at']);
        
        $datatables = Datatable::of($brands)
            ->addColumn('action',function($brand){
                return "<button class='btn btn-danger btn-delete' data-id=".$brand->id.">Delete</button>";
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
            'name' => 'required|unique:brands|max:255',
            
        ]);

        
        // $data=Category::all();
        Brand::create([
            'name'=>$request->name
        ]);
        
        return response()->json(['success'=>'Successfully added!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        
        $brand->name=$request->name;
        $brand->save();
        return response()->json(['success'=>'Successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json(['success'=>'Successfully updated!']);
    }
}
