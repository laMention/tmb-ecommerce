<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServeurOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serveur_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('serveur_id');
            $table->integer('order_id');
            $table->integer('shop_id');
            $table->integer('statut')->default(0); //0-en attente 1-servi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serveur_orders');
    }
}
