<?php

namespace App\Http\Controllers\Shop\Backend;

use App\Http\Controllers\Controller;
use App\Models\Servir;
use App\Models\Table;
use App\Models\OrderGroup;
use App\Models\Order;
use Illuminate\Http\Request;

class ServirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchKey = null;
        $status = null;

        $orders = OrderGroup::where(['channel_type_order' => 2])->latest();

        if ($request->search != null) {
            $orders = $orders->where('order_code', 'like', '%' . $request->search . '%');
            $searchKey = $request->search;
        }

        // if ($request->etat != null) {
        //     $tables = $tables->where('etat', $request->etat);
        //     $etat    = $request->etat;
        // }
        // if ($request->status != null) {
        //     $tables = $tables->where('status', $request->status);
        //     $status    = $request->status;
        // }

        $orders = $orders->paginate(paginationNumber());

        return view('shop.backend.waiters.orders.index', compact('orders', 'searchKey'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servir  $servir
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $order = OrderGroup::with('order')->findOrFail($id);

        return view('shop.backend.waiters.orders.show',compact('order'));


        // return redirect()->route('vendor.onplaceOrder.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servir  $servir
     * @return \Illuminate\Http\Response
     */
    public function edit(Servir $servir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servir  $servir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servir $servir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servir  $servir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servir $servir)
    {
        //
    }
}
