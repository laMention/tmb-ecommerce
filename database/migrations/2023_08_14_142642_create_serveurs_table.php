<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serveurs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('shop_id');
            $table->string('name');
            $table->string('lastname');
            $table->string('adresse')->nullable();
            $table->string('contact');
            $table->string('code_poste')->nullable();
            $table->string('photo')->nullable();
            $table->tinyinteger('etat')->default(true);

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
        Schema::dropIfExists('serveurs');
    }
}
