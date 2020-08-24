<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class FormRequest extends \Illuminate\Foundation\Http\FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            $errors = (new ValidationException($validator))->errors();
            throw new HttpResponseException(
                response()->json([
                    'errors' => [
                        'status_http' => 422,
                        'code' => 8,
                        'message' => $errors
                        ]
                ], 422)
            );
        }

        parent::failedValidation($validator);
    }
}