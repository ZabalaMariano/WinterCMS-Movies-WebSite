<?php 

use MyPlugin\Movies\Models\Actor;
use MyPlugin\Movies\Models\Movie;
use MyPlugin\Movies\Models\Genre;

Route::get('/seed-actors', function () {
    
    $faker = Faker\Factory::create();
    for($i = 0; $i < 100; $i++){

        $name = $faker->firstName;

        Actor::create([
            'name' => $name,
            'slug' => str_slug($name),
            'dob' => $faker->dateTime->format('Y-m-d'),
        ]);
    }

    return "Actors created!";

});

Route::get('/populate-movies', function(){
    
    $faker = Faker\Factory::create();

    for($i = 0; $i < 100; $i++){
        $name = $faker->sentence($nbWords = 3, $variableNbWords = true);

        Movie::create([
            'name' => $name,
            'slug' => str_slug($name, '-'),
            'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'year' => $faker->year($max = 'now'),
            'created_at' => $faker->date($format = 'Y-m-d H:i:s', $max = 'now'),
            'updated_at' => $faker->date($format = 'Y-m-d H:i:s', $max = 'now'),
        ]);
    }

    return "Movies created!";

});

Route::get('/add-genres-to-movies', function(){
    
    $faker = Faker\Factory::create();
    
    $movies = Movie::all();
    
    foreach ($movies as $movie) {
        $genres = Genre::all()->random(2);
        $movie->genres = $genres;
        $movie->save();
    }

    return "Genres added to movies!";

});

Route::get('sitemap.xml', function(){
    $movies = Movie::all();
    $genres = Genre::all();

    return Response::view('myplugin.movies::sitemap', ['movies' => $movies, 'genres' => $genres])->header('Content-Type', 'text/xml');

});
