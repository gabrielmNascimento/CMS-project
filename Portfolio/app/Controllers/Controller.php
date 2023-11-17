<?php

namespace App\Http\Controllers;

use App\Traits\Helpers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Helpers;

    public function success($message)
    {
        return response()->json([
            'success' => true,
            'alerts' => [
                'status' => 'success',
                'title' => 'Sucesso!!!',
                'icon' => 'check'
            ],
            'message' => $this->message($message)
        ]);
    }

    public function error($message, $errors = [])
    {
        $response = [
            'success' => false,
            'alerts' => [
                'status' => 'danger',
                'title' => 'Erro !!!',
                'icon' => 'ban'
            ],
            'message' => $this->message($message)
        ];

        if(count($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response);
    }

    public function info($message)
    {
        return response()->json([
            'success' => true,
            'alerts' => [
                'status' => 'info',
                'title' => 'Informação',
                'icon' => 'info-circle'
            ],
            'message' => $message
        ]);
    }
}
