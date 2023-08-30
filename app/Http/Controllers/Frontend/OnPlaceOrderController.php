<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OnPlaceOrderController extends Controller
{
    public function index()
    {
        return view('frontend.default.pages.surplace.index');
    }
}
