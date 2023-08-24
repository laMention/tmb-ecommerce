<?php

namespace App\Http\Controllers\Shop\Backend;

use App\Http\Controllers\Controller;
use App\Models\Serveur;
use App\Models\ServeurOrder;
use App\Models\Language;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class WaiterController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['permission:waiters'])->only(['index','updateShopStatus','updateShopPublishStatus']);
        // $this->middleware(['permission:add_shop'])->only(['create', 'store']);
        // $this->middleware(['permission:edit_shop'])->only(['edit', 'update']);
        // $this->middleware(['permission:delete_shop'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $searchKey = null;
        $is_approved = null;

        $waiters = Serveur::where('etat',1)->where('shop_id',auth()->user()->shop->id)->latest();

        if ($request->search != null) {
            $waiters = $waiters->where('name', 'like', '%' . $request->search . '%');
            $searchKey = $request->search;
        }

        if ($request->is_approved != null) {
            $waiters = $waiters->where('is_approved', $request->is_approved);
            $is_approved    = $request->is_approved;
        }

        $waiters = $waiters->paginate(paginationNumber());

        return view('shop.backend.waiters.index', compact('waiters', 'searchKey', 'is_approved'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shop.backend.waiters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $waiter    =  new Serveur;
        $waiter->user_id = auth()->user()->id;
        $waiter->shop_id = auth()->user()->shop->id;
        $waiter->name = $request->name;
        $waiter->lastname = $request->lastname;
        $waiter->adresse =  $request->adresse;
        $waiter->contact =  $request->contact;
        $waiter->code_poste =  rand(1111,9999);
        $waiter->photo = $request->photo;

        $waiter->save(); 

        flash(localize('Waiter has been inserted successfully'))->success();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Serveur  $serveur
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $searchKey = null;
        $statut = null;
        //
        $waiter    = Serveur::findOrfail($id);

        $order_server = ServeurOrder::where('serveur_id', $waiter->id)->where('shop_id',auth()->user()->shop->id)->groupBy('serveur_id')->latest();

        if ($request->statut != null) {
            $order_server = $order_server->where('statut', $request->statut);
            $statut    = $request->statut;
        }

        $order_server = $order_server->paginate(paginationNumber());

        

        return view('shop.backend.waiters.show',compact('waiter','order_server','statut'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Serveur  $serveur
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $waiter    = Serveur::findOrfail($id);

        return view('shop.backend.waiters.edit',compact('waiter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Serveur  $serveur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $waiter    = Serveur::where('id',$request->waiter_id)->first();

        // echo "<pre>";print_r($request->all());die;

        $oldwaiter                          = clone $waiter;
        if ($waiter->id != $request->waiter_id) {
            abort(403);
        }
        if (empty($waiter->code_poste)) {
            $waiter->code_poste = rand(1111,9999);
        }

        $waiter->user_id = auth()->user()->id;
        $waiter->shop_id = auth()->user()->shop->id;
        $waiter->name = $request->name;
        $waiter->lastname = $request->lastname;
        $waiter->adresse =  $request->adresse;
        $waiter->contact =  $request->contact;
        $waiter->photo = $request->photo;

        $waiter->save();

        flash(localize('Waiter has been updated successfully'))->success();
        return redirect()->route('vendor.waiters.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Serveur  $serveur
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $waiter             = Serveur::where('id',$id)->first();

        $waiter->etat = 0;
        $waiter->is_approved = 0;
        $waiter->deleted_at = Carbon::now();

        $waiter->save();

        flash(localize('Waiter has been deleted successfully'))->success();
        return back();
    }

    public function updateWaiterStatus(Request $request)
    {
        $waiter              = Serveur::findOrFail($request->id);
        $waiter->is_approved = $request->status;
        if ($waiter->save()) {
            return 1;
        }
        return 0;
    }

    // Gerer les serveurs et les commandes
    public function updateStatusCmdServer(Request $request)
    {
        $orderserveur = ServeurOrder::findOrFail($request->id);

        $orderserveur->statut = $request->status;


        if ($orderserveur->save()) {
            return 1;
        }
        return 0;
    }

    // Attribuer une commande à un serveur
    public function attachOrderToServeur(Request $request)
    {
        // echo $orderserveur = ServeurOrder::findOrFail();die;

        if (!empty($request->orders)) {
            foreach ($request->orders as $key => $value) {
                $serverOrder = new ServeurOrder;

                $serverOrder->serveur_id = $request->waiter_id;
                $serverOrder->order_id = $value;
                $serverOrder->statut = 0;
                $serverOrder->shop_id = auth()->user()->shop->id;

                $serverOrder->save();


            }
            // Module d'envoi d'alerte (notification au serveur par sms à integrer)

            // Fin module

            flash(localize('Commande attribuée'))->success();
            return redirect()->route('vendor.waiters.index');


        }else{
            flash(localize('Veuillez attribuer une Commande avant de valider'))->error();
            return redirect()->back();
        }

    }
}
