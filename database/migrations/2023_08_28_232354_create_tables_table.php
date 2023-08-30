<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->integer('num_table');
            $table->integer('nombre_chaise');
            $table->tinyinteger('etat');
            $table->integer('status'); // 1= Occupé - 0 =libre 2= place disponible
            $table->integer('nb_place_dispo'); // 1= Occupé - 0 =libre 2= place disponible
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
        Schema::dropIfExists('tables');
    }
}
