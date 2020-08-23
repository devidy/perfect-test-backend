<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'nome' => 'required|max:255',
        ];
        if ($this->method() === 'POST') {
            $rules['email'] =  'required|unique:clientes';
            $rules['cpf'] = 'required|max:11|min:11|unique:clientes';
        } else {
            $clienteId = $this->cliente->id;
            $rules['email'] = 'required|unique:clientes,email,'  . $clienteId;
            $rules['cpf'] = 'required|max:11|min:11|unique:clientes,cpf,' . $clienteId;
        }
        return $rules;
    }
}
