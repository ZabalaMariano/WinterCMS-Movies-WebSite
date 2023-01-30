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
}
