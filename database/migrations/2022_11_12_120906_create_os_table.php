<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->timestamp('entrada')->useCurrent();
            $table->string('tipo_aparelho');
            $table->unsignedBigInteger('marca_id');
            $table->string('modelo');
            $table->string('estado_aparelho');
            $table->string('defeito_alegado');
            $table->string('observacao');
            $table->unsignedBigInteger('status_id');
            $table->float('valor_servico')->nullable();
            $table->timestamp('retirada')->nullable();
            $table->string('entregue_para')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordens');
    }
};
