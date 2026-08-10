<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->orderBy('created_at', 'desc')->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.form');
    }

    // ✅ Was missing — needed by route('products.edit')
    public function edit(Product $product)
    {
        return view('products.form', compact('product'));
    }

    private function redirectToProducts($message = null)
    {
        if (app('router')->has('products.index')) {
            return redirect()->route('products.index')->with('success', $message);
        }

        return redirect('/products')->with('success', $message);
    }

    private function generateSimpleSKU($category)
    {
        // Retry until we get a code that isn't already taken
        do {
            $code = 'Code-' . rand(1000, 9999);
        } while (Product::where('code', $code)->exists());

        return $code;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|unique:products,code',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (empty($validated['code'])) {
            $validated['code'] = $this->generateSimpleSKU($validated['category']);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validated['image'] = $path;
        }

        Product::create($validated);

        return $this->redirectToProducts('Product created with Code: ' . $validated['code']);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|unique:products,code,' . $product->id,
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (empty($validated['code'])) {
            $validated['code'] = $this->generateSimpleSKU($validated['category']);
        }

        $product->update($validated);
        return $this->redirectToProducts('Product updated!');
    }

    // ✅ Was missing — needed by route('products.destroy')
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete('images/' . $product->image);
        }
        $product->delete();

        return $this->redirectToProducts('Product deleted!');
    }

    // ✅ Was missing — needed by route('products.stock')
    public function stockAdjust(Product $product)
    {
        return view('products.stock', compact('product'));
    }

    // ✅ Was missing — needed by route('products.stock-process')
    public function processStock(Request $request, Product $product)
    {
        $validated = $request->validate([
            'type' => 'required|in:in,out',
            'amount' => 'required|integer|min:1',
        ]);

        if ($validated['type'] === 'in') {
            $product->quantity += $validated['amount'];
        } else {
            if ($validated['amount'] > $product->quantity) {
                return back()->withErrors(['amount' => 'Cannot remove more than current stock.']);
            }
            $product->quantity -= $validated['amount'];
        }

        $product->save();

        return $this->redirectToProducts('Stock updated!');
    }
}