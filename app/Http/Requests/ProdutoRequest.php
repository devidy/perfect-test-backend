<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;


class ProdutoRequest extends FormRequest
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
        return [
            'nome' => 'required|max:255',
            'descricao' => 'required|max:255',
            'preco' => 'required|numeric|min:100'
        ];
    }
}
