<?php

namespace App\Http\Controllers;

use App\Http\Requests\CableRequest;
use App\Models\Cable;
use App\Models\Interior;
use Illuminate\Http\Request;

/** 
 * Classe controller para gerenciamento de cable.
 */

class CableController extends Controller
{
    /**
     * Instância do model Cable
     *
     * @var cable
     * @var interior
     */
    private $cable, $interior;

    /**
     * @param Cable $cable
     * @param Interior $interior
     */
    public function __construct(Cable $cable, Interior $interior)
    {
        $this->cable = $cable;
        $this->interior = $interior;
    }

    /**
     * Listagem
     * 
     * Retorna os cables cadastrados, de acordo com os filtros selecionados.
     * 
     * @group cables
     * 
     * @bodyParam interior_id integer Filtro por interior. Example: 1
     * @bodyParam per_page integer Máximo de cables exibidos por página. Example: 30
     * @bodyParam column string Coluna a ser utilizada para ordenação. Example: ordos
     * @bodyParam direction string Sentido da ordenação. Example: asc
     * 
     * @authenticated
     * 
     * @response scenario=success {
     *  "cables": {
     *      "current_page": 1,
     *      "data": [
     *          {
     *              "id": 1,
     *              "interior_id": 1,
     *              "ordos": 1,
     *              "enhanceds": ["enhanceds vinculadas"],
     *              "enhanceds_list": ["IDs das enhanceds vinculadas"],
     *              "inherents": ["inherents vinculadas"],
     *              "inherents_list": ["IDs das inherents vinculadas"],
     *              "equips": ["equips vinculados"],
     *              "equips_list": ["IDs dos equips vinculados"],
     *              "toppo_cable": 1,
     *              "created_at": "timestamp",
     *              "updated_at": "timestamp"
     *          }
     *      ],
     *      "first_page_url": "URL da primeira página",
     *      "from": 1,
     *      "last_page": 1,
     *      "last_page_url": "URL da última página",
     *      "links": ["URLs para paginação"],
     *      "next_page_url": "URL da página seguinte",
     *      "path": "Caminho do endpoint atual",
     *      "per_page": 30,
     *      "prev_page_url": "URL da página anterior",
     *      "to": 1,
     *      "total": 1,
     *  },
     *  "params": {
     *      "total": 1,
     *      "per_page": 30,
     *      "current_page": 1,
     *      "last_page": 1,
     *      "next_page_url": "URL da página seguinte",
     *      "prev_page_url": "URL da página anterior",
     *      "direction": "asc",
     *      "column": "ordos"
     *  },
     *  "filters": {
     *      "interior_id": ""
     *  }
     * }
     */
    public function index(Request $request)
    {
        $interior_id = '';
        $column = 'ordos';
        $direction = 'desc';
        $per_page = 30;

        if($request->has('per_page')) {
            $per_page = $request->input('per_page');
        }

        if($request->has('direction')) {
            $direction = $request->input('direction');
        }

        if($request->has('column')) {
            $column = $request->input('column');
        }

        if($column != 'undefined')
        {
            $cables = $this->cable->orderBy($column, $direction);
        }else{
            $cables = $this->cable;
        }
        

        if($request->has('interior_id')) {
            $cables = $cables->where('interior_id', '=', $request->input('interior_id'));
            $interior_id = $request->input('interior_id');
        }

        $cables = $cables->paginate($per_page);

        $response = [
            'cables' => $cables,
            'params' => [
                'total' => $cables->total(),
                'per_page' => $cables->perPage(),
                'current_page' => $cables->currentPage(),
                'last_page' => $cables->lastPage(),
                'next_page_url' => $cables->nextPageUrl(),
                'prev_page_url' => $cables->previousPageUrl(),
                'direction' => $direction,
                'column' => $column
            ],
            'filters' => [
                'interior_id' => $interior_id
            ]
        ];

        return response()->json($response);
    }

    /**
     * Criação
     * 
     * Insere um novo cable na base de dados.
     * 
     * @group cables
     * 
     * @bodyParam ordos integer required ordos do cable no poste. Example: 1
     * @bodyParam toppo_cable integer required toppo do cable. Aceita somente os valores '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '999'
     * @bodyParam interior_id integer required ID da interior passada através da URL. Example: 1
     * @bodyParam enhanceds_list array required Lista de enhanceds vinculadas ao cable. A lista de enhanceds deve ser obtida atráves da api/enhanceds/listing/{elevator_id?} Example: ["1", "2"]
     * @bodyParam inherents_list array required Lista de inherents vinculadas ao cable. A lista de inherents deve ser obtida atráves da api/inherents/listing/{elevator_id?} Example: ["1", "2"]
     * @bodyParam equips_list array required Lista de equips vinculados ao cable. A lista de equips deve ser obtida atráves da api/equips/listing Example: ["1", "2"]
     *
     * @authenticated
     * 
     * @response scenario=success {
     *  "success": true,
     *  "alerts": {
     *      "status": "success",
     *      "title": "Sucesso!!!",
     *      "icon": "check"
     *  },
     *  "message": "O registro foi salvo com sucesso!"
     * }
     * 
     * @response scenario=error {
     *  "errors": {
     *      "ordos": ["O campo ordos é obrigatório."],
     *      "toppo_cable": ["O campo toppo cable é obrigatório."],
     *      "interior_id": ["O campo interior id é obrigatório."],
     *      "enhanceds_list": ["O campo enhanceds list é obrigatório."]
     *  },
     *  "success": false,
     *  "alerts": {
     *      "status": "danger",
     *      "title": "Erro !!!",
     *      "icon": "ban"
     *  },
     *  "message": "O registro não pode ser salvo!!! Verifique os erros e tente novamente."
     * }
     */
    public function store(cableRequest $request)
    {
        $input = $request->all();

        $interior = $this->interior->find($input['interior_id']);

        if(!$interior) {
            return $this->error('MSG012');
        }

        $input['usuario_id'] = auth()->user()->id;
        $cable = $this->cable->create($input);
        $this->syncRelationship($cable, 'enhanceds', $request->input('enhanceds_list'));
        $this->syncRelationship($cable, 'inherents', $request->input('inherents_list'));
        $this->syncRelationship($cable, 'equips', $request->input('equips_list'));

        return $this->success('MSG001');
    }

