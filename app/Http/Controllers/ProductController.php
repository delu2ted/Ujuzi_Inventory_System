<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // 1. List all products
    public function index()
    {
        $products = Product::query()->orderBy('created_at', 'desc')->paginate(10);
        return view('products.index', compact('products'));
    }

    // 2. Show create form
    public function create()
    {
        return view('products.form');
    }

    private function generateSimpleSKU($category)
{
    return 'Code-' . rand(1000, 9999);
}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|unique:products,code', // ✅ 'nullable' is key here
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
]);

        // Auto-generate if empty
        if (empty($validated['code'])) {
            $validated['code'] = $this->generateSimpleSKU($validated['category']);
        }

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('images', $imageName, 'public');
            $validated['image'] = $imageName;
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created with Code: ' . $validated['code']);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'sometimes|required|unique:products,code,' . $product->id,
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (!empty($validated['code'])) {
            // Keep user input
        } else {
        }

        // ... (Rest of update logic) ...
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete('images/' . $product->image);
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('images', $imageName, 'public');
            $validated['image'] = $imageName;
        }

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Product updated!');
    }
}