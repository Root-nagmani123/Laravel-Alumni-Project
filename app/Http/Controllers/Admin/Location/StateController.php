<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;
use App\Rules\NoHtmlOrScript;

class StateController extends Controller
{
    public function index()
    {
        $states = State::with('country')->get();
        return view('admin.location.state.index', compact('states'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('admin.location.state.create', compact('countries'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', new NoHtmlOrScript()],
            'country_id' => 'required|exists:tbl_countries,id'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create a new state
        State::create([
            'name' => $request->name,
            'country_id' => $request->country_id
        ]);

        return redirect()->route('admin.location.state')
        ->with('success', 'State added successfully.');
    }

    public function edit(State $state)
    {
        $countries = Country::all();
        return view('admin.location.state.edit', compact('state', 'countries'));
    }

    public function update(Request $request, State $state)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', new NoHtmlOrScript()],
            'country_id' => 'required|exists:tbl_countries,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $state->update([
            'name' => $request->name,
            'country_id' => $request->country_id
        ]);

        return redirect()->route('admin.location.state')
        ->with('success', 'State updated successfully.');
    }

    public function destroy(State $state)
    {
        // Check if state has related cities
        if ($state->cities()->count() > 0) {
           return redirect()->route('admin.location.state')
                ->with('error', 'Cannot delete state that has cities. Please delete related cities first.');
        }

        $state->delete();
        return redirect()->route('admin.location.state')
            ->with('success', 'State deleted successfully.');
    }

    /**
     * Get states by country for AJAX request
     */


    public function toggleStatus(State $state)
    {
        $state->status = !$state->status;
        $state->save();
        
        if(request()->ajax()) {
                return response()->json(['success' => true, 'message' => 'State status updated successfully']);
        }
        
        return redirect()->back()->with('success', 'State status updated successfully.');
    }
}
