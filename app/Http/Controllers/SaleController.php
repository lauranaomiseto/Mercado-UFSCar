<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProd;

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
        $sales = DB::table('venda')
		->join('prod_venda', 'venda.id', '=', 'prod_venda.id_venda')
		->join('produto', 'produto.id', '=', 'prod_venda.id_produto')
		->select(
			'prod_venda.id_venda',
			DB::raw('SUM(prod_venda.quantidade * produto.preco) as total_venda')
		)
		->groupBy('prod_venda.id_venda')
		->get();

        return view('sales/listSale', [
            'sales' => $sales,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {	
	
		$products = DB::table('lote')
            ->join('produto', 'lote.id_produto', '=', 'produto.id')
            ->select('lote.id as id_lote', 'id_produto', 'produto.descricao', 'lote.quantidade', 'produto.preco')
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
		$items = $request->all();
		
		$sale = new Sale();
        $success = $sale->save();
		
		if(!$success)
        {
            return redirect()->back()->with('message', 'Algo deu errado...');
        }
		
		$sales = Sale::all();
		$id_venda = $sales[sizeof($sales)-1]->getAttributes()['id'];
		
		$products = DB::table('lote')
            ->join('produto', 'lote.id_produto', '=', 'produto.id')
            ->select('lote.id as id_lote', 'id_produto', 'produto.descricao', 'lote.quantidade', 'produto.preco')
            ->get()
			->all();
		
		
		$id_prod = 0;
		$id_lote = 0;
		foreach ($items as $chave => $valor) {
			if (strcmp($chave, "_token") == 0)
				continue;
			else if (str_contains($chave, "product")) {
				$keys = array_column($products, 'id_produto');
				$index = array_search($valor, $keys);
				$id_prod = $products[$index]->id_produto;
				$id_lote = $products[$index]->id_lote;
			} else {
				$saleprod = new SaleProd();
				$saleprod->id_produto = $id_prod;
				$saleprod->id_lote = $id_lote;
				$saleprod->id_venda = $id_venda;
				$saleprod->quantidade = $valor;
				$saleprod->save();
			}
		}
		
        return redirect()->route('sales');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
		$sales = DB::table('venda')
		->join('prod_venda', 'venda.id', '=', 'prod_venda.id_venda')
		->join('produto', 'produto.id', '=', 'prod_venda.id_produto')
		->select(
			'prod_venda.id_venda',
			DB::raw('SUM(prod_venda.quantidade * produto.preco) as total_venda'),
			DB::raw('SUM(prod_venda.quantidade) as total_quantidade')
		)
		->groupBy('prod_venda.id_venda')
		->where('id_venda', '=', $sale->getAttributes()['id'])
		->get()
		->all()[0];
		
        return view('sales/showSale', [
            'sale' => $sales,
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
		$salesProd = SaleProd::where('id_venda', $sale->getAttributes()['id'])->get()->all();
		foreach ($salesProd as $item) {
            //dd($item);
            $item->delete();
        }
        $sale->delete();

        return redirect()->route('sales');
    }
}
