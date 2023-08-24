<?php

namespace App\Http\Controllers\Shop\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Hash;

class StaffsController extends Controller
{
    # construct
    public function __construct()
    {
        $this->middleware(['permission:shop_staff'])->only('index');
        $this->middleware(['permission:add_shop_staff'])->only(['create', 'store']);
        $this->middleware(['permission:edit_shop_staff'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_shop_staff'])->only(['delete']);
    }

    # staff list
    public function index(Request $request)
    {
        $searchKey = null;
        // $staffs = User::where('user_type', 'staff')->latest();

        $staffs = User::where('user_type', 'vendor')->where('shop_id',auth()->user()->shop_id)->where('etat',1)->latest();



        if ($request->search != null) {
            $staffs = $staffs->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%');
            $searchKey = $request->search;
        }

        $staffs = $staffs->paginate(paginationNumber());


        // echo "<pre>";print_r($staffs);die;

        return view('shop.vendor.pages.staffs.index', compact('staffs', 'searchKey'));
    }

    # return create form
    public function create()
    {
        $roles = Role::oldest()->where('p_id','<>',1)->get();

        return view('shop.vendor.pages.staffs.create', compact('roles'));
    }

    # save new staff
    public function store(Request $request)
    {

        // echo Role::findOrFail($request->role_id)->name;die;

        if (User::where('email', $request->email)->first() == null) {
            $user             = new User;
            $user->name       = $request->name;
            $user->email      = $request->email;
            $user->shop_id    = auth()->user()->shop_id;
            $user->phone      = validatePhone($request->phone);
            $user->user_type  = "vendor";
            $user->password   = Hash::make($request->password);
            $user->role_id    = $request->role_id;
            $user->save();
            
            $user->assignRole(Role::findOrFail($request->role_id)->name);

            flash(localize('Employee has been inserted successfully'))->success();
            return redirect()->route('vendor.staffs.index');
        }
        flash(localize('Email already used'))->error();
        return back();
    }

    # edit staff
    public function edit($id)
    {
        $user  = User::findOrFail($id);
        $roles = Role::latest()->where('p_id','<>',1)->get();
        return view('shop.vendor.pages.staffs.edit', compact('user', 'roles'));
    }

    # update staff 
    public function update(Request $request)
    {
        $user             = User::findOrFail($request->id);
        $user->name       = $request->name;
        $user->email      = $request->email;
        $user->phone      = validatePhone($request->phone);
        $user->role_id    = $request->role_id;

        if (!empty($request->password)) {
            // code...
            if (strlen($request->password) > 0) {
                // if (strlen($request->password) > 0 && strlen($request->password) <= 4) {
                //     flash(localize('Password too short'))->success();
                //     return redirect()->back();
                // }
                $user->password = Hash::make($request->password);
            }
        }

        

        $user->save();
        $user->assignRole(Role::findOrFail($request->role_id)->name);

        flash(localize('Employee has been updated successfully'))->success();
        return redirect()->route('vendor.staffs.index');
    }

    # delete staff  
    public function delete($id)
    {
        // User::destroy($id);
        $user = User::findOrFail($id);

        $user->etat = 0;
        $user->deleted_at = Carbon::now();
        $user->save();

        flash(localize('Employee has been deleted successfully'))->success();
        return redirect()->route('vendor.staffs.index');
    }
}
