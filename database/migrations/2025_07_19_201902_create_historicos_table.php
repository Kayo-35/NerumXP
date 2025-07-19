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
        Schema::create('historico', function (Blueprint $table) {
            $table->id("cd_historico");
            $table->foreignId("cd_origem_fixo")
                ->references("cd_registro_fixo")
                ->on("registro_fixo")
                ->onDelete("cascade");
            $table->foreignId("cd_origem_flutuante")
                ->references("cd_registro_flutuante")
                ->on("registro_flutuante")
                ->onDelete("cascade");
            $table->foreignId("cd_tipo_hist")
                ->references("cd_tipo_hist")
                ->on("tipo_historico")
                ->onDelete("cascade");

            $table->decimal("vl_valor",9,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historico');
    }
};
