<?php namespace MyPlugin\Movies\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateMypluginMovies2 extends Migration
{
    public function up()
{
    Schema::table('myplugin_movies_', function($table)
    {
        $table->text('actors')->nullable();
    });
}

public function down()
{
    Schema::table('myplugin_movies_', function($table)
    {
        $table->dropColumn('actors');
    });
}
}
