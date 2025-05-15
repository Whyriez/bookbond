<?php

namespace App\Http\Controllers;

use App\Models\BookCategoriesPartner;
use App\Models\BookInterest;
use App\Models\CategoryBook;
use App\Models\DetailBookInterest;
use App\Models\DetailPartner;
use App\Models\ServiceOffer;
use App\Models\ServiceOfferPartner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.index');
    }

    public function post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credent = $request->only('email', 'password');
        if (Auth::attempt($credent)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('admin');
            } else if ($user->role == 'partner') {
                return redirect()->route('partner.dashboard');
            } else {
                return redirect()->route('home');
            }
        }

        Session::flash('error', 'Email atau Password Salah!');
        return redirect()->route('login');
    }

    public function register()
    {
        $category = CategoryBook::all();
        return view('pages.auth.register', compact('category'));
    }

    public function create(Request $request)
    {
        try {
            // Validasi input dasar
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'genres' => 'nullable', // Tidak validasi sebagai array dulu karena format input berbeda
            ]);

            // Menggunakan transaction untuk memastikan semua operasi DB sukses atau gagal bersama
            DB::beginTransaction();

            try {
                // Simpan user
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'role' => 'user', // default role
                ]);

                // Proses genres jika ada
                if (!empty($validated['genres'])) {
                    // Simpan book interest
                    $bookInterest = BookInterest::create([
                        'userId' => $user->id,
                    ]);

                    // Parse genres jika datang sebagai string
                    $genreIds = [];
                    if (is_array($validated['genres'])) {
                        foreach ($validated['genres'] as $genreValue) {
                            // Cek apakah item adalah string dengan koma
                            if (is_string($genreValue) && strpos($genreValue, ',') !== false) {
                                // Split string berdasarkan koma
                                $individualIds = explode(',', $genreValue);
                                foreach ($individualIds as $id) {
                                    $genreIds[] = trim($id); // Tambahkan ke array setelah trim
                                }
                            } else {
                                $genreIds[] = $genreValue; // Tambahkan langsung jika bukan string dengan koma
                            }
                        }
                    } elseif (is_string($validated['genres']) && strpos($validated['genres'], ',') !== false) {
                        // Jika genres langsung datang sebagai single string dengan koma
                        $genreIds = explode(',', $validated['genres']);
                    } else {
                        // Jika single value
                        $genreIds[] = $validated['genres'];
                    }

                    // Validasi category IDs setelah parsing
                    foreach ($genreIds as $categoryId) {
                        // Validasi bahwa ID kategori ada di database
                        $category = DB::table('category_book')->where('id', $categoryId)->first();
                        if ($category) {
                            DetailBookInterest::create([
                                'bookInterestId' => $bookInterest->id,
                                'categoryId' => $categoryId,
                            ]);
                        } else {
                            // Log jika kategori tidak ditemukan
                            Log::warning("Category ID not found: {$categoryId}");
                        }
                    }
                }

                // Commit transaksi jika semua operasi berhasil
                DB::commit();

                Auth::login($user);
                return redirect()->route('home');
            } catch (\Exception $e) {
                // Rollback transaksi jika terjadi error saat menyimpan data
                DB::rollBack();
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Khusus untuk error validasi
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi. Silakan periksa kembali data Anda.');
        } catch (\Exception $e) {

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi nanti: ' . $e->getMessage());
        }
    }
    // public function create(Request $request)
    // {
    //     dd($request);
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|min:8',
    //         'genres' => 'nullable|array', // Validasi genres sebagai array
    //         'genres.*' => 'integer|exists:category_book,id', // Validasi elemen genre adalah integer dan ada di database
    //     ]);

    //     // Simpan user
    //     $user = User::create([
    //         'name' => $validated['name'],
    //         'email' => $validated['email'],
    //         'password' => Hash::make($validated['password']),
    //         'role' => 'user', // default role
    //     ]);

    //     // Proses genres jika ada
    //     if (!empty($validated['genres'])) {
    //         // Simpan book interest
    //         $bookInterest = BookInterest::create([
    //             'userId' => $user->id,
    //         ]);

    //         // Buat detail interest untuk setiap genre
    //         foreach ($validated['genres'] as $categoryId) {
    //             DetailBookInterest::create([
    //                 'bookInterestId' => $bookInterest->id,
    //                 'categoryId' => $categoryId,
    //             ]);
    //         }
    //     }

    //     // Login dan redirect
    //     Auth::login($user);
    //     return redirect()->route('home');
    // }







    public function registerPartner()
    {
        $categories = CategoryBook::all();
        $services = ServiceOffer::all();

        return view('pages.auth.register-partner', compact('categories', 'services'));
    }

    public function createPartner(Request $request)
    {
        $validated = $request->validate([
            'shop-name' => 'required|string|max:255',
            'shop-email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'shop-phone' => 'required|string|max:20',
            'shop-address' => 'required|string|max:255',
            'shop-city' => 'required|string|max:100',
            'shop-zip' => 'required|string|max:20',
            'shop-website' => 'nullable|url|max:255',
            'shop-description' => 'required|string',
            'categories' => 'nullable|array',
            'categories.*' => 'string',
            'services' => 'nullable|array',
            'services.*' => 'string',
            'shop-hours' => 'required|string',
            'owner-name' => 'required|string|max:255',
            'owner-email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'terms' => 'required|accepted'
        ]);

        // Start database transaction
        DB::beginTransaction();

        try {
            // Create the user account
            $user = User::create([
                'name' => $validated['owner-name'],
                'email' => $validated['shop-email'],
                'password' => Hash::make($validated['password']),
                'role' => 'partner'
            ]);

            $logoPath = null;
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('partner-logos', 'public');
            }

            $partner = DetailPartner::create([
                'userId' => $user->id,
                'shop_name' => $validated['shop-name'],
                'personal_email' => $validated['owner-email'],
                'phone_number' => $validated['shop-phone'],
                'address' => $validated['shop-address'],
                'city' => $validated['shop-city'],
                'zip' => $validated['shop-zip'],
                'website' => $validated['shop-website'] ?? null,
                'short_description' => $validated['shop-description'],
                'bussiness_hours' => $validated['shop-hours'],
                'logo' => $logoPath
            ]);

            if (!empty($validated['categories'])) {
                foreach ($validated['categories'] as $category) {
                    BookCategoriesPartner::create([
                        'partnerId' => $user->id,
                        'name' => $category
                    ]);
                }
            }

            if (!empty($validated['services'])) {
                foreach ($validated['services'] as $service) {
                    ServiceOfferPartner::create([
                        'partnerId' => $user->id,
                        'name' => $service
                    ]);
                }
            }

            DB::commit();

            Auth::login($user);
            return redirect()->route('partner.dashboard')->with('success', 'Partner registration completed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            if (isset($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }
            return back()->withInput()->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        Auth::logout();

        return redirect()->route('login');
    }
}
