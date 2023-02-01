<?php namespace MyPlugin\Movies\Models;

use Model;

/**
 * Model
 */
class Movie extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
    use \Winter\Storm\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'myplugin_movies_';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * Jsonable for Repeaters in Model's Form.
     */
    protected $jsonable = ['awards'];

    /**
     * Relations
     */

    // Movie has one Poster
    public $attachOne = [
        'poster' => 'System\Models\File'
    ];

    // Movie has many images
    public $attachMany = [
        'movie_gallery' => 'System\Models\File'
    ];

    public $belongsToMany = [
        // Movie is related to many genres
        'genres' => [
            'MyPlugin\Movies\Models\Genre',
            'table' => 'myplugin_movies_and_genres_relation', //Name of table between Movies and Genres
            'order' => 'genre_title'
        ],
        // Movie is related to many actors
        'actors' => [
            'MyPlugin\Movies\Models\Actor',
            'table' => 'myplugin_movies_and_actors_relation', //Name of table between Movies and Actors
            'order' => 'name'
        ]
    ];
}
