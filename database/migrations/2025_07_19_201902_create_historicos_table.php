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
        Schema::create("historico", function (Blueprint $table) {
            $table->id("cd_historico");
            $table
                ->foreignId("cd_registro")
                ->nullable()
                ->references("cd_registro")
                ->on("registro")
                ->onDelete("cascade");
            $table->decimal("vl_valor", 9, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("historico");
    }
};
