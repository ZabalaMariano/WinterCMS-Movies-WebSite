<?php namespace MyPlugin\Movies\Models;

use Model;

/**
 * Model
 */
class Genre extends Model
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
    public $table = 'myplugin_movies_genres';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $belongsToMany = [
        'movies' => [
            'MyPlugin\Movies\Models\Movie',
            'table' => 'myplugin_movies_and_genres_relation', //Name of table between Movies and Genres
            'order' => 'name'
        ]
    ];
}
