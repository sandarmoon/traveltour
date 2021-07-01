<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use DB;
use Datatable;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.type');
    }

    public function getChildType(Request $request){
         DB::statement(DB::raw('set @rownum=0'));
        $types = Type::with('parent')->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'name',
            'parent_id',
            'created_at',
            'updated_at'])->whereNotNull('parent_id');
         $datatables = Datatable::of($types)->with('parent')

            ->addColumn('action',function($type){
                return "<button class='btn btn-danger btn-delete' data-id=".$type->id.">Delete</button>";
            } )
            ->addColumn('category',function($type){
                return $type->parent->name;
            } )
            ;

        if ($keyword = $request->get('search')['value']) {
             $datatables->filterColumn('rownum', function($q,$keyword){
                $q->whereRaw("@rownum +1  like ?", ["%{$keyword}%"]);
             });
             $datatables->filterColumn('category', function($q,$keyword){
                $q->whereRaw("types.name like ?", ["%{$keyword}%"]);
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
        // dd($request);
        $request->validate([
            'name' => 'required|unique:types|max:255',
            
        ]);

        
        // $data=Category::all();
        Type::create([
            'name'=>$request->name,
            'parent_id'=>$request->id
        ]);
        
        return response()->json(['success'=>'Successfully added!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $type->name=$request->name;
        $type->save();
        return response()->json(['success'=>'Successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        //
    }
}
