<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Produto;
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
    public function index(Request $request)
    {        
        if ($request->query()) {
            $queryParams = $request->query();
            
            if (array_key_exists("range_date", $request->query()) && array_key_exists("cliente_id", $request->query()) ) {
                $rangeDate = $queryParams['range_date'];
                $arrayDate = explode('-', $rangeDate);
                $from = new \DateTime($arrayDate[0]);
                $to = new \DateTime($arrayDate[1]);
                $vendas = Venda::where('cliente_id',$queryParams['cliente_id'])->whereBetween('data_venda', [$from->format('Y-d-m H:i:s'), $to->format('Y-d-m H:i:s')])->paginate(10);
            } else if (array_key_exists("range_date", $request->query())) {
                $rangeDate = $queryParams['range_date'];
                $arrayDate = explode('-', $rangeDate);
                $from = new \DateTime($arrayDate[0]);
                $to = new \DateTime($arrayDate[1]);
                $vendas = Venda::whereBetween('data_venda', [$from->format('Y-d-m H:i:s'), $to->format('Y-d-m H:i:s')])->paginate(10);
            } else {
                $vendas = Venda::where('cliente_id',$queryParams['cliente_id'])->paginate(10);
            }


        } else {
            $vendas = Venda::paginate(10);
        }

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
        $dadosVenda = $request->all();
        $produto = Produto::find($dadosVenda['produto_id']);
        $desconto = array_key_exists("desconto", $dadosVenda) ? $dadosVenda['desconto'] : 0;
        $dadosVenda['total'] = ($produto->preco * $dadosVenda['quantidade']) - $desconto;
        $dadosVenda['data_venda'] = new \DateTime($dadosVenda['data_venda']);
        return Venda::create($dadosVenda);
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
        $dadosVenda = $request->all();
        $dadosVenda['data_venda'] = new \DateTime($dadosVenda['data_venda']);
        $venda->update($dadosVenda);
        return [];
    }

        /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function getTotalVendasStatus()
    {
        $vendas = Venda::with('produto')->get();
        $totalCancelados = $vendas->where('status', 0)->count();
        $totalVendidos = $vendas->where('status', 1)->count();
        $totalDevolvidos = $vendas->where('status', 2)->count();

        $valorCancelados = $vendas->where('status', 0)->sum('total');
        $valorVendidos = $vendas->where('status', 1)->sum('total');
        $valorDevolvidos = $vendas->where('status', 2)->sum('total');

        $data = [
            'Cancelados' => [
                "Quantidade" => $totalCancelados,
                "Valor Total" => $valorCancelados
            ],
            'Vendidos' => [
                "Quantidade" => $totalVendidos,
                "Valor Total" => $valorVendidos
            ],
            'Devolvidos' => [
                "Quantidade" => $totalDevolvidos,
                "Valor Total" => $valorDevolvidos
            ]
        ];
        return response()->json($data, Response::HTTP_OK);
    }
}
