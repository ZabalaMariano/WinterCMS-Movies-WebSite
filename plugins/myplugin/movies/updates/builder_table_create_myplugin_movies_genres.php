<?php namespace MyPlugin\Movies\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateMypluginMoviesGenres extends Migration
{
    public function up()
{
    Schema::create('myplugin_movies_genres', function($table)
    {
        $table->engine = 'InnoDB';
        $table->increments('id')->unsigned();
        $table->string('genre_title');
        $table->string('slug');
    });
}

public function down()
{
    Schema::dropIfExists('myplugin_movies_genres');
}
}
