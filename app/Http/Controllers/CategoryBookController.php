<?php

namespace App\Http\Controllers;

use App\Models\CategoryBook;
use Illuminate\Http\Request;

class CategoryBookController extends Controller
{
    public function index(){
        $data = CategoryBook::all();
        return view('pages.admin.category.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category-name' => 'required|string|max:255',
        ]);

        CategoryBook::create([
            'name' => $request->input('category-name'),
        ]);

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = CategoryBook::findOrFail($id);
        $category->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = CategoryBook::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
