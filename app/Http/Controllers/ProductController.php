<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // o index é a função de listagem
    public function index() 
    {
        $products = Product::all();
        return view('products/listProduct', [
            'products' => $products
        ]);
    }

    public function create() 
    {
        return view('products/createProduct');
    }

    public function store(Request $request) 
    {   
        $validated = $request->validate([
            'descricao' => 'required|string|max:200',
            'preco' => 'required|numeric',
        ]);

        $product = new Product();
        $product->descricao = $validated['descricao'];
        $product->preco = $validated['preco'];
        $success = $product->save();

        if(!$success)
        {
            return redirect()->back()->with('message', 'Algo deu errado...');
        }
    
        return redirect()->route('products');
    }

    // graças ao route model binding do laravel, ao injetar o id de um model em uma rota ou controlador, 
    // é possível recuperar toda linha do registro identificado
    public function edit(Product $product) {
        return view('products/editProduct', [
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'descricao' => 'required|string|max:200',
            'preco' => 'required|numeric',
        ]);
    
        $product->descricao = $validated['descricao'];
        $product->preco = $validated['preco'];
        $success = $product->save();

        if(!$success)
        {
            return redirect()->back()->with('message', 'Algo deu errado...');
        }
    
        return redirect()->route('products');
    }

    public function show(Product $product) {
        return view('products/showProduct', [
            'product' => $product
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products');
    }
}
