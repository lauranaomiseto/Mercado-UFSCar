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
			->select('id_produto', 'produto.descricao', DB::raw('SUM(lote.quantidade) as total_quantidade'), 'produto.preco')
			->groupBy('id_produto', 'produto.descricao', 'produto.preco')
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
		
		DB::beginTransaction();
		
		try {
		
			$sale = new Sale();
			$success = $sale->save();
			
			if(!$success)
			{
				DB::rollBack();
				return redirect()->back()->with('message', 'Algo deu errado...');
			}
			
			$sales = Sale::all();
			$id_venda = $sales[sizeof($sales)-1]->getAttributes()['id'];
			
			$products = DB::table('lote')
				->join('produto', 'lote.id_produto', '=', 'produto.id')
				->select('lote.id as id_lote', 'id_produto', 'produto.descricao', 'lote.quantidade', 'lote.validade', 'produto.preco')
				->orderBy('lote.validade', 'asc')
				->get()
				->all();

			foreach ($items as $chave => $valor) {
				if (strcmp($chave, "_token") == 0)
					continue;
				else if (str_contains($chave, "product")) {
					
					$filteredProducts = array_filter($products, fn($product) => $product->id_produto == $valor);
					$filteredProducts = array_values($filteredProducts);
					$id_prod = $filteredProducts[0]->id_produto;
					$id_lotes = [];
					$quantidades = [];
					foreach ($filteredProducts as $product) {
						$id_lotes[] = $product->id_lote;
						$quantidades[] = $product->quantidade;
					}

				} else {
					
					$quantidade = $valor;
					$i = 0;
					
					while ($quantidade > 0 && $i < count($id_lotes)) {
						$lote_quantidade = $quantidades[$i];
						$saleprod_quantidade = min($quantidade, $lote_quantidade);
						
						$saleprod = new SaleProd();
						$saleprod->id_produto = $id_prod;
						$saleprod->id_lote = $id_lotes[$i];
						$saleprod->id_venda = $id_venda;
						$saleprod->quantidade = $saleprod_quantidade;
						$saleprod->save();

						$quantidade = $quantidade - $saleprod_quantidade;

						$quantidades[$i] = $quantidades[$i] -  $saleprod_quantidade;
						
						$batch = Batch::find($id_lotes[$i]);
						
						$batch->quantidade = $batch->quantidade - $saleprod_quantidade;
						$batch->save();
						
						if ($quantidades[$i] <= 0) {
							$i++;
						}
					}
					
					if ($quantidade > 0) {
						throw new Exception("Não há produtos suficientes no sistema");
					}
				}
			}
			
			DB::commit();
			return redirect()->route('sales');
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with('message', 'Erro ao registrar a venda: ' . $e->getMessage());
		}
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
		
		$products_bought = DB::table('venda')
		->join('prod_venda', 'venda.id', '=', 'prod_venda.id_venda')
		->join('produto', 'produto.id', '=', 'prod_venda.id_produto')
		->select(
			'*',
		)
		->where('id_venda', '=', $sale->getAttributes()['id'])
		->get()
		->all();
		
        return view('sales/showSale', [
            'sale' => $sales,
			'products_bought' => $products_bought
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {	
	
		$products = DB::table('lote')
            ->join('produto', 'lote.id_produto', '=', 'produto.id')
            ->select('lote.id as id_lote', 'id_produto', 'produto.descricao', 'lote.quantidade', 'produto.preco')
            ->get();
		
		$products_bought = DB::table('venda')
			->join('prod_venda', 'venda.id', '=', 'prod_venda.id_venda')
			->join('produto', 'produto.id', '=', 'prod_venda.id_produto')
			->select(
				'*',
			)
			->where('id_venda', '=', $sale->getAttributes()['id'])
			->get()
			->all();
		
        return view('sales/editSale', [
            'sale' => $sale,
			'products' => $products,
			'products_bought' => $products_bought
        ]);
    }

    public function update(Request $request, Sale $sale)
    {	
	
		$items = $request->all();
		$id_venda = $sale->getAttributes()['id'];
		
		$products = DB::table('lote')
			->join('produto', 'lote.id_produto', '=', 'produto.id')
			->select('lote.id as id_lote', 'id_produto', 'produto.descricao', 'lote.quantidade', 'lote.validade', 'produto.preco')
			->orderBy('lote.validade', 'asc')
			->get()
			->all();
		
		$products_bought = DB::table('venda')
			->join('prod_venda', 'venda.id', '=', 'prod_venda.id_venda')
			->join('produto', 'produto.id', '=', 'prod_venda.id_produto')
			->select(
				'*',
			)
			->where('id_venda', '=', $sale->getAttributes()['id'])
			->get()
			->all();
		
		DB::beginTransaction();
		
		try {
			
			foreach ($products_bought as $product_bought) {
				$batch_id = $product_bought->id_lote;
				$quantity_sold = $product_bought->quantidade;

				$batch = Batch::find($batch_id);
				$batch->quantidade += $quantity_sold;
				$batch->save();
			}
			
			SaleProd::where('id_venda', $id_venda)->delete();
			foreach ($items as $chave => $valor) {
				if (strcmp($chave, "_token") == 0 || strcmp($chave, "_method") == 0) {
					continue;
				} else if (str_contains($chave, "product")) {
					$filteredProducts = array_filter($products, fn($product) => $product->id_produto == $valor);
					$filteredProducts = array_values($filteredProducts);
					$id_prod = $filteredProducts[0]->id_produto;
					$id_lotes = [];
					$quantidades = [];
					foreach ($filteredProducts as $product) {
						$id_lotes[] = $product->id_lote;
						$quantidades[] = $product->quantidade;
					}
				} else {
					
					$quantidade = $valor;
					$i = 0;
					
					
					while ($quantidade > 0 && $i < count($id_lotes)) {
						
						$lote_quantidade = $quantidades[$i];
						$saleprod_quantidade = min($quantidade, $lote_quantidade);
						
						$saleprod = new SaleProd();
						$saleprod->id_produto = $id_prod;
						$saleprod->id_lote = $id_lotes[$i];
						$saleprod->id_venda = $id_venda;
						$saleprod->quantidade = $saleprod_quantidade;
						$saleprod->save();

						$quantidade = $quantidade - $saleprod_quantidade;
						$quantidades[$i] = $quantidades[$i] -  $saleprod_quantidade;
						
						$batch = Batch::find($id_lotes[$i]);
						$batch->quantidade = $batch->quantidade - $saleprod_quantidade;
						$batch->save();
						
						if ($quantidades[$i] <= 0) {
							$i++;
						}
					}
					
					if ($quantidade > 0) {
						throw new Exception("Não há produtos suficientes no sistema");
					}
				}
			}
			DB::commit();
			return redirect()->route('sales');
			
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with('message', 'Erro ao registrar a venda: ' . $e->getMessage());
		}
		
        return redirect()->route('sales');
    }

    public function destroy(Sale $sale)
    {
        SaleProd::where('id_venda', $sale->id)->delete();

        $sale->delete();

        return redirect()->route('sales')->with('message', 'Venda excluída com sucesso!');
    }

}
