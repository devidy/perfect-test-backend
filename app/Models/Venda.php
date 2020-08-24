<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
     /**
     *
     * 
     * @var array
     */
    protected $fillable = ['produto_id', 'cliente_id', 'quantidade', 'status', 'desconto', 'total', 'data_venda', 'status'];

    protected $casts = [
        'data_venda' => 'datetime:d-m-Y H:00'
    ];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }

}
