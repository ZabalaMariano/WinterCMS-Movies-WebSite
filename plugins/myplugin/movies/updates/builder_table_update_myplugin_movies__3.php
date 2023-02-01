<?php namespace MyPlugin\Movies\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateMypluginMovies3 extends Migration
{
    public function up()
{
    Schema::table('myplugin_movies_', function($table)
    {
        $table->renameColumn('actors', 'awards');
    });
}

public function down()
{
    Schema::table('myplugin_movies_', function($table)
    {
        $table->renameColumn('awards', 'actors');
    });
}
}
