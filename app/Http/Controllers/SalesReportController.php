<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleProd;
use App\Models\Batch;
use App\Models\Product;
use Carbon\Carbon;
use DB;

class SalesReportController extends Controller
{
    public function salesReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Data atual formatada
        $now = Carbon::now()->format('Y-m-d');

        // Conversão das datas
        if ($endDate) {
            $endDate = Carbon::parse($endDate)->format('Y-m-d');
        }
        if ($startDate) {
            $startDate = Carbon::parse($startDate)->format('Y-m-d');
        }

        // Consulta as vendas no intervalo de datas
        // $sales = SaleProd::whereBetween('updated_at', [
        //     Carbon::parse($startDate)->startOfDay(),
        //     Carbon::parse($endDate)->endOfDay(),
        // ])->get();


        $sales = DB::table('prod_venda')
        ->join('produto', 'prod_venda.id_produto', '=', 'produto.id')
        ->select('id_produto', 'produto.descricao', 'prod_venda.quantidade', 'produto.preco', 'prod_venda.updated_at')
        ->whereBetween('prod_venda.updated_at', [
            Carbon::parse($startDate)->startOfDay(),
            Carbon::parse($endDate)->endOfDay(),
        ])
        ->get();

        // Cálculo de vendas e valor total
        $totalVendas = $sales->count();
        $valorTotalVendas = $sales->sum(fn($sale) => $sale->quantidade * $sale->preco);
        
        
        // Relatório de Controle de Estoque baseado em lotes
        $estoque = DB::table('lote')
			->join('produto', 'lote.id_produto', '=', 'produto.id')
			->select('id_produto', 'produto.descricao', 'lote.quantidade', 'produto.preco', 'lote.validade')
            ->where('lote.validade', '<=', now()->addDays(14))
            ->limit(10)
			->get()
            ->all();

        // Relatório de Produtos Mais Vendidos

        $topProducts = DB::table('prod_venda')
			->join('produto', 'prod_venda.id_produto', '=', 'produto.id')
			->select('id_produto', 'produto.descricao', 'produto.preco', DB::raw('SUM(quantidade) as total_vendido'))
            ->groupBy('id_produto', 'descricao', 'preco')
            ->orderBy('total_vendido', 'desc')
			->get()
            ->all();


            return view('reports/sales_report', [
                'sales' => $sales,
                'startDate' => $startDate ,
                'endDate' => $endDate,
                'totalVendas' => $totalVendas,
                'valorTotalVendas' => $valorTotalVendas,
                'now' => $now,
                'estoque' => $estoque,
                'produtosMaisVendidos' => $topProducts
            ]);
    }
}
