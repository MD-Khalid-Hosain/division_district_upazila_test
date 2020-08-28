<?php

namespace App\Http\Controllers;

use App\District;
use App\Division;
use App\Upazila;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $division_lists = Division::with('districts.upazilas')->get();
        return view('test.district_form',compact('division_lists'));
    }

    /*========Api function========*/
    function getData(){
        $division_lists = Division::with('districts.upazilas')->get();
        return $division_lists;
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
      District::create([
      'district_name'=>$request->district_name,
      'division_id'=>$request->division_id
      ]);
      return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
      $data['editData'] = District::find($district)->first();
      $division_lists = Division::with('districts.upazilas')->get();
      return view('test.district_form',compact('division_lists'),$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
      $district->division_id = $request->division_id;
      $district->district_name = $request->district_name;
      $district->save();
      return redirect('district');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
      $district->delete();
       return back();
    }
}
