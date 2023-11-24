<?php

namespace App\Http\Requests;

use App\Traits\Helpers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class Request extends FormRequest
{
    use Helpers;

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'errors' => $validator->errors(),
                'success' => false,
                'alerts' => [
                    'status' => 'danger',
                    'title' => 'Erro !!!',
                    'icon' => 'ban'
                ],
                'message' => $this->message('MSG004')
            ])
        );
    }
}
