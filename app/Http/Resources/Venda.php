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
            "produto_id" => $this->produto_id,
            "cliente_id" => $this->cliente_id,
            "quantidade" => $this->quantidade,
            "desconto" => $this->desconto,
            "status" => $this->status,
            "data_venda" => $this->created_ad
        ];  
    }
}
