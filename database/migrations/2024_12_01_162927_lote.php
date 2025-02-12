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
		Schema::create('lote', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('id_produto')->nullable();
			$table->unsignedInteger('quantidade');
			$table->date('validade');
			$table->timestamps();

			$table->foreign('id_produto')
				  ->references('id')
				  ->on('produto')
				  ->onDelete('set null');
		});
	}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lote');
    }
};
