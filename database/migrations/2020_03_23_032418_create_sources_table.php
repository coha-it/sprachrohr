<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('podcast_id')->unsigned();

            $table->string('src', 2083);
            $table->string('type')->default('audio/mp3');
            $table->integer('prio')->default(0);

            $table->timestamps();
        });

        Schema::table('sources', function (Blueprint $table) {
            // Connect Foreign Key
            $table
                ->foreign('podcast_id')
                ->references('id')
                ->on('podcasts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sources');
    }
}
