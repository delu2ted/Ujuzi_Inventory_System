@extends('layouts.app')
@section('title', 'Adjust Stock')
@section('page-title', 'Stock Adjustment: ' . $product->name)

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-box-seam me-2"></i>Adjust Stock</h5>
                </div>
                <div class="card-body text-center">
                    
                    <div class="mb-4">
                        <p class="text-muted mb-1">Current Stock Level</p>
                        <h2 class="display-4 fw-bold {{ $product->quantity > 0 ? 'text-success' : 'text-danger' }}">
                            {{ $product->quantity }} <span class="fs-6 text-muted">units</span>
                        </h2>
                    </div>

                    <form action="{{ route('products.stock-process', $product->id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3 text-start">
                            <label for="type" class="form-label fw-bold">Action Type</label>
                            <select name="type" id="type" class="form-select" required onchange="updateLabel()">
                                <option value="in" selected>🟢 Stock IN (Add to Inventory)</option>
                                <option value="out">🔴 Stock OUT (Remove from Inventory)</option>
                            </select>
                        </div>

                        <div class="mb-4 text-start">
                            <label for="amount" class="form-label fw-bold">Quantity to Adjust</label>
                            <input type="number" name="amount" id="amount" class="form-control form-control-lg" min="1" required placeholder="Enter quantity">
                            <div class="form-text" id="stockHint">Enter the number of units.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-check-circle me-2"></i>Confirm Adjustment
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Simple script to update hint text based on selection
    function updateLabel() {
        const type = document.getElementById('type').value;
        const hint = document.getElementById('stockHint');
        if (type === 'out') {
            hint.textContent = "Warning: You cannot remove more than the current stock ({{ $product->quantity }}).";
            hint.classList.add('text-danger');
        } else {
            hint.textContent = "Enter the number of units to add.";
            hint.classList.remove('text-danger');
        }
    }
</script>
@endsection