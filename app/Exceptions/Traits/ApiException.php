<?php

namespace App\Exceptions\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Validation\ValidationException;


trait ApiException {

    /**
     * Trata as exceções da API
     *
     * @param [type] $request
     * @param [type] $e
     * @return void
     */
    protected function getJsonException($request, $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return $this->notFoundException();
        }

        if ($e instanceof HttpException) {
            return $this->httpException($e);
        }


        if ($e instanceof ValidationException) {
            return $this->validationException($e);
        }

        return $this->genericException();
    }

    /**
     * Retorna o erro 404
     *
     * @return void
     */
    protected function notFoundException()
    {
        return $this->getResponse(
            "Recurso não encontrado",
            "01",
            404
        );
    }

    /**
     * Retorna o erro 500
     *
     * @return void
     */
    protected function genericException()
    {
        return $this->getResponse(
            "Erro interno no servidor",
            "02",
            500
        );
    }

    /**
     * Retornar o erro de validação
     *
     * @return void
     */
    protected function validationException($e)
    {
        return response()->json($e->errors(), $e->status);
    }
    
    /**
     * Retorna o erro de http
     *
     * @return void
     */
    protected function httpException($e)
    { 
      return $this->getResponse(
        'Verbo Http não é permitido',
        '03',
        $e->getStatusCode()
      );
    }

    /**
     * Monta a resposta em json
     *
     * @param [type] $message
     * @param [type] $code
     * @param [type] $status
     * @return void
     */
    protected function getResponse($message, $code, $status)
    {
        return response()->json([
            "errors" => [
                [
                    "status" => $status,
                    "code" => $code,
                    "message" => $message
                ]
            ]
        ], $status);
    }
}