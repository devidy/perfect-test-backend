<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    /**
     *
     * 
     * @var array
     */
    protected $fillable = ['nome', 'preco', 'descricao', 'status'];
}
