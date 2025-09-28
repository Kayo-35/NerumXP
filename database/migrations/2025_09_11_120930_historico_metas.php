<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /*
        A função dessa tabela seria armazenar o progresso em relação ao cumprimento da meta
        em relação ao tempo. A unidade de medida poderia ser mensal, o que costuma ser ideal
    */
    public function up(): void
    {
        Schema::create("historico_metas", function (Blueprint $table) {
            $table->id('cd_historico_meta');
            $table->foreignId('cd_meta')
                ->references('cd_meta')
                ->on('metas')
                ->onDelete('cascade');
            $table->decimal('vl_alvo', 9, 2)
                ->nullable();
            $table->decimal('vl_progresso', 9, 2)
                ->nullable();
            $table->decimal('pc_alvo', 6, 3)
                ->nullable();
            $table->decimal('pc_progresso', 6, 3)
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historico_metas');
    }
};
