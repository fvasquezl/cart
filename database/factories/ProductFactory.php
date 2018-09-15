<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->firstName,
        'price' => $faker->lastName,
        'user_id' => function(){
            return factory(User::class)->create();
        }
    ];
});
