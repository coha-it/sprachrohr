<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_tags', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->unique()->index();
            $table->bigInteger('podcast_id')->unsigned();
            $table->string('name')->unique();
        });

        Schema::table('p_tags', function (Blueprint $table) {
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
        Schema::dropIfExists('p_tags');
    }
}
