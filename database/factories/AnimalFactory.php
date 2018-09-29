<?php

use Faker\Generator as Faker;
use App\Manager;

$factory->define(App\Animal::class, function (Faker $faker) {
    $array = ['plesrunai' => 1, 'zoliaedziai' => 2, 'zuvys' => 3];
    $type = array_rand($array);
    $managersID = Manager::where('animals_type', $array[$type])->get();
    return [
        'birth_year' => $faker->unique()->date,
        'species' => $type,
        'animal_book' => $faker->paragraph,
        'type_id' => $array[$type],
        'manager_id' => $managersID->random(),
    ];
    unset($array);
    unset($type);
    unset($managersID);
    
});
