<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AjusteProdutosFiliais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('filiais', function(Blueprint $table){
            $table->id();
            $table->string('filiais', 30);
            $table->timestamps();
       });

       Schema::create('produto_filiais', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('filial_id');
            $table->unsignedBigInteger('produto_id');
            $table->float('preco_venda', 8, 2)->default(0.01);
            $table->integer('estoque_maximo')->default(1);
            $table->integer('estoque_minimo')->default(1);
            $table->timestamps();

            $table->foreign('filial_id')->references('id')->on('filiais');
            $table->foreign('produto_id')->references('id')->on('produtos');
        });

        Schema::table('produto_filiais', function(Blueprint $table){
            $table->dropColumn('preco_venda', 'estoque_maximo', 'estoque_minimo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produto_filiais', function(Blueprint $table){
            $table->float('preco_venda', 8, 2)->default(0.01);
            $table->integer('estoque_maximo')->default(1);
            $table->integer('estoque_minimo')->default(1);
        });

        Schema::dropIfExists('produtos_filiais');

        Schema::dropIfExists('filiais');
    }
}
