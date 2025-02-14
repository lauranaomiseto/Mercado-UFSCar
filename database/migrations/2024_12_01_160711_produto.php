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
        Schema::create('produto', function (Blueprint $table){
            $table->increments('id');
            $table->string('descricao'); // por default length 255
            $table->float('preco');
            $table->timestamps();
        });
		
		DB::statement('ALTER TABLE produto ADD CONSTRAINT preco_positive CHECK (preco >= 0)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto');
    }
};
