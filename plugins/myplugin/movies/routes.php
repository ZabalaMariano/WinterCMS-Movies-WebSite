<?php 

use MyPlugin\Movies\Models\Actor;

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
