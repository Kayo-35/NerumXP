<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('objetivos_metas', function (Blueprint $table) {
            $table->id("cd_objetivo_meta");
            $table
                ->foreignId("cd_meta")
                ->references("cd_meta")
                ->on("metas")
                ->onDelete("cascade");

            $table->boolean('ic_status');
            $table->string('ds_descricao', 255);
            $table
                ->date('dt_conclusao')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objetivos_metas');
    }
};
