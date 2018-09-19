<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text(100),
        'price' => $faker->randomFloat(2,10,100),
        'user_id' => function(){
            return factory(User::class)->create();
        }
    ];
});
