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
     * Relations
     */
    public $attachOne = [
        'poster' => 'System\Models\File'
    ];

    public $attachMany = [
        'movie_gallery' => 'System\Models\File'
    ];

    public $belongsToMany = [
        'genres' => [
            'MyPlugin\Movies\Models\Genre',
            'table' => 'myplugin_movies_and_genres_relation', //Name of table between Movies and Genres
            'order' => 'genre_title'
        ]
    ];
}
