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
			$table->unsignedInteger('id_produto');
			$table->Integer('quantidade');
			$table->date('validade');
			$table->timestamps();

			$table->foreign('id_produto')->references('id')->on('produto')->onDelete('cascade');
		});
		
		DB::statement('ALTER TABLE lote ADD CONSTRAINT quantidade_positive CHECK (quantidade >= 0)');
		DB::statement('
			CREATE TRIGGER validade_check BEFORE INSERT ON lote
			FOR EACH ROW
			BEGIN
				IF NEW.validade < CURDATE() THEN
					SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "validade precisa ser maior que a data atual";
				END IF;
			END
		');
		}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lote');
    }
};
