<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response;


class ProdutoCollection extends ResourceCollection
{
    public $collects = \App\Http\Resources\Produto::class;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'success' => [
                "status_http" => Response::HTTP_OK,
                "code" => 05,
                "message" => 'Sucesso',
            ],
            'total' => count($this->collection),
            'data' => $this->collection
        ];
    }
}
