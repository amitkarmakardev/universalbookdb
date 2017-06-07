<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('isbn10')->unique();
            $table->string('isbn13')->unique();
            $table->string('google_id')->unique();
            $table->string('oclc')->unique();

            $table->text('title');
            $table->text('author');
            $table->string('edition');
            $table->text('publisher');
            $table->string('page_length');
            $table->text('subjects');
            $table->string('price');
            $table->boolean('sample_present');
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
        Schema::dropIfExists('books');
    }
}