<?php

namespace App\Http\Requests;

/**
 * Classe Request para requisições no endpoint /cabos
 */

class CableRequest extends Request
{
    /**
     * Determina se o usuário está autorizado a fazer a requisição.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Retorna as regras de validação que se aplicam ao request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ordem'                 => 'required|integer',
            'turles_cable'             => 'required|integer',
            'not_island'      => 'nullable|boolean',
            'deducao'               => 'nullable|min:3|max:100',
            'identificacao'         => 'nullable|min:3|max:100',
            'interior_id'           => 'required|integer',
            'enhanceds_list'         => 'required|array',
            'inherents_list'  => 'nullable|array',
            'eross_list'  => 'nullable|array'
        ];
    }
}
