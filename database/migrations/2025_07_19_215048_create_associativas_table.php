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
        Schema::create('metas_reg_fixo', function (Blueprint $table) {
            $table->foreignId("cd_metas")
                ->references("cd_metas")
                ->on("metas")
                ->onDelete("cascade");
            $table->foreignId("cd_registro_fixo")
                ->references("cd_registro_fixo")
                ->on("registro_fixo")
                ->onDelete("cascade");
            $table->timestamps();
            $table->primary(["cd_metas","cd_registro_fixo"]);
        });
        Schema::create("metas_reg_flut", function (Blueprint $table) {
            $table->foreignId("cd_registro_flutuante")
                ->references("cd_registro_flutuante")
                ->on("registro_flutuante")
                ->onDelete("cascade");
            $table->foreignId("cd_metas")
                ->references("cd_metas")
                ->on("metas")
                ->onDelete("cascade");

            $table->timestamps();
            $table->primary(["cd_registro_flutuante","cd_metas"]);
        });
        Schema::create("registro_flut_tipoP", function (Blueprint $table){
           $table->foreignId("cd_registro_flutuante")
                ->references("cd_registro_flutuante")
                ->on("registro_flutuante")
                ->onDelete("cascade");
            $table->foreignId("cd_tipo_forma")
                ->references("cd_tipo_forma")
                ->on("forma_pagamento")
                ->onDelete("cascade");
            $table->timestamps();
            $table->primary(["cd_registro_flutuante","cd_tipo_forma"]);
        });
        Schema::create("registro_flut_metodoP", function(Blueprint $table) {
           $table->foreignId("cd_tipo_metodo")
                ->references("cd_tipo_metodo")
                ->on("metodo_pagamento")
                ->onDelete("cascade");
            $table->foreignId("cd_registro_flut")
                ->references("cd_registro_flutuante")
                ->on("registro_flutuante")
                ->onDelete("cascade");

            $table->timestamps();
            $table->primary(["cd_tipo_metodo","cd_registro_flut"]);
        });
        Schema::create("registro_fix_metodoP", function(Blueprint $table) {
           $table->foreignId("cd_tipo_metodo")
                ->references("cd_tipo_metodo")
                ->on("metodo_pagamento")
                ->onDelete("cascade");
            $table->foreignId("cd_registro_fixo")
                ->references("cd_registro_fixo")
                ->on("registro_fixo")
                ->onDelete("cascade");

            $table->timestamps();
            $table->primary(["cd_tipo_metodo","cd_registro_fixo"]);
        });
        Schema::create("registro_fix_tipoP", function(Blueprint $table){
           $table->foreignId("cd_tipo_forma")
                ->references("cd_tipo_forma")
                ->on("forma_pagamento")
                ->onDelete("cascade");
            $table->foreignId("cd_registro_fixo")
                ->references("cd_registro_fixo")
                ->on("registro_fixo")
                ->onDelete("cascade");

            $table->timestamps();
            $table->primary(["cd_tipo_forma","cd_registro_fixo"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metas_registro_fixo');
        Schema::dropIfExists('metas_reg_flut');
        Schema::dropIfExists('registro_flut_tipoP');
        Schema::dropIfExists('registro_flut_metodoP');
        Schema::dropIfExists('registro_fix_metodoP');
        Schema::dropIfExists('registro_fix_tipoP');
    }
};
