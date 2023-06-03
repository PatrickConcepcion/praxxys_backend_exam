@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center fw-bold">Dashboard</h3>
    <div class="row mx-auto">
        <div class="col-4 mx-auto border rounded m-2 p-2">
            <h4 class="text-center">Number of Users</h4>
            <p class="fw-bold text-center">{{ $users->count() }}</p>
        </div>
        <div class="col-4 mx-auto border rounded m-2 p-2">
            <h4 class="text-center">Total Number Products</h4>
            <p class="fw-bold text-center">{{ $products->count() }}</p>
        </div>
    </div>
</div>
@endsection
