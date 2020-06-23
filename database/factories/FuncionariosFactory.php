<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Funcionarios;
use Faker\Generator as Faker;

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

$factory->define(Funcionarios::class, function (Faker $faker) {
    return [
        'nome_completo' => $faker->name,
        'login' => $faker->unique()->safeEmail,
        'senha' => $faker->md5,
        'saldo_atual' => $faker->randomFloat(2, 1, 100 ),
        'updated_at' => now(),
        'created_at' => now(),
        'user_id' => 1,
    ];
});
