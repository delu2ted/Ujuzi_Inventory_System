@extends('layouts.app')
@section('title', 'Product List')
@php $pageTitle = 'Inventory List'; @endphp

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 text-gray-800">All Products</h4>
        <a href="{{ route('products.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Add New Product
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Product Table</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Product Code</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td class="text-center">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50" height="55" class="img-thumbnail">
                                @else
                                    <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                                @endif
                            </td>
                            <td><code>{{ $product->code }}</code></td>
                            <td>{{ $product->name }}</td>
                            <td><span class="badge bg-info text-dark">{{ $product->category }}</span></td>
                            <td>UGX {{ number_format($product->price, 2) }}</td>
                            <td class="text-center">
                                <span class="badge {{ $product->quantity > 0 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $product->quantity }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('products.stock', $product->id) }}" class="btn btn-warning btn-sm" title="Adjust Stock">
                                    <i class="bi bi-arrow-repeat"></i>
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info btn-sm text-white" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No products found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection