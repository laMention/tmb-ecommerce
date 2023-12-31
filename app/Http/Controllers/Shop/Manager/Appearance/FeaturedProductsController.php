<?php

namespace App\Http\Controllers\Shop\Manager\Appearance;

use App\Http\Controllers\Controller;
use App\Models\Product;

class FeaturedProductsController extends Controller
{
    # construct
    public function __construct()
    {
        $this->middleware(['permission:homepage'])->only('index');
    }

    # featured products
    public function index()
    {
        $products = Product::isPublished()->get();
        return view('shop.vendor.pages.appearance.homepage.featuredProducts', compact('products'));
    }
}
