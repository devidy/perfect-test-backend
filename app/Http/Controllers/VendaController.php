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
                $arrayDates = $this->transformaData($queryParams['range_date']);
                $vendas = Venda::where('cliente_id',$queryParams['cliente_id'])->whereBetween('data_venda', [$arrayDates[0], $arrayDates[1]])->paginate(10);
            } else if (array_key_exists("range_date", $request->query())) {
                $arrayDates = $this->transformaData($queryParams['range_date']);
                $vendas = Venda::whereBetween('data_venda', [$arrayDates[0], $arrayDates[1]])->paginate(10);
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

    public function transformaData($rangeDate)
    {
        $arrayDates = explode('-', $rangeDate);
        $initialDateArray = explode('/', $arrayDates[0]);
        $finalDateArray = explode('/', $arrayDates[1]);
        $initialDate =  $initialDateArray[2] . $initialDateArray[1] . $initialDateArray[0];
        $finalDate =  $finalDateArray[2] . $finalDateArray[1] . $finalDateArray[0];

        $from = new \DateTime($initialDate);
        $to = new \DateTime($finalDate);
        return [$from->format('Y-m-d H:i:s'),$to->format('Y-m-d H:i:s')];
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
        $dadosVenda['status'] = $this->getStatusInNumber($dadosVenda['status']);
        return Venda::create($dadosVenda);
    }

    public function getStatusInNumber($statusString)
    {
        if($statusString === 'Cancelado') {
            return 0;
        } else if ($statusString === 'Aprovado') {
            return 1;
        } else {
            return 2;
        }
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
        $dadosVenda['status'] = $this->getStatusInNumber($dadosVenda['status']);
        $venda->update($dadosVenda);
        return [];
    }

        /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function getVendasAgrupadasPorStatus()
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
