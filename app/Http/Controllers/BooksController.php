<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\CategoryBook;
use App\Models\DetailCategory;
use App\Models\DetailPartner;
use App\Models\WantReadBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    public function index()
    {
        $category = CategoryBook::all();
        $books = Books::with('categories')->get();
        return view('pages.admin.books.index', compact('books', 'category'));
    }

    public function edit($id)
    {
        $book = Books::with('categories')->findOrFail($id);
        return response()->json($book);
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'categoryId'      => 'required|array',
            'name'            => 'required|string|max:255',
            'author'          => 'required|string|max:255',
            'publisher'       => 'required|string|max:255',
            'publication_date' => 'required|date',
            'language'        => 'required|string|max:255',
            'print_length'        => 'required|string|max:255',
            'ISBN-10'         => 'required|string|max:20',
            'ISBN-13'         => 'required|string|max:20',
            'description'     => 'required|string',
            'image'           => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload gambar
        $imagePath = $request->file('image')->store('books', 'public');

        // Simpan data ke database
        $book = Books::create([
            'name'            => $validated['name'],
            'author'          => $validated['author'],
            'publisher'       => $validated['publisher'],
            'publication_date' => $validated['publication_date'],
            'language'        => $validated['language'],
            'print_length'        => $validated['print_length'],
            'ISBN-10'         => $validated['ISBN-10'],
            'ISBN-13'         => $validated['ISBN-13'],
            'description'     => $validated['description'],
            'image'           => $imagePath,
        ]);

        foreach ($validated['categoryId'] as $categoryId) {
            DetailCategory::create([
                'bookId'     => $book->id,
                'categoryId' => $categoryId,
            ]);
        }

        return redirect()->route('admin.books.index')->with('success', 'Book created successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'categoryId'      => 'required|array',
            'name'            => 'required|string|max:255',
            'author'          => 'required|string|max:255',
            'publisher'       => 'required|string|max:255',
            'publication_date' => 'required|date',
            'language'        => 'required|string|max:255',
            'print_length'    => 'required|string|max:255',
            'ISBN-10'         => 'required|string|max:20',
            'ISBN-13'         => 'required|string|max:20',
            'description'     => 'required|string',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $book = Books::findOrFail($id);

        // Update data buku
        $book->update([
            'name'            => $validated['name'],
            'author'          => $validated['author'],
            'publisher'       => $validated['publisher'],
            'publication_date' => $validated['publication_date'],
            'language'        => $validated['language'],
            'print_length'    => $validated['print_length'],
            'ISBN-10'         => $validated['ISBN-10'],
            'ISBN-13'         => $validated['ISBN-13'],
            'description'     => $validated['description'],
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
            $book->image = $imagePath;
            $book->save();
        }

        // Sync kategori
        DetailCategory::where('bookId', $book->id)->delete(); // hapus kategori lama
        foreach ($validated['categoryId'] as $categoryId) {
            DetailCategory::create([
                'bookId'     => $book->id,
                'categoryId' => $categoryId,
            ]);
        }

        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully!');
    }

    public function showDetail($id)
    {
        $user = Auth::user();
        $book = Books::with('categories')->findOrFail($id);

        $targetCategoryIds = $book->categories->pluck('id')->toArray();

        $otherBooks = Books::with('categories')
            ->where('id', '!=', $book->id)
            ->get();

        $books = $otherBooks->map(function ($otherBook) use ($targetCategoryIds) {
            $sameCategoriesCount = $otherBook->categories
                ->pluck('id')
                ->intersect($targetCategoryIds)
                ->count();

            $otherBook->similarity = $sameCategoriesCount;
            return $otherBook;
        })->sortByDesc('similarity')
            ->filter(fn($b) => $b->similarity > 0)
            ->take(5);

        $targetCategoryNames = $book->categories->pluck('name')->toArray();

        $bookStore = DetailPartner::with(['bookCategories', 'serviceOffers'])
            ->whereHas('bookCategories', function ($query) use ($targetCategoryNames) {
                $query->whereIn('name', $targetCategoryNames);
            })
            ->get();

        $wantToReadBookIds = WantReadBook::where('userId', $user->id)->pluck('bookId')->toArray();


        return view('pages.landing.book.detail.index', compact('book', 'books', 'bookStore', 'wantToReadBookIds'));
    }


    public function destroy($id)
    {
        // Cari buku berdasarkan ID
        $book = Books::findOrFail($id);

        // Hapus gambar jika ada
        if ($book->image && Storage::exists('public/' . $book->image)) {
            Storage::delete('public/' . $book->image);
        }

        // Hapus relasi kategori (jika menggunakan many-to-many)
        $book->categories()->detach();

        // Hapus buku dari database
        $book->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus.');
    }

    public function toggleWantToRead(Request $request, $bookId)
    {

        // Untuk user login
        $userId = Auth::user()->id;

        // Cari apakah sudah ada
        $existing = WantReadBook::where('bookId', $bookId)
            ->where('userId', $userId)
            ->first();

        if ($existing) {
            // Jika sudah ada, hapus
            $existing->delete();
            return response()->json(['status' => 'removed']);
        } else {
            // Tambahkan
            WantReadBook::create([
                'bookId' => $bookId,
                'userId' => $userId,
                'isRead' => false,
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}
