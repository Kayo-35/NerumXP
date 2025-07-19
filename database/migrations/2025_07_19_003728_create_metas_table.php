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
            $table->id("cd_metas");
            $table->foreignId("cd_nivel_imp")
                ->nullable()
                ->references("cd_nivel_imp")
                ->on("nivel_imp")
                ->onDelete("cascade");
            $table->string("nm_meta",50);
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
