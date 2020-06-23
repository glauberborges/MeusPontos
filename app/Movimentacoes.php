<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimentacoes extends Model
{

    protected $table = "movimentacoes";

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'tipo_movimentacao',
        'valor',
        'observacao',
    ];

    protected $hidden = [
        'func_id',
        'user_id',
    ];

    protected $casts = [
        'id' => 'string'
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionarios::class, 'func_id');
    }
}
