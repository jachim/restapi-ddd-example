<?php
namespace App\Infrastructure\Symfony\Controller;

use App\Application\Api\ApiService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController
{

    private ApiService $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index(Request $request)
    {
        $apiMethod=$request->get("apiMethod");
        $parameters=$request->query->all();
        $apiResponse=$this->apiService->call($apiMethod, $parameters);
        return new Response($apiResponse);
    }
}