<?php

namespace App\Http\Controllers;

use App\Upazila;
use App\Division;
use App\District;
use Illuminate\Http\Request;

class UpazilaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $divisions = Division::with('districts.upazilas')->get();
    // $district_lists = Division::with('districts')->get();
      return view('test.upazila_form',compact('divisions'));
      // return $upazila_lists;
    }
    function get_city_list(Request $request){
      // echo $request->country_id;
      $dropdown_to_send = "";
    $districts = District::where('division_id',$request->country_id)->get();

    foreach ($districts as $district) {
      $dropdown_to_send .="<option value='".$district->id."'>".$district->district_name."</option>";
    }
    echo $dropdown_to_send;
    // echo $request->country_id;
    //
    // $cities =  District::where('division_id', $request->country_id)->get();
    // foreach ($cities as $city) {
    //   $dropdown_to_send .="<option value='".$city->id."'>".$city->district_name."</option>";
    //   // echo $city->city_name;
    // }
    // echo $dropdown_to_send;
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
      Upazila::create([
      'division_id'=>$request->division_id,
      'district_id'=>$request->district_id,
      'upazila_name'=>$request->upazila_name
      ]);
      return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Upazila  $upazila
     * @return \Illuminate\Http\Response
     */
    public function show(Upazila $upazila)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Upazila  $upazila
     * @return \Illuminate\Http\Response
     */
    public function edit(Upazila $upazila)
    {
      $data['editData'] = Upazila::find($upazila)->first();
      $divisions = Division::with('districts.upazilas')->get();
      return view('test.upazila_form',compact('divisions'),$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Upazila  $upazila
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Upazila $upazila)
    {
      $upazila->division_id = $request->division_id;
      $upazila->district_id = $request->district_id;
      $upazila->upazila_name = $request->upazila_name;
      $upazila->save();
      return redirect('upazila');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Upazila  $upazila
     * @return \Illuminate\Http\Response
     */
    public function destroy(Upazila $upazila)
    {
      $upazila->delete();
       return back();
    }
}
