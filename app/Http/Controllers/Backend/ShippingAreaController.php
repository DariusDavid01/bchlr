<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShipState;

class ShippingAreaController extends Controller
{
    public function DivisionView(){
        $divisions = ShipDivision::orderBy('id','DESC')->get();
        return view('backend.ship.division.view_division',compact('divisions'));
    }

    public function DivisionStore(Request $request){
        $request->validate([
            'division_name' => 'required',
            
        ],
    [
        'division_name.required' => 'You have to input the division name!',
    ]);

    ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);
    $notification = array('message' => 'Division inserted successfully',
        'alert-type' =>'success');

        return redirect()->back()->with($notification);
    }

    public function DivisionEdit($id){
        $divisions = ShipDivision::findOrFail($id);
        return view('backend.ship.division.edit_division',compact('divisions'));
    }

    public function DivisionUpdate(Request $request, $id){
        ShipDivision::findOrFail($id)->update([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);
    $notification = array('message' => 'Division updated successfully',
        'alert-type' =>'info');

        return redirect()->route('manage-division')->with($notification);
    }

    public function DivisionDelete($id){
        ShipDivision::findOrFail($id)->delete();
        $notification = array('message' => 'Division deleted successfully',
            'alert-type' =>'info');
    
            return redirect()->back()->with($notification);
    }

    //district

    public function DistrictView(){
        $divisions = ShipDivision::orderBy('id','ASC')->get();
        $districts = ShipDistrict::with('division')->orderBy('id','DESC')->get();
        return view('backend.ship.district.view_district',compact('divisions','districts'));
    }

    public function DistrictStore(Request $request){
        $request->validate([
            'division_id' => 'required',
            'district_name' => 'required',
            
        ],
    [
        'division_id.required' => 'You have to input the division!',
        'district_name.required' => 'You have to input the district name!',
    ]);

    ShipDistrict::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);
    $notification = array('message' => 'District inserted successfully',
        'alert-type' =>'success');

        return redirect()->back()->with($notification);
    }

    public function DistrictEdit($id){
        $divisions = ShipDivision::orderBy('id','ASC')->get();
        $districts = ShipDistrict::findOrFail($id);
        return view('backend.ship.district.edit_district',compact('districts','divisions'));
    }

    public function DistrictUpdate(Request $request, $id){
        ShipDistrict::findOrFail($id)->update([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);
    $notification = array('message' => 'District updated successfully',
        'alert-type' =>'info');

        return redirect()->route('manage-district')->with($notification);
    }

    public function DistrictDelete($id){
        ShipDistrict::findOrFail($id)->delete();
        $notification = array('message' => 'District deleted successfully',
            'alert-type' =>'info');
    
            return redirect()->back()->with($notification);
    }

    //ship state

    public function StateView(){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::orderBy('district_name','ASC')->get();
        $state = ShipState::with('division','district')->orderBy('id','DESC')->get();
        return view('backend.ship.state.view_state',compact('division','district','state'));
    }

    public function GetDistrict($division_id){
        $district = ShipDistrict::where('division_id',$division_id)->orderBy('district_name','ASC')->get();
        return json_encode($district);
    }

    public function StateStore(Request $request){
        $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'state_name' => 'required',
            
        ],
    [
        'division_id.required' => 'You have to input the division!',
        'district_id.required' => 'You have to input the district!',
        'state_name.required' => 'You have to input the state!',
    ]);

    ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now(),
        ]);
    $notification = array('message' => 'State inserted successfully',
        'alert-type' =>'success');

        return redirect()->back()->with($notification);
    }

    public function StateEdit($id){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::orderBy('district_name','ASC')->get();
        $state = ShipState::findOrFail($id);
        return view('backend.ship.state.edit_state',compact('division','district','state'));
    }

    public function StateUpdate(Request $request, $id){
        ShipState::findOrFail($id)->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now(),
        ]);
    $notification = array('message' => 'State updated successfully',
        'alert-type' =>'info');

        return redirect()->route('manage-state')->with($notification);
    }

    public function StateDelete($id){
        ShipState::findOrFail($id)->delete();
        $notification = array('message' => 'State deleted successfully',
            'alert-type' =>'info');
    
            return redirect()->back()->with($notification);
    }
}
