<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

abstract class Controller
{
    public function queryExceptionResponse(QueryException $exception)
    {
        return Response::json([
            'message' => config('app.debug')
                ? $exception->getMessage()
                : 'Server gagal memproses permintaan'
        ], 500);
    }

    public function reponseError($message) : JsonResponse{
        return Response::json([
            'isModalClose' => false,
            'label' => 'Sorry!',
            'image' => '/assets/images/notification/high_priority-48.png',
            'type' => 'danger',
            'message' => $message,
            'time' => 3000
        ]);
    }

    public function reponseSuccess($message) : JsonResponse {
        return Response::json([
            'isModalClose' => true,
            'label' => 'Well Done!',
            'image' => '/assets/images/notification/ok-48.png',
            'type' => 'success',
            'message' => $message,
            'time' => 3000
        ]);
    }

    public function reponseInfo($message) : JsonResponse {
        return Response::json([
            'isModalClose' => true,
            'label' => 'Reminder!',
            'image' => '/assets/images/notification/survey-48.png',
            'type' => 'info',
            'message' => $message,
            'time' => 3000
        ]);
    }
    public function reponseWarning($message) : JsonResponse {
        return Response::json([
            'isModalClose' => true,
            'label' => 'Warning!',
            'image' => '/assets/images/notification/medium_priority-48.png',
            'type' => 'warning',
            'message' => $message,
            'time' => 3000
        ]);
    }

    public function responseRedirectError($message, $route, $params = []){
        return redirect()->route($route, $params)->with([
            'isModalClose' => false,
            'label' => 'Sorry!',
            'image' => '/assets/images/notification/high_priority-48.png',
            'type' => 'danger',
            'message' => $message,
            'time' => 3000
        ]);
    }

    public function responseRedirectBackError($message){
        return redirect()->back()->withInput()->with([
            'isModalClose' => false,
            'label' => 'Sorry!',
            'image' => '/assets/images/notification/high_priority-48.png',
            'type' => 'danger',
            'message' => $message,
            'time' => 3000
        ]);
    }

    public function responseRedirectBackSuccess($message){
        return redirect()->back()->with([
            'isModalClose' => true,
            'label' => 'Well Done!',
            'image' => '/assets/images/notification/ok-48.png',
            'type' => 'success',
            'message' => $message,
            'time' => 3000
        ]);
    }
    public function responseRedirectSuccess($message, $route, $params = []){
        return redirect()->route($route, $params)->with([
            'isModalClose' => true,
            'label' => 'Well Done!',
            'image' => '/assets/images/notification/ok-48.png',
            'type' => 'success',
            'message' => $message,
            'time' => 3000
        ]);
    }

    public function responseRedirectInfo($message, $route){
        return redirect()->route($route)->with([
            'isModalClose' => true,
            'label' => 'Reminder!',
            'image' => '/assets/images/notification/survey-48.png',
            'type' => 'info',
            'message' => $message,
            'time' => 3000
        ]);
    }
    public function responseRedirectWarning($message, $route){
        return redirect()->route($route)->with([
            'isModalClose' => true,
            'label' => 'Warning!',
            'image' => '/assets/images/notification/medium_priority-48.png',
            'type' => 'warning',
            'message' => $message,
            'time' => 3000
        ]);
    }
}
