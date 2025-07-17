<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;
use Illuminate\Support\Facades\Validator;
use App\Models\Country;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with(['state', 'state.country'])->get();
        return view('admin.location.city.index', compact('cities'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('admin.location.city.create', compact('countries'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'state_id' => 'required|exists:tbl_states,id'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create a new city
        City::create([
            'name' => $request->name,
            'state_id' => $request->state_id
        ]);

        return redirect('/location/city')
            ->with('success', 'City added successfully.');
    }

    public function edit(City $city)
    {
        $countries = Country::all();
        $states = State::with('country')->get();
        return view('admin.location.city.edit', compact('city', 'states', 'countries'));
    }

    public function update(Request $request, City $city)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'state_id' => 'required|exists:tbl_states,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $city->update([
            'name' => $request->name,
            'state_id' => $request->state_id
        ]);

        return redirect()->route('admin.location.city')
            ->with('success', 'City updated successfully.');
    }

    public function destroy(City $city)
    {
        $city->delete();
        return redirect('/location/city')
            ->with('success', 'City deleted successfully.');
    }

    public function getStatesByCountry(Request $request)
    {
        $states = State::where('country_id', $request->country_id)
                       ->select('id', 'name')
                       ->get();
    
        return response()->json($states);
    }

    public function toggleStatus(City $city)
    {
        $city->status = !$city->status;
        $city->save();
        
        if(request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'City status updated successfully']);
        }
        
        return redirect()->back()->with('success', 'City status updated successfully.');
    }

    
}
