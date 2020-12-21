<?php
namespace App\Infrastructure\Symfony\Controller;

use App\Application\Api\ApiService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController
{

    private ApiService $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * @Route("/api/{apiMethod}", methods={"POST"}, requirements={"apiMethod"="[a-z/]+"})
     */
    public function index(Request $request)
    {
        $apiMethod=$request->get("apiMethod");
        $parameters=$request->request->all();
        $apiResponse=$this->apiService->call($apiMethod, $parameters);
        return new Response($apiResponse);
    }
}