<?php

namespace App\Http\Controllers;

use App\Models\ServiceOffer;
use Illuminate\Http\Request;

class ServiceOfferController extends Controller
{
    public function index()
    {
        $data = ServiceOffer::all();
        return view('pages.admin.services.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service-name' => 'required|string|max:255',
        ]);

        try {
            ServiceOffer::create([
                'name' => $request->input('service-name'),
            ]);

            return redirect()->back()->with('success', 'Service Offer created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create Service Offer. Please try again.');
        }
    }

    public function update(Request $request, $id)
    {
         $request->validate([
            'name' => 'required|string|max:255',
        ]);
         try {
             $service = ServiceOffer::findOrFail($id);
        $service->update([
            'name' => $request->input('name'),
        ]);

            return redirect()->back()->with('success', 'Service Offer updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update Service Offer. Please try again.');
        }
    }

    public function destroy($id)
    {
        $service = ServiceOffer::findOrFail($id);
        $service->delete();

        return redirect()->back()->with('success', 'Service Offer deleted successfully.');
    }
}
