<?php namespace MyPlugin\Movies\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateMypluginMoviesAndActorsRelation extends Migration
{
    public function up()
{
    Schema::create('myplugin_movies_and_actors_relation', function($table)
    {
        $table->engine = 'InnoDB';
        $table->integer('movie_id')->unsigned();
        $table->integer('actor_id')->unsigned();
        $table->primary(['movie_id','actor_id']);
    });
}

public function down()
{
    Schema::dropIfExists('myplugin_movies_and_actors_relation');
}
}
