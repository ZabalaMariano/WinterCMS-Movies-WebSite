<?php namespace MyPlugin\Movies\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateMypluginMoviesAndGenresRelation extends Migration
{
    public function up()
{
    Schema::create('myplugin_movies_and_genres_relation', function($table)
    {
        $table->engine = 'InnoDB';
        $table->integer('movie_id');
        $table->integer('genre_id');
        $table->primary(['movie_id','genre_id']);
    });
}

public function down()
{
    Schema::dropIfExists('myplugin_movies_and_genres_relation');
}
}
