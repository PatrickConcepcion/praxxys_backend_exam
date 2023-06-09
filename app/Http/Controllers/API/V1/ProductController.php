<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validation\FirstValidationRequest;
use App\Http\Requests\Validation\SecondValidationRequest;
use App\Http\Requests\Validation\ThirdValidationRequest;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function fetch()
    {
        $products = Product::get();

        return response()->json(['products' => $products], 200);
    }

    public function store(Request $request) 
    {
        $date_and_time = Carbon::parse($request->date_and_time)->format('Y-m-d H:i:s');

        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'date_and_time' => $date_and_time
        ]);

        return response(['Success' => 'Product has been saved'], 200);
    }

    public function edit(Product $product) 
    {
        $date_and_time = Carbon::parse($product->date_and_time)->format('Y-m-d\TH:i');

        $product->makeHidden(['date_and_time']);
        
        return response()->json(['product' => $product, 'date_and_time' => $date_and_time], 200);
    }

    public function update(Request $request, Product $product) {
        $date_and_time = Carbon::parse($request->date_and_time)->format('Y-m-d H:i:s');

        $product->update([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'date_and_time' => $date_and_time
        ]);

        return response(['Success' => 'Product has successfully been updated'], 200);
    }

    public function destroy(Product $product) 
    {
        $product->delete();

        return response(['Success' => 'Product has been deleted'], 200);
    }

    public function validateFirst(FirstValidationRequest $request) 
    {
        return response(['Success' => 'Validation Successful'], 200);
    }

    public function validateSecond(SecondValidationRequest $request)
    {
        return response(['Success' => 'Validation Successful'], 200);
    }

    public function validateThird(ThirdValidationRequest $request)
    {
        return response(['Success' => 'Validation Successful'], 200);
    }
}
