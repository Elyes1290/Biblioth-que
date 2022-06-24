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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->date('birthdate');
            $table->text('address')->nullable();
            $table->string('zip');
            $table->string('city');
            $table->string('phone');
            $table->string('email');
            $table->timestamps();


            $table->string('country_id', 3)->index();
            $table->foreign('country_id')
            ->references('iso')
            ->on('countries')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
};
