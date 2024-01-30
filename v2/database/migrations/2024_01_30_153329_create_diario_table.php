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
        Schema::create('diario', function (Blueprint $table) {
            $table->id();
            $table->string('obra');
            $table->string('local');
            $table->string('contratante');
            $table->string('contratado');
            $table->string('prazo_contratual');
            $table->string('prazo_decorrido');
            $table->string('condicao_climatica_manha');
            $table->boolean('praticavel_manha');
            $table->string('condicao_climatica_tarde');
            $table->boolean('praticavel_tarde');
            $table->string('qtd_funcionarios');
            $table->string('equipamentos');
            $table->string('detalhes_atividades');
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
        Schema::dropIfExists('diario');
    }
};
