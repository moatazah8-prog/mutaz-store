<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');

        $products = Product::query()
            ->when($category, function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhere('category', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        return view('products.index', compact('products', 'search', 'category'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }
}
