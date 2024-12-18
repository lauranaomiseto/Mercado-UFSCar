<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Product;
use App\Models\Sale;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
	
	public static $produtos = array();
	
    public function index()
    {
        $sales = Sale::all();
        return view('sales/listSale', [
            'sales' => $sales
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {	
	
		$products = DB::table('lote')
            ->join('produto', 'lote.id_produto', '=', 'produto.id')
            ->select('*')
            ->get();

        return view('sales/createSale', [
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sale = new Sale();
        $success = $sale->save();
		
        if(!$success)
        {
            return redirect()->back()->with('message', 'Algo deu errado...');
        }
        return redirect()->route('sales.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return view('sales/showSale', [
            'sale' => $sale,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        return view('sales/editSale', [
            'sale' => $sale,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'id' => 'required|numeric',
        ]);

        $sale->id = $validated['id'];
        $success = $sale->save();

        if(!$success)
        {
            return redirect()->back()->with('message', 'Algo deu errado...');
        }
    
        return redirect()->route('sales');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();

        return redirect()->route('sales');
    }
}
