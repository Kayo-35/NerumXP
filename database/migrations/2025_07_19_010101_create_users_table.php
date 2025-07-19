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
        Schema::create('usuario', function (Blueprint $table) {
            $table->id("cd_usuario");
            $table->foreignId("cd_assinatura")
                ->references("cd_assinatura")
                ->on("assinatura")
                ->onDelete("cascade");

            $table->string("password",255);
            $table->string("email",255)
                ->unique();
            $table->timestamp("email_verified_at")->nullable();
            $table->rememberToken()->nullable();
            $table->string("nm_usuario",50);
            $table->date("dt_nascimento");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