    /**
     * Detalhes
     * 
     * Exibe os detalhes de um cable.
     * 
     * @group cables
     * 
     * @urlParam cable required ID do cable.
     * 
     * @authenticated
     * 
     * @response scenario=success {
     *  "id": 1,
     *  "interior_id": 1,
     *  "ordos": 1,
     *  "enhanceds": ["enhanceds vinculadas"],
     *  "enhanceds_list": ["IDs das enhanceds vinculadas"],
     *  "inherents": ["inherents vinculadas"],
     *  "inherents_list": ["IDs das inherents vinculadas"],
     *  "equips": ["equips vinculados"],
     *  "equips_list": ["IDs dos equips vinculados"],
     *  "toppo_cable": 1,
     *  "created_at": "timestamp",
     *  "updated_at": "timestamp"
     * }
     * 
     * @response scenario=error {
     *  "success": false,
     *  "alerts": {
     *      "status": "danger",
     *      "title": "Erro !!!",
     *      "icon": "ban"
     *  },
     *  "message": "O registro não foi encontrado!!!"
     * }
     * 
     */
    public function show($id)
    {
        $cable = $this->cable->find($id);

        if($cable)
            return response()->json($cable);

        return $this->error('MSG009');
    }

    /**
     * Atualização
     * 
     * Atualiza as informações de um cable.
     * 
     * @group cables
     * 
     * @bodyParam ordos integer required ordos do cable no poste. Example: 1
     * @bodyParam toppo_cable integer required toppo do cable. Aceita somente os valores '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '999'
     * @bodyParam interior_id integer required ID da interior passada através da URL. Example: 1
     * @bodyParam enhanceds_list array required Lista de enhanceds vinculadas ao cable. A lista de enhanceds deve ser obtida atráves da api/enhanceds/listing/{elevator_id?} Example: ["1", "2"]
     * @bodyParam inherents_list array required Lista de inherents vinculadas ao cable. A lista de inherents deve ser obtida atráves da api/inherents/listing/{elevator_id?} Example: ["1", "2"]
     * @bodyParam equips_list array required Lista de equips vinculados ao cable. A lista de equips deve ser obtida atráves da api/equips/listing Example: ["1", "2"]
     * 
     * @authenticated
     * 
     * @response scenario=success {
     *  "success": true,
     *  "alerts": {
     *      "status": "success",
     *      "title": "Sucesso!!!",
     *      "icon": "check"
     *  },
     *  "message": "O registro foi atualizado com sucesso!"
     * }
     * 
     * @response scenario=error {
     *  "errors": {
     *      "ordos": ["O campo ordos é obrigatório."],
     *      "toppo_cable": ["O campo toppo cable é obrigatório."],
     *      "interior_id": ["O campo interior id é obrigatório."],
     *      "enhanceds_list": ["O campo enhanceds list é obrigatório."]
     *  },
     *  "success": false,
     *  "alerts": {
     *      "status": "danger",
     *      "title": "Erro !!!",
     *      "icon": "ban"
     *  },
     *  "message": "O registro não pode ser salvo!!! Verifique os erros e tente novamente."
     * }
     * 
     */
    public function update(cableRequest $request, $id)
    {
        $input = $request->all();
        $cable = $this->cable->find($id);

        if(!$cable) {
            return $this->error('MSG009');
        }

        $interior = $this->interior->find($input['interior_id']);

        if(!$interior) {
            return $this->error('MSG012');
        }

        $cable->update($input);
        $cable->enhanceds()->sync($request->input('enhanceds_list'));
        $cable->inherents()->sync($request->input('inherents_list'));
        $cable->equips()->sync($request->input('equips_list'));
        return $this->success('MSG002');
    }

    /**
     * Exclusão
     * 
     * Exclui um cable.
     * 
     * @group cables
     * 
     * @urlParam id required ID do cable
     * 
     * @authenticated
     * 
     * @response scenario=success {
     *  "success": true,
     *  "alerts": {
     *      "status": "success",
     *      "title": "Sucesso!!!",
     *      "icon": "check"
     *  },
     *  "message": "O registro foi apagado com sucesso!"
     * }
     * 
     * @response scenario=error {
     *  "success": false,
     *  "alerts": {
     *      "status": "danger",
     *      "title": "Erro !!!",
     *      "icon": "ban"
     *  },
     *  "message": "Descrição do erro"
     * }
     * 
     */
    public function destroy($id)
    {
        try {
            $cable = $this->cable->find($id);
            
            if(!$cable)
                return $this->error('MSG009');
            
            $cable->delete();

            return $this->success('MSG003');
        } catch(\Exception $e) {
            return $this->error('MSG005');
        } 
    }
}
