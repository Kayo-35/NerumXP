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
                ->foreignId("cd_meta")
                ->references("cd_meta")
                ->on("metas")
                ->onDelete("cascade");
            $table
                ->foreignId("cd_registro")
                ->references("cd_registro")
                ->on("registro")
                ->onDelete("cascade");
            $table->timestamps();
            $table->primary(["cd_meta", "cd_registro"]);
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

        Schema::create("metas_categoria", function (Blueprint $table) {
            $table->foreignId("cd_meta")
                ->references("cd_meta")
                ->on("metas")
                ->onDelete("cascade");
            $table->foreignId("cd_categoria")
                ->references("cd_categoria")
                ->on("categoria")
                ->onDelete("cascade");
            $table->timestamps();
            $table->primary(["cd_meta", "cd_categoria"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("metas_registro");
        Schema::dropIfExists("registro_metodoPagamento");
        Schema::dropIfExists("metas_categoria");
    }
};
