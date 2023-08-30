<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servirs', function (Blueprint $table) {
            $table->id();
            $table->integer('table_id');
            $table->integer('order_group_id');
            $table->integer('serveur_id');
            $table->integer('shop_id');
            $table->tinyinteger('etat');
            $table->integer('status'); //1:servi 0: en attente
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
        Schema::dropIfExists('servirs');
    }
}
