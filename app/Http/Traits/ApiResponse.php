<?php

namespace App\Http\Traits;

use Symfony\Component\HttpFoundation\Response;


trait ApiResponse {

    /**
     * Mensagem de sucesso 201
     *
     * @return void
     */
    protected function successfullyCreated($data, $status)
    {
        return $this->getResponse(
            "Criado com sucesso",
            $status,
            Response::HTTP_CREATED,
            $data
        );
    }

    /**
     * Mensagem de sucesso 200
     *
     * @return void
     */
    protected function successfulResponse($data, $status, $message)
    {
        return $this->getResponse(
            $message,
            $status,
            Response::HTTP_OK,
            $data
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
    protected function getResponse($message, $code, $status, $data = null)
    {
        return response()->json([
            "success" => [
                    "status_http" => $status,
                    "code" => $code,
                    "message" => $message
                ],
                "data" => $data
        ], $status);
    }
}