<?php

namespace App\Http\Controllers;

use App\Models\Produto;

use App\Http\Resources\Produto as ProdutoResource;
use App\Http\Resources\ProdutoCollection;
use App\Http\Requests\ProdutoRequest;

use App\Http\Traits\ApiResponse;

class ProdutoController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::where('status', 1)->paginate(10);
        return new ProdutoCollection($produtos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        return $this->successfullyCreated(Produto::create($request->all()), 06);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        return $this->successfulResponse(new ProdutoResource($produto), 05, 'Sucesso');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request, Produto $produto)
    {
        $produto->update($request->all());
        return $this->successfulResponse($produto, 07, 'Atualizado');
    }
}
