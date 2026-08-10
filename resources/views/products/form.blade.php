@extends('layouts.app')
@section('title', isset($product) ? 'Edit Product' : 'Add Product')
@section('page-title', isset($product) ? 'Edit Product' : 'Add New Product')

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ isset($product) ? 'Edit' : 'Create' }} Product</h6>
        </div>
        <div class="card-body">
            <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($product)) @method('PUT') @endif

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Code</label>
                        <input type="text" name="code" class="form-control" value="{{ old('code', $product->code ?? '') }}" {{ isset($product) ? 'readonly' : '' }}>
                        <div class="form-text">Auto-generates if left blank.</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Price (UGX)</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Initial Stock</label>
                        <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity ?? 0) }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select" required>
                            <option value="">Select Category</option>
                            <option value="Electronics" {{ (old('category', $product->category ?? '') == 'Electronics') ? 'selected' : '' }}>Electronics</option>
                                                        <option value="Clothing" {{ (old('category', $product->category ?? '') == 'Clothing') ? 'selected' : '' }}>Clothing</option>
                            <option value="Books" {{ (old('category', $product->category ?? '') == 'Books') ? 'selected' : '' }}>Books</option>
                            <option value="Home" {{ (old('category', $product->category ?? '') == 'Home') ? 'selected' : '' }}>Home & Kitchen</option>
                            <option value="Furniture" {{ (old('category', $product->category ?? '') == 'Furniture') ? 'selected' : '' }}>Furniture</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Image</label>
                    @if(isset($product) && $product->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/images/' . $product->image) }}" alt="Current" width="100" height="100" class="rounded border">
                            <div class="form-text">Current Image</div>
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <div class="form-text">Allowed: JPG, PNG, GIF. Max 2MB.</div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i> {{ isset($product) ? 'Update Product' : 'Create Product' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection