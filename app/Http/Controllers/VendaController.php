<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Http\Resources\VendaCollection;
use App\Http\Resources\Venda as VendaResource;
use App\Http\Requests\VendaRequest;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendas = Venda::paginate(10);
        return (new VendaCollection($vendas))
                    ->response()
                    ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendaRequest $request)
    {
        return Venda::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Venda $venda)
    {
        return new VendaResource($venda);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendaRequest $request, Venda $venda)
    {
        $venda->update($request->all());
        return [];
    }
}
