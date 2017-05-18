<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Requests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('host')->nullable();
            $table->string('query')->nullable();
            $table->string('ip')->nullable();
            $table->string('agent')->nullable();
            $table->string('referer')->nullable();
            $table->timestamps();
        });

        Schema::create('request_query', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id');
            $table->string('name')->nullable();
            $table->string('value')->nullable();
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
        Schema::drop('requests');
        Schema::drop('request_query');
    }
}
