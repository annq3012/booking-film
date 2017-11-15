<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('language');
            $table->string('director');
            $table->string('actor');
            $table->string('year');
            $table->string('duration');
            $table->string('image')->nullable();
            $table->string('release');
            $table->string('genre');
            $table->string('technologies');
            $table->string('rated');
            $table->string('link')->nullable();
            $table->tinyInteger('status');
            $table->string('slug')->unique();
            $table->softDeletes();
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
        Schema::dropIfExists('films');
    }
}
