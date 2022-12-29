<?php

use App\Http\Resources\PaginateResource;
use App\Http\Resources\PaginationResource;

function successResponse(string $message, array $data = null, int $statusCode = 200): \Illuminate\Http\JsonResponse
{
    return response()->json(
        array_filter([
            'success' => true,
            'message' => $message,
            'data' => $data
        ])
        , $statusCode);
}

function errorResponse(string $message = 'Something went wrong!', $errors = null, array $data = null, int $statusCode = 422): \Illuminate\Http\JsonResponse
{
    return response()->json(
        array_filter([
                'success' => false,
                'errors' => $errors,
                'message' => $message,
                'data' => $data
            ]
            , static function ($value){
                return $value!== null;
            }), $statusCode);
}
function paginateResponse($data, $resource_class_name,$variable_name='data' ,int $perPage = 20, int $statusCode = 200): \Illuminate\Http\JsonResponse
{
    return response()->json(
        array_filter([
                'success'=>true,
                $variable_name => new PaginationResource($data->paginate($perPage), $resource_class_name, $variable_name)
            ]
        ), $statusCode);
}


function resourceResponse($variable_name, $data, $resource_class_name, int $statusCode = 200): \Illuminate\Http\JsonResponse
{
    return response()->json(
        array_filter([
            'success' => true,
            decamelize($variable_name) =>new $resource_class_name($data)
        ])
        , $statusCode);
}

function successOneDataResponse(string $message, $variable_name, $data, int $statusCode = 200): \Illuminate\Http\JsonResponse
{
    return response()->json(
        array_filter([
            'success' => true,
            'message' => $message,
            $variable_name => $data
        ])
        , $statusCode);
}
