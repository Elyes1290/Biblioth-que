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
        Schema::create('book_people', function (Blueprint $table) {

            $table->unsignedBigInteger('people_id');
            $table->foreign('people_id')
                    ->references('id')
                    ->on('people')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
    
    
            $table->string('book_isbn', 13)->index();
            $table->foreign('book_isbn')
                    ->references('isbn')
                    ->on('books')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
    
    
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
