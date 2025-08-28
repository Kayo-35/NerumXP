<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("metas_registro", function (Blueprint $table) {
            $table
                ->foreignId("cd_metas")
                ->references("cd_metas")
                ->on("metas")
                ->onDelete("cascade");
            $table
                ->foreignId("cd_registro")
                ->references("cd_registro")
                ->on("registro")
                ->onDelete("cascade");
            $table->timestamps();
            $table->primary(["cd_metas", "cd_registro"]);
        });

        Schema::create("registro_metodoPagamento", function (Blueprint $table) {
            $table
                ->foreignId("cd_metodo")
                ->references("cd_metodo")
                ->on("metodo_pagamento")
                ->onDelete("cascade");
            $table
                ->foreignId("cd_registro")
                ->references("cd_registro")
                ->on("registro")
                ->onDelete("cascade");

            $table->timestamps();
            $table->primary(["cd_metodo", "cd_registro"]);
        });
        Schema::create("metas_projeto", function (Blueprint $table) {
            $table
                ->foreignId("cd_metas")
                ->references("cd_metas")
                ->on("metas")
                ->onDelete("cascade");
            $table
                ->foreignId("cd_projeto")
                ->references("cd_projeto")
                ->on("projeto")
                ->onDelete("cascade");
            $table->timestamps();
            $table->primary(["cd_metas", "cd_projeto"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("metas_registro");
        Schema::dropIfExists("registro_metodoPagamento");
        Schema::dropIfExists("metas_projeto");
    }
};
