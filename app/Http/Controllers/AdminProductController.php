<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input("search");
        $products = Product::when($search, function ($query) use ($search) {
            $query->where("name", "like", "%{$search}%")->orWhere("category", "like", "%{$search}%");
        })->latest()->get();
        return view("admin.products.index", compact("products"));
    }
    public function addStock(Request $request, $id)
    {
        $request->validate(["quantity" => "required|integer|min:1"]);
        $product = Product::findOrFail($id);
        $product->increment("stock", $request->quantity);
        return back()->with("success", "تمت إضافة المخزون بنجاح");
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'category' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:10',
            'stock' => 'required|integer|min:0',
            'featured' => 'nullable|boolean',
        ]);

        $data['featured'] = $request->boolean('featured');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect('/admin/products')
            ->with('success', 'تمت إضافة المنتج بنجاح');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'category' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:10',
            'stock' => 'required|integer|min:0',
            'featured' => 'nullable|boolean',
        ]);

        $data['featured'] = $request->boolean('featured');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect('/admin/products')
            ->with('success', 'تم تعديل المنتج بنجاح');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect('/admin/products')
            ->with('success', 'تم حذف المنتج بنجاح');
    }
}
