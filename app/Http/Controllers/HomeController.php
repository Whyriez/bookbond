<?php

namespace App\Http\Controllers;

use App\Models\BookInterest;
use App\Models\Books;
use App\Models\DetailBookInterest;
use App\Models\WantReadBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $bookInterest = BookInterest::where('userId', $user->id)->first();
        $genres = [];

        if ($bookInterest) {
            $genres = DetailBookInterest::where('bookInterestId', $bookInterest->id)
                ->join('category_book', 'detail_book_interest.categoryId', '=', 'category_book.id')
                ->pluck('category_book.name');
        }

        $books = Books::with('categories')
            ->whereHas('categories', function ($query) use ($genres) {
                $query->whereIn('category_book.name', $genres);
            })
            ->get();

        $wantToReadBookIds = WantReadBook::where('userId', $user->id)->pluck('bookId')->toArray();

        $wantToReadCount = WantReadBook::where('userId', $user->id)->where('isRead', false)->count();
        $communityCount = $user->communities()->count();


        return view('pages.landing.home.index', compact('genres', 'books', 'wantToReadBookIds', 'wantToReadCount', 'communityCount'));
    }

    public function wantToRead()
    {
        $user = Auth::user();

        // Ambil semua relasi dari tabel want_read_book milik user
        $bookIds = WantReadBook::where('userId', $user->id)
            ->pluck('bookId');

        // Ambil data buku lengkapnya
        $books = Books::with('categories')
            ->whereIn('id', $bookIds)
            ->get();

        $wantToReadBookIds = WantReadBook::where('userId', $user->id)->pluck('bookId')->toArray();

        return view('pages.landing.reading-list.index', compact('books', 'wantToReadBookIds'));
    }
}
