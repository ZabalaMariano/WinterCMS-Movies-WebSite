<?php namespace MyPlugin\Movies\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateMypluginMoviesActors2 extends Migration
{
    public function up()
{
    Schema::table('myplugin_movies_actors', function($table)
    {
        $table->string('slug');
    });
}

public function down()
{
    Schema::table('myplugin_movies_actors', function($table)
    {
        $table->dropColumn('slug');
    });
}
}
