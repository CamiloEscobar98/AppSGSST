<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Topic::class, function (Faker $faker) {
    $user = \App\Models\Role::find(2)->users()->get()->random(1)->first();
    return [
        'user_id' => $user->id,
        'title' => $faker->unique()->sentence(5, true),
        'info' => $faker->unique()->paragraph(6, true)
    ];
});
