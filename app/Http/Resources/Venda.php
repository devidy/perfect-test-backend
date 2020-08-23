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
            "data_venda" => $this->created_at,
            "cliente" => $this->cliente,
            "produto" => $this->produto
        ];  
    }
}
