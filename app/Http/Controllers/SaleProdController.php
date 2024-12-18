<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProd;

use Illuminate\Http\Request;

class SaleProdController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_produto' => 'required|numeric',
			'id_lote' => 'required|numeric',
			'id_venda' => 'required|numeric',
            'quantidade' => 'required|numeric|gt:0',
        ]);

        $saleprod = new SaleProd();
        $saleprod->id_produto = $validated['id_produto'];
		$saleprod->id_lote = $validated['id_lote'];
		$saleprod->id_venda = $validated['id_venda'];
        $saleprod->quantidade = $validated['quantidade'];
		
        $success = $saleprod->save();

        if(!$success)
        {
            return redirect()->back()->with('message', 'Algo deu errado...');
        }
    
        //return redirect()->route('batches');
    }
}
