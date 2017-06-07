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
            $table->string('isbn_10')->unique();
            $table->string('isbn_13')->unique()->nullable();
            $table->string('google_id')->unique()->nullable();
            $table->string('oclc')->unique()->nullable();

            $table->text('title')->nullable();
            $table->text('author')->nullable();
            $table->string('edition')->nullable();
            $table->text('publisher')->nullable();
            $table->text('published_date')->nullable();
            $table->string('page_length')->nullable();
            $table->text('subjects')->nullable();
            $table->string('price')->nullable();
            $table->boolean('sample_present')->nullable();
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