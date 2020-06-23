<?php

use App\Funcionarios;
use App\Movimentacoes;
use Illuminate\Database\Seeder;

class MovimentacoesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Movimentacoes::class,100)->create()->each(function ($movimentacoes){
            $movimentacoes->save();
        });
    }
}
