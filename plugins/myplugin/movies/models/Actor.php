<?php namespace MyPlugin\Movies\Models;

use Model;

/**
 * Model
 */
class Actor extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'myplugin_movies_actors';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * Relations
     */

     public $belongsToMany = [
        'movies' => [
            'MyPlugin\Movies\Models\Movie',
            'table' => 'myplugin_movies_and_genres_relation', //Name of table between Movies and Actors
            'order' => 'name'
        ]
    ];
}
