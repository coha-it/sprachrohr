<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            // IDs
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('podcast_id')->unsigned();
            // $table->bigInteger('comment_id')->unsigned()->nullable();

            // Trigger
            $table->boolean('proved')->default(0);

            // Content
            $table->boolean('public_name')->default(1);
            $table->integer('seconds')->nullable(true);
            $table->text('text')->nullable(false);

            // Timestamps
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('comments', function (Blueprint $table) {
            // Connect User Foreign Key
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // Connect Podcast Foreign Key
            $table
                ->foreign('podcast_id')
                ->references('id')
                ->on('podcasts')
                ->onDelete('cascade');

            // Connect Comment Foreign Key
            // $table
            //     ->foreign('comment_id')
            //     ->references('id')
            //     ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
