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

    protected $fillable = ['name', 'slug', 'description', 'year', 'created_at', 'updated_at'];

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

    public static $allowedSortingOptions = array(
        'name desc' => 'Nombre descendiente',
        'name asc' => 'Nombre ascendiente',
        'year desc' => 'Año descendiente',
        'year asc' => 'Año ascendiente',
    );

    public function scopeListFrontEnd($query, $options = []){

        extract(array_merge([
            'page' => 1,
            'perPage' => 10,
            'sort' => 'created_at desc',
            'genres' => null,
            'year' => ''
        ], $options));

        if($year){
            $query->where('year', '=', $year);
        }

        if($genres !== null) {

            if(!is_array($genres)){
                $genres = [$genres];
            }

            foreach ($genres as $genre){
                $query->whereHas('genres', function($q) use ($genre){
                    $q->where('id', '=', $genre);
                });
            }

        }

        if(in_array($sort, array_keys(self::$allowedSortingOptions))){
            $parts = explode(' ', $sort);
            list($sortField, $sortDirection) = $parts;
            $query->orderBy($sortField, $sortDirection);
        }

        $lastPage = $query->paginate($perPage, $page)->lastpage();
        if($lastPage < $page){
            $page = 1;
        }

        return $query->paginate($perPage, $page);
    }
}
