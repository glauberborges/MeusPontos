<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Movimentacoes;
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

$factory->define(Movimentacoes::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'tipo_movimentacao' => $faker->randomElement($array = array ('entrada','saida')),
        'valor' => $faker->randomFloat(2, 1, 100 ),
        'observacao' => $faker->realText(100),
        'func_id' => $faker->numberBetween($min = 1, $max = 20),
        'user_id' => $faker->numberBetween($min = 1, $max = 2),
        'updated_at' => now(),
        'created_at' => now(),
    ];
});
