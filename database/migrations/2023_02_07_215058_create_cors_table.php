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
        Schema::create('cors', function (Blueprint $table) {
            $table->id();
            $table->string('cor');
            $table->integer('tamanho_id')->unsigned();
            $table->integer('produto_id')->unsigned();
            $table->timestamps();

            $table->foreign("produto_id")
                ->references("id")->on("produtos")
                ->onDelete("cascade");

            $table->foreign("tamanho_id")
                ->references("id")->on("tamanhos")
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
        Schema::dropIfExists('cors');
    }
};
