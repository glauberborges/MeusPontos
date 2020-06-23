<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Funcionarios extends Authenticatable
{
    use Notifiable;

    protected $table = "funcionarios";

    protected $primaryKey = 'id';

    protected $guard = 'funcionarios';

    protected $fillable = [
        'nome_completo',
        'login',
        'senha',
        'saldo_atual',
    ];

    protected $hidden = [
        'user_id',
        'senha',
        'remember_token',
    ];

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacoes::class, 'func_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
