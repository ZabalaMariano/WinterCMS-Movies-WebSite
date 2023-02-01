<?php namespace MyPlugin\Movies\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateMypluginMoviesActors extends Migration
{
    public function up()
{
    Schema::table('myplugin_movies_actors', function($table)
    {
        $table->date('dob')->nullable();
        $table->dropColumn('lastname');
    });
}

public function down()
{
    Schema::table('myplugin_movies_actors', function($table)
    {
        $table->dropColumn('dob');
        $table->string('lastname', 255)->nullable();
    });
}
}
