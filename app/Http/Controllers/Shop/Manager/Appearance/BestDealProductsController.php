<?php

namespace App\Http\Controllers\Shop\Manager\Appearance;

use App\Http\Controllers\Controller;
use App\Models\Product;

class BestDealProductsController extends Controller
{
    # construct
    public function __construct()
    {
        $this->middleware(['permission:homepage'])->only('index');
    }

    # best deal products
    public function index()
    {
        $products = Product::isPublished()->get();
        return view('shop.vendor.pages.appearance.homepage.bestDealProducts', compact('products'));
    }
}
