<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;
use App\Rules\NoHtmlOrScript;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('admin.location.country.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.location.country.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:tbl_countries', new NoHtmlOrScript()],
            'sortname' => ['required', 'string', 'max:3', 'unique:tbl_countries', new NoHtmlOrScript()],
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create a new country
        Country::create([
            'name' => $request->name,
            'sortname' => strtoupper($request->sortname),
        ]);

        return redirect()->route('admin.location.country')
            ->with('success', 'Country added successfully.');
    }

    public function edit(Country $country)
    {
        return view('admin.location.country.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:tbl_countries,name,' . $country->id, new NoHtmlOrScript()],
            'sortname' => ['required', 'string', 'max:3', 'unique:tbl_countries,sortname,' . $country->id, new NoHtmlOrScript()],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $country->update([
            'name' => $request->name,
            'sortname' => strtoupper($request->sortname),
        ]);

        return redirect()->route('admin.location.country')
            ->with('success', 'Country updated successfully.');
    }

    public function destroy(Country $country)
    {
        // Check if country has related states
        if ($country->states()->count() > 0) {
            return redirect()->route('admin.location.country')
                ->with('error', 'Cannot delete country that has states. Please delete related states first.');
        }

        $country->delete();
        return redirect()->route('admin.location.country')
            ->with('success', 'Country deleted successfully.');
    }

    public function toggleStatus(Country $country)
    {
        $country->status = !$country->status;
        $country->save();
        
        if(request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Country status updated successfully']);
        }
        
        return redirect()->back()->with('success', 'Country status updated successfully.');
    }
}
