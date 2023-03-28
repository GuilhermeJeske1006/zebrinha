<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->string("logradouro")->nullable();;
            $table->string("numero")->nullable();;
            $table->string("cidade");
            $table->string("bairro");
            $table->string("estado");
            $table->string("cep");
            $table->string("complemento")->nullable();;
            $table->integer("usuario_id")->unsigned();
            $table->timestamps();

            $table->foreign("usuario_id")
                ->references("id")->on("users")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enderecos');
    }
};
