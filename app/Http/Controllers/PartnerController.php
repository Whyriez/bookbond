<?php

namespace App\Http\Controllers;

use App\Models\CategoryBook;
use App\Models\DetailPartner;
use App\Models\PartnerVisits;
use App\Models\ServiceOffer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    public function index()
    {
        $partnerId = Auth::user()->id;

        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfYear = Carbon::now()->startOfYear();

        $totalToday = PartnerVisits::where('partner_id', $partnerId)
            ->whereDate('visited_at', $today)
            ->count();

        $totalMonth = PartnerVisits::where('partner_id', $partnerId)
            ->where('visited_at', '>=', $startOfMonth)
            ->count();

        $totalYear = PartnerVisits::where('partner_id', $partnerId)
            ->where('visited_at', '>=', $startOfYear)
            ->count();

        $totalAll = PartnerVisits::where('partner_id', $partnerId)->count();

        return view('pages.partner.index', compact('totalToday', 'totalMonth', 'totalYear', 'totalAll'));
    }

    public function bookShop()
    {
        $partner = DetailPartner::where('userId', Auth::user()->id)->first();
        $user = User::where('id', Auth::user()->id)->first();
        return view('pages.partner.bookshop', compact('partner', 'user'));
    }

    public function updateBookshop(Request $request)
    {
        $validated = $request->validate([
            'shop-name' => 'required|string|max:255',
            'shop-email' => 'required|email|max:255',
            'shop-phone' => 'required|string|max:20',
            'shop-address' => 'required|string|max:255',
            'shop-city' => 'required|string|max:100',
            'shop-zip' => 'required|string|max:20',
        ]);

        $partner = DetailPartner::where('userId', Auth::user()->id)->first();

        if (!$partner) {
            return back()->with('error', 'Partner data not found.');
        }

        $partner->update([
            'shop_name' => $validated['shop-name'],
            'personal_email' => $validated['shop-email'],
            'phone_number' => $validated['shop-phone'],
            'address' => $validated['shop-address'],
            'city' => $validated['shop-city'],
            'zip' => $validated['shop-zip'],
        ]);

        return redirect()->back()->with('success', 'Bookshop details updated successfully.');
    }


    public function shopDetails()
    {
        $categories = CategoryBook::all();
        $services = ServiceOffer::all();
        $detail = DetailPartner::where('userId', Auth::user()->id)->first();
        $user = User::where('id', Auth::user()->id)->first();

        $selectedCategories = $detail->bookCategories->pluck('name')->toArray();
        $selectedServices = $detail->serviceOffers->pluck('name')->toArray();

        return view('pages.partner.shop-details', compact('categories', 'services', 'detail', 'selectedCategories', 'selectedServices', 'user'));
    }

    public function updateShopDetails(Request $request)
    {
        $request->validate([
            'owner-name' => 'required|string|max:255',
            'owner-email' => 'required|email',
            'shop-website' => 'nullable|url',
            'shop-description' => 'required|string',
            'shop-hours' => 'required|string',
            'logo' => 'nullable|image|max:2048',
            'categories' => 'nullable|array',
            'services' => 'nullable|array',
        ]);

        $partner = DetailPartner::updateOrCreate(
            ['userId' => Auth::id()],
            [
                'personal_email' => $request->input('owner-email'),
                'website' => $request->input('shop-website'),
                'short_description' => $request->input('shop-description'),
                'bussiness_hours' => $request->input('shop-hours'),
            ]
        );

        // Upload logo jika ada
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('partner-logos', 'public');
            $partner->logo = $logo;
            $partner->save();
        }

        // Simpan kategori
        $partner->bookCategories()->delete();
        if ($request->filled('categories')) {
            foreach ($request->input('categories') as $categoryName) {
                $partner->bookCategories()->create([
                    'name' => $categoryName
                ]);
            }
        }

        $partner->serviceOffers()->delete();
        if ($request->filled('services')) {
            foreach ($request->input('services') as $serviceName) {
                $partner->serviceOffers()->create([
                    'name' => $serviceName
                ]);
            }
        }

        return redirect()->back()->with('success', 'Shop details updated successfully.');
    }

    public function track(DetailPartner $partner)
    {
        // Simpan log kunjungan
        PartnerVisits::create([
            'partner_id' => $partner->userId,
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);

        return redirect()->away($partner->website);
    }
}
