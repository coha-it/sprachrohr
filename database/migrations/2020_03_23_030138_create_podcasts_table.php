<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePodcastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('podcasts', function (Blueprint $table) {
            // Podcasts
            $table->id();

            // Fields
            $table->enum('type', ['audio', 'text'])->default('audio');
            $table->string('title');
            $table->text('desc_short')->nullable(true);
            $table->text('desc_long');
            $table->string('img_url', 2083)->nullable(true);
            $table->dateTime('post_date')->nullable(true);
            $table->integer('duration')->nullable(true);
            $table->string('author_title')->nullable();

            // Timestampes
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('podcasts');
    }
}
