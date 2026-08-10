@extends('layouts.app')

@section('title','Dashboard')
@section('content')

<h1>Dashboard</h1>
<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card text-white h-100" style="background-color: var(--primary-bg);">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <h5 class="card-title">Total Products</h5>
                <p class="card-text display-4">{{ $totalProducts }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card text-white h-100" style="background-color: var(--dark-bg);">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <h5 class="card-title">Total Users</h5>
                <p class="card-text display-4">{{ $totalUsers }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card text-white bg-success h-100">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <h5 class="card-title">Total Stock</h5>
                <p class="card-text display-4">{{ $totalStock }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card text-white bg-warning h-100">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <h5 class="card-title">Low Stock Products</h5>
                <p class="card-text display-4">{{ $lowStockProducts }}</p>
            </div>
        </div>
    </div>
</div>

@endsection