<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\CategoryBook;
use App\Models\ServiceOffer;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function index()
    {
        $totalBooks = Books::count();
        $totalCategories = CategoryBook::count();
        $totalServices = ServiceOffer::count();

        return view('pages.admin.home.index', compact('totalBooks', 'totalCategories', 'totalServices'));
    }
}
