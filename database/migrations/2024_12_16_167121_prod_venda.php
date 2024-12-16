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
            $table->unsignedInteger('quantidade');
			$table->primary(['id_produto', 'id_lote', 'id_venda']);
            $table->foreign('id_produto')->references('id')->on('produto');
			$table->foreign('id_lote')->references('id')->on('lote');
			$table->foreign('id_venda')->references('id')->on('venda');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prod_venda');
    }
};
