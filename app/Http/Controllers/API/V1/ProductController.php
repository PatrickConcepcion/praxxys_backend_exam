<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function fetch()
    {
        $products = Product::get();

        return response()->json(['products' => $products], 200);
    }
}
