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
    protected $fillable = ['produto_id', 'cliente_id', 'quantidade', 'status', 'desconto'];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:00'
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
