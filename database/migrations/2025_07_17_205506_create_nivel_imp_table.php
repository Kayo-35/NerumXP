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
        Schema::create("nivel_imp", function (Blueprint $table) {
            $table->id("cd_nivel_imp");
            $table->string("sg_nivel_imp", 20)->unique();
        });
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("nivel_imp");
    }
};
