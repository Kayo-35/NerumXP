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
        Schema::create("registro_fixo", function (Blueprint $table) {
            $table->id("cd_registro_fixo");
            $table
                ->foreignId("cd_usuario")
                ->references("cd_usuario")
                ->on("usuario")
                ->onDelete("cascade");
            $table
                ->foreignId("cd_tipo_registro")
                ->nullable()
                ->references("cd_tipo_registro")
                ->on("tipo_registro")
                ->onDelete("cascade");
            $table
                ->foreignId("cd_forma_pagamento")
                ->nullable()
                ->references("cd_tipo_forma")
                ->on("forma_pagamento")
                ->onDelete("cascade");
            $table
                ->foreignId("cd_nivel_imp")
                ->nullable()
                ->references("cd_nivel_imp")
                ->on("nivel_imp")
                ->onDelete("cascade");
            $table
                ->foreignId("cd_categoria")
                ->nullable()
                ->references("cd_categoria")
                ->on("categoria")
                ->onDelete("cascade");
            $table
                ->foreignId("cd_localizacao")
                ->nullable()
                ->references("cd_localizacao")
                ->on("localizacao")
                ->onDelete("cascade");
            $table
                ->foreignId("cd_realizador")
                ->nullable()
                ->references("cd_realizador")
                ->on("realizador_transacao")
                ->onDelete("cascade");

            $table->string("nm_registro", 50);
            $table->decimal("vl_valor", 9, 2);
            $table->boolean("ic_pago");
            $table->boolean("ic_status");
            $table->date("dt_pagamento")->nullable();
            $table->tinytext("ds_descricao")->nullable();

            $table->tinyInteger("qt_parcelas")->nullable();
            $table->tinyInteger("qt_parcelas_pagas")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("registro_fixo");
    }
};
