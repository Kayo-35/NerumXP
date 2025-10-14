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
        Schema::create('tipo_metas', function (Blueprint $table) {
            $table->id('cd_tipo_meta');
            $table->foreignId('cd_tipo_registro')
                ->references('cd_tipo_registro')
                ->on("tipo_registro")
                ->onDelete("cascade");
            $table->string('nm_meta', 60);
            //Metas que limitam percentual 1, senão 0
            $table->boolean('ic_percentual');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_metas');
    }
};
