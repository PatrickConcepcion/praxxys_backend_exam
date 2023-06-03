@extends('layouts.app')

@section('content')
    <edit-product :product_id="{{ $product->id }}" />
@endsection
