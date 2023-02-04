<?php namespace MyPlugin\Movies\Models;

use Model;

/**
 * Model
 */
class Actor extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
    protected $fillable = ['name', 'dob', 'slug'];

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
        // Actor is related to many movies
        'movies' => [
            'MyPlugin\Movies\Models\Movie',
            'table' => 'myplugin_movies_and_actors_relation', //Name of table between Movies and Actors
            'order' => 'name'
        ],
        'movies_desc' => [
            'MyPlugin\Movies\Models\Movie',
            'table' => 'myplugin_movies_and_actors_relation', //Name of table between Movies and Actors
            'order' => 'name desc'
        ],
        'movies_this_year' => [
            'MyPlugin\Movies\Models\Movie',
            'table' => 'myplugin_movies_and_actors_relation', //Name of table between Movies and Actors
            'order' => 'name',
            'conditions' => 'year = YEAR(CURDATE())'
        ],        
    ];

    // Actor has one Profile-Picture
    public $attachOne = [
        'actorimage' => 'System\Models\File'
    ];
}
