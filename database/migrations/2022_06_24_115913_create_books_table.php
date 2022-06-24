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
        Schema::create('books', function (Blueprint $table) {
            
            $table->string('isbn', 13)->primary();
            $table->string('title');
            $table->year('year');
            $table->text('summary');
            $table->enum('etat', ['good', 'dirty']);
            $table->enum('statut', ['available', 'loan']);
            $table->timestamps();


            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
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
        Schema::dropIfExists('books');
    }
};
