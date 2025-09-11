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
        Schema::create('metas', function (Blueprint $table) {
            $table->id("cd_meta");
            $table->foreignId("cd_nivel_imp")
                ->nullable()
                ->references("cd_nivel_imp")
                ->on("nivel_imp")
                ->onDelete("cascade");
            $table->foreignId('cd_modalidade')
                ->references('cd_modalidade')
                ->on('modalidade')
                ->onDelete('cascade');
            $table->foreignId('cd_tipo_meta')
                ->references('cd_tipo_meta')
                ->on('tipo_metas')
                ->onDelete('cascade');

            $table->boolean('ic_recorrente');
            $table->boolean('ic_finalizada')
                ->nullable();
            $table->decimal('vl_valor_meta',9,2)
                ->nullable();
            $table->decimal('vl_valor_progresso',9,2)
                ->nullable();
            $table->decimal('pc_meta',6,3)
                ->nullable();
            $table->decimal('pc_progresso',6,3)
                ->nullable();
            $table->string("nm_meta",50);
            $table->text('ds_descricao')
                ->nullable();
            $table->date("dt_termino")
                ->nullable();
            $table->boolean("ic_status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metas');
    }
};
