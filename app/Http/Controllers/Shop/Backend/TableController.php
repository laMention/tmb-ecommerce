<?php
    
namespace App\Http\Controllers\Shop\Backend;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class TableController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['permission:tables'])->only(['index']);
        // $this->middleware(['permission:add_table'])->only(['create', 'store']);
        // $this->middleware(['permission:edit_table'])->only(['edit', 'update']);
        // $this->middleware(['permission:delete_table'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchKey = null;
        $etat = null;
        $status = null;

        $tables = Table::where('etat',1)->where('shop_id',auth()->user()->shop->id)->latest();

        if ($request->search != null) {
            $tables = $tables->where('num_table', 'like', '%' . $request->search . '%');
            $searchKey = $request->search;
        }

        if ($request->etat != null) {
            $tables = $tables->where('etat', $request->etat);
            $etat    = $request->etat;
        }
        if ($request->status != null) {
            $tables = $tables->where('status', $request->status);
            $status    = $request->status;
        }

        $tables = $tables->paginate(paginationNumber());

        return view('shop.backend.tables.index', compact('tables', 'searchKey', 'etat','status'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('shop.backend.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table    =  new Table;
        $table->shop_id = auth()->user()->shop->id;
        $table->num_table = $request->num_table;
        $table->nombre_chaise = $request->nombre_chaise;
        $table->etat =  1;
        $table->status =  0;
        $table->nb_place_dispo = $request->nombre_chaise;

        $table->save(); 

        flash(localize('Table ajoutée avec succès'))->success();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table    = Table::findOrfail($id);

        return view('shop.backend.tables.edit',compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $table    = Table::where('id',$request->table_id)->first();

        $table->num_table = $request->num_table;
        $table->nombre_chaise = $request->nombre_chaise;

        $table->save(); 

        flash(localize('Table modifié avec succès'))->success();
        // return redirect()->route('vendor.tables.index');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $table    = Table::where('id',$id)->first();
        $table->etat = 0;
        $table->deleted_at = Carbon::now();

        $table->save();

        flash(localize('Table has been deleted successfully'))->success();
        return back();
    }

    public function reinitializeTable(Request $request, $id)
    {
        $table    = Table::where('id',$id)->first();
        $table->etat = 1;
        $table->status = 0;
        $table->nb_place_dispo = 0;

        $table->save();

        flash(localize('Table has been reinitialized successfully'))->success();
        return back();
    }
}
