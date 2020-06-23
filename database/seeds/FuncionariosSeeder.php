<?php

use App\Funcionarios;
use Illuminate\Database\Seeder;

class FuncionariosSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Funcionarios::class,20)->create()->each(function ($funcionario){
            $funcionario->save();
        });
    }
}
