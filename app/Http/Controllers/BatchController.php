<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Product;

use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batches = Batch::all();
        return view('batches/listBatch', [
            'batches' => $batches
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all('id', 'descricao');
        return view('batches/createBatch', [
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_produto' => 'required|numeric',
            'quantidade' => 'required|numeric|gt:0',
            'validade' => 'required|date|after:today',
        ]);

        $batch = new Batch();
        $batch->id_produto = $validated['id_produto'];
        $batch->quantidade = $validated['quantidade'];
        $batch->validade = $validated['validade'];

        $success = $batch->save();

        if(!$success)
        {
            return redirect()->back()->with('message', 'Algo deu errado...');
        }
    
        return redirect()->route('batches');
    }

    /**
     * Display the specified resource.
     */
    public function show(Batch $batch)
    {
        $product = Product::findOr($batch->id_produto, function() {
            return redirect()->back()->with('message', 'O produto relacionado ao lote não foi encontrado...');
        });

        return view('batches/showBatch', [
            'product' => $product,
            'batch' => $batch
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Batch $batch)
    {
        $products = Product::all('id', 'descricao');
        return view('batches/editBatch', [
            'batch' => $batch,
            'products' => $products
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Batch $batch)
    {
        $validated = $request->validate([
            'id_produto' => 'required|numeric',
            'quantidade' => 'required|numeric|gt:0',
            'validade' => 'required|date|after:today',
        ]);

        $batch->id_produto = $validated['id_produto'];
        $batch->quantidade = $validated['quantidade'];
        $batch->validade = $validated['validade'];

        $success = $batch->save();

        if(!$success)
        {
            return redirect()->back()->with('message', 'Algo deu errado...');
        }
    
        return redirect()->route('batches');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Batch $batch)
    {
        $batch->delete();

        return redirect()->route('batches');
    }
}
