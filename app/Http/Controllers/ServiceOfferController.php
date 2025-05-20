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
            'service-name' => 'required|string|max:255|unique:service_offer,name',
        ], [
            'service-name.required' => 'Nama layanan wajib diisi.',
            'service-name.unique' => 'Nama layanan sudah terdaftar.',
        ]);

        try {
            ServiceOffer::create([
                'name' => $request->input('service-name'),
            ]);

            return redirect()->back()->with('success', 'Penawaran Layanan berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat Service Offer. Silakan coba lagi.');
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

            return redirect()->back()->with('success', 'Penawaran Layanan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui Penawaran Layanan. Silakan coba lagi.');
        }
    }

    public function destroy($id)
    {
        $service = ServiceOffer::findOrFail($id);
        $service->delete();

        return redirect()->back()->with('success', 'Penawaran Layanan berhasil dihapus.');
    }
}
