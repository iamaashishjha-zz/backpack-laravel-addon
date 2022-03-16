<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('title');
            $table->string('slug')->default('');
            $table->text('content');
            $table->string('image')->nullable();
            // $table->enum('status', ['PUBLISHED', 'DRAFT'])->default('PUBLISHED');
            $table->boolean('status')->default(FALSE);
            $table->date('date');
            $table->boolean('featured')->default(FALSE);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
