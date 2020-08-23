<?php

namespace App\Http\Services;

use App\Models\Cliente;

class ClienteService
{

    private $model;

	public function __construct(Cliente $model)
	{
		$this->model = $model;
	}
    public function store($dadosCliente)
    {
        return $this->model->create($dadosCliente);
    }
}