<?php namespace MyPlugin\Movies\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateMypluginMovies extends Migration
{
    public function up()
{
    Schema::table('myplugin_movies_', function($table)
    {
        $table->string('slug');
    });
}

public function down()
{
    Schema::table('myplugin_movies_', function($table)
    {
        $table->dropColumn('slug');
    });
}
}
