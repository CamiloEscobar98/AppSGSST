<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $phones = ['300', '301', '310', '311', '312', '313', '314', '315', '316', '317', '318', '320'];
    $gender = (mt_rand(0, 1)  == 1) ? 'male' : 'female';
    $name = $faker->name($gender);
    $lastname = $faker->lastName;
    return [
        'name' => $name,
        'document_id' => function () {
            return factory(App\Models\Document::class)->create()->id;
        },
        'lastname' => $lastname,
        'birthday' => $faker->date('Y-m-d', 'now -18 years'),
        'phone' => $phones[mt_rand(0, sizeof($phones) - 1)] . strval($faker->unique()->randomNumber(7)),
        'email' => $faker->unique()->freeEmail,
        'password' => bcrypt('1234'),
    ];
});

$factory->define(App\Models\Document::class, function (Faker $faker) {
    return [
        'document' => $faker->randomNumber(9),
        'document_type_id' => 1
    ];
});
