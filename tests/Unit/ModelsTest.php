<?php
namespace Tests\Unit;

use App\Models\Product;
use App\Models\Batch;
use App\Models\Sale;
use App\Models\SaleProd;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelsTest extends TestCase
{
    use RefreshDatabase;

    public function test_produtoCriado()
    {
        $product = Product::create([
            'descricao' => 'Produto Teste',
            'preco' => 100.00
        ]);

        $this->assertDatabaseHas('produto', ['descricao' => 'Produto Teste']);
    }
	
	public function test_produtoPrecoNegativo()
	{
		try {
			$product = Product::create([
				'descricao' => 'Produto Teste',
				'preco' => -100.00
			]);
		} catch (\Illuminate\Database\QueryException $e) {
			$this->assertStringContainsString('preco_positive', $e->getMessage());
		}

		$this->assertDatabaseMissing('produto', ['descricao' => 'Produto Teste']);
	}

    public function test_loteCriado()
    {
        $product = Product::create([
            'descricao' => 'Produto Teste',
            'preco' => 100.00
        ]);

        $batch = Batch::create([
            'id_produto' => $product->id,
            'quantidade' => 50,
            'validade' => now()->addDays(30)
        ]);

        $this->assertDatabaseHas('lote', ['id_produto' => $product->id]);
        $this->assertEquals($product->id, $batch->product->id);
    }
	
	public function test_loteQuantidadeNegativa()
	{
		try {
			$product = Product::create([
				'descricao' => 'Produto Teste',
				'preco' => 100.00
			]);

			$batch = Batch::create([
				'id_produto' => $product->id,
				'quantidade' => -50,
				'validade' => now()->addDays(30)
			]);
		} catch (\Illuminate\Database\QueryException $e) {
			$this->assertStringContainsString('quantidade_positive', $e->getMessage());
		}

		$this->assertDatabaseMissing('lote', ['id_produto' => $product->id]);
	}
	
	public function test_loteValidadeNegativa()
	{
		try {
			$product = Product::create([
				'descricao' => 'Produto Teste',
				'preco' => 100.00
			]);

			$batch = Batch::create([
				'id_produto' => $product->id,
				'quantidade' => 50,
				'validade' => now()->addDays(-30)
			]);
		} catch (\Illuminate\Database\QueryException $e) {}

		$this->assertDatabaseMissing('lote', ['id_produto' => $product->id]);
	}

    public function test_vendaCriada()
    {
        $sale = Sale::create([
            'created_at' => now()
        ]);

        $this->assertDatabaseHas('venda', ['id' => $sale->id]);
    }

    public function test_prod_vendaCriada()
    {
        $product = Product::create([
            'descricao' => 'Produto Teste',
            'preco' => 100.00
        ]);

        $batch = Batch::create([
            'id_produto' => $product->id,
            'quantidade' => 50,
            'validade' => now()->addDays(30)
        ]);


        $sale = Sale::create([
            'created_at' => now()
        ]);

        $saleProd = SaleProd::create([
            'id_produto' => $product->id,
            'id_lote' => $batch->id,
            'id_venda' => $sale->id,
            'quantidade' => 10
        ]);

        $this->assertDatabaseHas('prod_venda', ['id_produto' => $product->id]);
    }
	
	public function test_prod_vendaQuantidadeNegativa()
    {
		try {
			$product = Product::create([
				'descricao' => 'Produto Teste',
				'preco' => 100.00
			]);

			$batch = Batch::create([
				'id_produto' => $product->id,
				'quantidade' => 50,
				'validade' => now()->addDays(30)
			]);


			$sale = Sale::create([
				'created_at' => now()
			]);

			$saleProd = SaleProd::create([
				'id_produto' => $product->id,
				'id_lote' => $batch->id,
				'id_venda' => $sale->id,
				'quantidade' => -10
			]);
		} catch (\Illuminate\Database\QueryException $e) {
			$this->assertStringContainsString('quantidade_positive', $e->getMessage());
		}

        $this->assertDatabaseMissing('prod_venda', ['id_produto' => $product->id]);
    }
	

    public function test_usuarioCriado()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }
}


