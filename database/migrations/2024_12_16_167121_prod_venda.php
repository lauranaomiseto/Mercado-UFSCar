<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prod_venda', function (Blueprint $table){
            $table->unsignedInteger('id_produto');
            $table->unsignedInteger('id_lote');
			$table->unsignedInteger('id_venda');
            $table->Integer('quantidade');
			$table->timestamps();
			$table->primary(['id_produto', 'id_lote', 'id_venda']);
            $table->foreign('id_produto')->references('id')->on('produto')->onDelete('cascade');
			$table->foreign('id_lote')->references('id')->on('lote')->onDelete('cascade');
			$table->foreign('id_venda')->references('id')->on('venda')->onDelete('cascade');
        });
		
		DB::statement('ALTER TABLE prod_venda ADD CONSTRAINT quantidade_positive CHECK (quantidade >= 0)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prod_venda');
    }
};
