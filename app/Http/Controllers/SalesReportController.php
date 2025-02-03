<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleProd;
use Carbon\Carbon;

class SalesReportController extends Controller
{
    public function salesReport(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Data atual formatada apenas com dia, mês e ano
    $now = Carbon::now()->format('Y-m-d');

    // Verifica se as datas foram fornecidas e converte para 'Y-m-d'
    if ($endDate) {
        $endDate = Carbon::parse($endDate)->format('Y-m-d');
    }
    if ($startDate) {
        $startDate = Carbon::parse($startDate)->format('Y-m-d');
    }

    // Consulta as vendas no intervalo de datas
    $sales = SaleProd::whereBetween('updated_at', [
        Carbon::parse($startDate)->startOfDay(),
        Carbon::parse($endDate)->endOfDay(),
    ])->get();

    // Cálculo de vendas e valor total
    $totalVendas = $sales->count();
    $valorTotalVendas = $sales->sum(function ($sale) {
        return $sale->quantidade * $sale->product->preco;
    });

    return view('reports/sales_report', compact('sales', 'startDate', 'endDate', 'totalVendas', 'valorTotalVendas', 'now'));
    }

}
