<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class LocationController extends Controller
{
    public function toggleStatus(Request $request, $type, $id)
    {
        $model = match($type) {
            'country' => Country::findOrFail($id),
            'state' => State::findOrFail($id),
            'city' => City::findOrFail($id),
            default => abort(404)
        };

        $model->status = !$model->status;
        $model->save();
        
        if($request->ajax()) {
            return response()->json(['success' => true, 'message' => ucfirst($type) . ' status updated successfully']);
        }
        
        return redirect()->back()->with('success', ucfirst($type) . ' status updated successfully.');
    }
} 