<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\productStoreRequest;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function store(ProductStoreRequest $request)
    {
        $product = auth()->user()->createProduct($request->all());
        return ProductResource::make($product);

    }
}
