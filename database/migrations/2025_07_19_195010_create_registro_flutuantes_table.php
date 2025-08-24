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
        Schema::create("registro_flutuante", function (Blueprint $table) {
            $table->id("cd_registro_flutuante");
            $table->timestamps();
            $table
                ->foreignId("cd_usuario")
                ->references("cd_usuario")
                ->on("usuario")
                ->onDelete("cascade");
            $table
                ->foreignId("cd_forma_pagamento")
                ->references("cd_tipo_forma")
                ->on("forma_pagamento")
                ->onDelete("cascade");
            $table
                ->foreignId("cd_tipo_registro")
                ->references("cd_tipo_registro")
                ->on("tipo_registro")
                ->onDelete("cascade");
            $table
                ->foreignId("cd_tipo_juro")
                ->nullable()
                ->references("cd_tipo_juro")
                ->on("registro_tipo_juros")
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
            $table->decimal("vl_valor_registro", 9, 2);
            $table->boolean("ic_pago");
            $table->boolean("ic_status");
            $table->decimal("pc_taxa_juros", 6, 3);
            $table->tinyInteger("qt_parcelas")->nullable();
            $table->tinyInteger("qt_parcelas_pagas")->nullable();
            $table->date("dt_pagamento")->nullable();
            $table->date("dt_vencimento")->nullable();
            $table->tinytext("ds_descricao");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("registro_flutuante");
    }
};
