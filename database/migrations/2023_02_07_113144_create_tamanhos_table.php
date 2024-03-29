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
        Schema::create('tamanhos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tamanho');
            $table->integer('qtdTamanho');
            $table->integer('produto_id')->unsigned();
            $table->integer('cor_id')->unsigned();
            $table->timestamps();

            $table->foreign("produto_id")
                ->references("id")->on("produtos")
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
        Schema::dropIfExists('tamanhos');
    }
};
