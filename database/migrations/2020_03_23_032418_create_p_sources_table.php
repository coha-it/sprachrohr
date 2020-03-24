<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_sources', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->unique()->index();
            $table->bigInteger('podcast_id')->unsigned();

            $table->string('src', 2083);
            $table->string('type')->default('audio/mp3');
            $table->integer('prio')->default(0);

            $table->timestamps();
        });

        Schema::table('p_sources', function (Blueprint $table) {
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
        Schema::dropIfExists('p_sources');
    }
}
