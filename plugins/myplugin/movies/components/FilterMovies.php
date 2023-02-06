<?php namespace MyPlugin\Movies\Components;

use Cms\Classes\ComponentBase;
use Input;
use MyPlugin\Movies\Models\Movie;
use MyPlugin\Movies\Models\Genre;

class FilterMovies extends ComponentBase
{
    public function componentDetails(){
        return [
            'name' => 'Filter Movies',
            'description' => 'Filter Movies'
        ];
    }

    public function onRun() {
        $this->movies = $this->filterMovies();
        $this->genres = Genre::all();
        $this->years = $this->filterYears();
    }

    public function filterYears() {
        // $query = Movie::all();
        // $years = [];

        // foreach($query as $movie){
        //     $years[] = $movie->year;
        // }

        // $years = array_unique($years);

        // return $years;
        
        $years = Movie::select('year')->groupBy('year')->orderBy('year')->pluck('year');
        // $years = Movie::orderBy('year', 'asc')->distinct()->pluck('year');
        return $years;
    }

    protected function filterMovies() {
        $year = Input::get('year');
        $genre = Input::get('genre');
        $query = Movie::all();

        if($year){
            $query = Movie::where('year', '=', $year)->get();
        }

        if($genre){
            $query = Movie::whereHas('genres', function($filter) use ($genre){
                $filter->where('slug', '=', $genre);
            })->get();
        }

        if($genre && $year){
            $query = Movie::whereHas('genres', function($filter) use ($genre){
                $filter->where('slug', '=', $genre);
            })->where('year', '=', $year)->get();
        }

        return $query;
    }

    public $movies;
    public $genres;
    public $years;
}