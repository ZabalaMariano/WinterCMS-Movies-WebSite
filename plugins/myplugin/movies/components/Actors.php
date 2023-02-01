<?php namespace MyPlugin\Movies\Components;

use Cms\Classes\ComponentBase;
use MyPlugin\Movies\Models\Actor;

use Lang;
use Cms\Classes\Page;
use Winter\Builder\Classes\ComponentHelper;
use SystemException;
use Exception;

class Actors extends ComponentBase
{

    /**
     * A collection of records to display
     */
    public $actors;

    public function componentDetails()
    {
        return [
            'name'        => 'Actores',
            'description' => 'Lista de actores'
        ];
    }

    public function defineProperties(){
        return [
            'results' => [
                'title' => 'Número de actores',
                'description' => '¿Cuántos actores quieres mostrar? (0 muestra todos)',
                'default' => 0, // 0 = all
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'Solo se permiten números'
            ],
            'sortOrder' => [
                'title' => 'Ordenar',
                'description' => 'Ordenar actores',
                'type' => 'dropdown',
                'default' => 'name asc'
            ]
        ];
    }

    // Property "sortOrder"
    public function getSortOrderOptions(){
        return [
            'name asc' => 'Nombre (ascendente)',
            'name desc' => 'Nombre (descendente)'
        ];
    }
 
    public function onRun(){
        $this->actors = $this->loadActors();
    }

    protected function loadActors(){
        $query = Actor::all();

        if($this->property('sortOrder') == 'name asc'){
            $query = $query->sortBy('name');
        } else if($this->property('sortOrder') == 'name desc'){
            $query = $query->sortByDesc('name');
        }

        if($this->property('results') > 0){
            $query = $query->take($this->property('results'));
        }

        return $query;
    }
}