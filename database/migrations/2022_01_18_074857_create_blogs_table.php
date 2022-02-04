<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique()->nullable();
            $table->text('description');
            $table->text('content');
            $table->string('image')->nullable();
            $table->bigInteger('blog_category_id')->unsigned();
            $table->timestamps();
            $table->smallInteger('created_by')->nullable();
            $table->smallInteger('updated_by')->nullable();
            $table->smallInteger('user_id')->nullable();
            // $table->foreign('blog_category_id')->references('id')->on('blog_categories');
            // $table->foreign('blog_tag_id')->references('id')->on('blog_tags');
            // $table->foreign('created_by')->references('id')->on('users');
            // $table->foreign('updated_by')->references('id')->on('users');
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
