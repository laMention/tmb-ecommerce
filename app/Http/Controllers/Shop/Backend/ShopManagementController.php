<?php

namespace App\Http\Controllers\Shop\Backend;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DB;
use Carbon\Carbon;

class ShopManagementController extends Controller
{
    # construct
    public function __construct()
    {
        $this->middleware(['permission:shops'])->only(['index','updateShopStatus','updateShopPublishStatus']);
        $this->middleware(['permission:add_shop'])->only(['create', 'store']);
        $this->middleware(['permission:edit_shop'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_shop'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // echo "string";

        $searchKey = null;
        $is_published = null;
        $is_approved = null;

        $shops = Shop::where('etat',1)->latest();

        if ($request->search != null) {
            $shops = $shops->where('name', 'like', '%' . $request->search . '%');
            $searchKey = $request->search;
        }

        if ($request->is_published != null) {
            $shops = $shops->where('is_published', $request->is_published);
            $is_published    = $request->is_published;
        }

        if ($request->is_approved != null) {
            $shops = $shops->where('is_approved', $request->is_approved);
            $is_approved    = $request->is_approved;
        }

        $shops = $shops->paginate(paginationNumber());

        return view('shop.backend.pages.index', compact('shops', 'searchKey', 'is_published', 'is_approved'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::oldest()->where('name','Manager')->limit(1)->get();

        // echo "<pre>";print_r($roles[0]->name);die;

        return view('shop.backend.pages.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo "<pre>";print_r($request->all());die;

        $shop    =  new Shop;
        $shop->shop_name = $request->shop_name;
        $shop->slug = strtolower(Str::slug($request->shop_name, '-')) ;
        $shop->shop_address = $request->shop_address;
        $shop->current_balance = 0;
        $shop->is_cash_payout = 1;
        $shop->admin_commission_percentage = $request->admin_commission_percentage;
        $shop->shop_logo = $request->image;
        $shop->is_verified_by_admin = auth()->user()->id;
        $shop->is_published = 0;
        $shop->is_approved = 1;
        $shop->is_bank_payout = 1;
        $shop->min_order_amount = 0;
        $shop->user_id = auth()->user()->id;

        $shop->save();

        if (!empty($request->name)) {
            $user = new User;

            $user->name = $request->name;
            $user->email = $request->email_address;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->shop_id = $shop->id;
            $user->role_id    = $request->role_id;
            $user->user_type = $request->user_type;

            $user->save();

            $user->assignRole(Role::findOrFail($request->role_id)->name);

            $shop->user_id = $user->id;

            $shop->save();

        }

        flash(localize('Shop has been inserted successfully'))->success();
        return redirect()->route('admin.shops.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shop = Shop::where('id',$id)->first();


        return view('shop.backend.pages.edit',compact('shop'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $shop                             = Shop::where('id',$request->shop_id)->first();
        $oldShop                          = clone $shop;
        if ($shop->id != $request->shop_id) {
            abort(403);
        }

        $shop->shop_name                   = $request->shop_name;
        $shop->slug                        = strtolower(Str::slug($request->shop_name, '-')) ;
        $shop->shop_address                = $request->shop_address;
        $shop->admin_commission_percentage = $request->admin_commission_percentage;
        $shop->shop_logo                   = $request->image;
        $shop->is_verified_by_admin        = auth()->user()->id;
        

        $shop->save();


        flash(localize('Shop has been updated successfully'))->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop             = Shop::where('id',$id)->first();

        $shop->etat = 0;
        $shop->is_published = 0;
        $shop->deleted_at = Carbon::now();

        $shop->save();

        flash(localize('Shop has been deleted successfully'))->success();
        return back();
    }

    # update status 
    public function updateShopStatus(Request $request)
    {
        $shop              = Shop::findOrFail($request->id);
        $shop->is_approved = $request->status;
        if ($shop->save()) {
            return 1;
        }
        return 0;
    }

    # update status 
    public function updateShopPublishStatus(Request $request)
    {
        $shop               = Shop::findOrFail($request->id);
        $shop->is_published = $request->is_published;
        if ($shop->save()) {
            return 1;
        }
        return 0;
    }

    public function shopsEmployees(Request $request)
    {
        $searchKey = null;
        $is_banned = null;

        $shop_users = User::where('user_type',"vendor")->where('etat',1)->latest();

        if ($request->search != null) {
            $shop_users = $shop_users->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
            $searchKey = $request->search;
        }

        if ($request->is_banned != null) {
            $shop_users = $shop_users->where('is_banned', $request->is_banned);
            $is_banned    = $request->is_banned;
        }

        $shop_users = $shop_users->paginate(paginationNumber());
        
        return view('shop.backend.pages.shop_users.index', compact('shop_users', 'searchKey', 'is_banned'));
    }
}
