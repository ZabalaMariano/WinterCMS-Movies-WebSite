<?php namespace MyPlugin\Movies\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateMypluginMoviesActors extends Migration
{
    public function up()
{
    Schema::create('myplugin_movies_actors', function($table)
    {
        $table->engine = 'InnoDB';
        $table->increments('id')->unsigned();
        $table->string('name')->nullable();
        $table->string('lastname')->nullable();
    });
}

public function down()
{
    Schema::dropIfExists('myplugin_movies_actors');
}
}
