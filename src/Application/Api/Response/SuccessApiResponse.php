<?php


namespace App\Application\Api\Response;


class SuccessApiResponse extends ApiResponse
{
    public function __construct()
    {
        parent::__construct(200);
    }

    public function __toString(): string
    {
        $std=new \stdClass();
        $std->status=$this->statusCode;
        return json_encode($std);
    }
}