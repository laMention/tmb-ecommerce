<?php

namespace App\Http\Controllers\Shop\Manager\Rewards;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    # construct
    public function __construct()
    {
        $this->middleware(['permission:wallet_configurations'])->only('configurations');
    }

    # rewards configuration
    public function configurations()
    {
        return view('shop.vendor.pages.rewards.walletConfigurations');
    }
}
