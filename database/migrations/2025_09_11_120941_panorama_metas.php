<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

     /*
        Essa tabela teria função semalhante a de panorama de registros, mas com a intenção de
        indicar relatórios de progresso gerais de metas
     */
    public function up(): void
    {
        Schema::create('panorama_metas', function (Blueprint $table) {
           $table->id('cd_panorama_meta');
           $table->foreignId('cd_meta')
                ->references('cd_meta')
                ->on('metas')
                ->onDelete('cascade');
            $table->tinyInteger('qt_metas_renda',unsigned: true);
            $table->tinyInteger('qt_metas_despesa',unsigned: true);
            $table->decimal('pc_metas_finalizadas',6,3);
            $table->decimal('pc_metas_nao_finalizadas',6,3);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panorama_metas');
    }
};
