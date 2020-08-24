<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Venda extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            "quantidade" => $this->quantidade,
            "desconto" => $this->desconto,
            "status" => $this->status,
            "total" => $this->total,
            "data_venda" => $this->data_venda->format('d-m-Y H:00'),
            "cliente" => $this->cliente,
            "produto" => $this->produto
        ];  
    }
}
