<?php
namespace App\Infrastructure\Symfony\Controller;

use Symfony\Component\HttpFoundation\Response;

class ApiController
{
    public function index()
    {
        return new Response("test");
    }
}