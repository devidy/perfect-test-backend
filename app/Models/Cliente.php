<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    /**
     *
     * 
     * @var array
     */
    protected $fillable = ['nome', 'cpf', 'email'];

}
