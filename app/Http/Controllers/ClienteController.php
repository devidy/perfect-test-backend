<?php

namespace App\Http\Controllers;

use App\Models\Cliente;

use App\Http\Resources\Cliente as ClienteResource;
use App\Http\Resources\ClienteCollection;
use App\Http\Services\ClienteService;
use App\Http\Requests\ClienteRequest;

use App\Http\Traits\ApiResponse;

class ClienteController extends Controller
{
    use ApiResponse;

    protected $service;

    public function __construct(ClienteService $service){
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::where('status', 1)->paginate(10);
        return new ClienteCollection($clientes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
        return $this->successfullyCreated(Cliente::create($request->all()), 06);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return $this->successfulResponse(new ClienteResource($cliente), 05, 'Sucesso');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request, Cliente $cliente)
    {
        $cliente->update($request->all());
        return $this->successfulResponse($cliente, 07, 'Atualizado');
    }
}
