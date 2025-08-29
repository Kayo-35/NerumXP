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
        Schema::create('panorama', function (Blueprint $table) {
            $table->id("cd_resumo");
            $table->foreignId("cd_usuario")
                ->references("cd_usuario")
                ->on("usuario")
                ->onDelete("cascade");
            $table->decimal("vl_debito",9,2)->nullable();
            $table->decimal("vl_superavit",9,2)->nullable();
            $table->decimal("balanco",9,2)->nullable();
            //Intervalo de análise do panorma
            $table->timestamp("dt_inicio");
            $table->timestamp("dt_termino");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panorama');
    }
};
