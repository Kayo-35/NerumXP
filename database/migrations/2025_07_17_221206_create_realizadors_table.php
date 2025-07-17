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
        Schema::create('realizador_transacao', function (Blueprint $table) {
            $table->id("cd_realizador");
            $table->string("nm_realizador",100);
            $table->tinyText("ds_realizador");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realizador_transacao');
    }
};
