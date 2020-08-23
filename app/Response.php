<?php

namespace App;

use Exception;
use json_encode;

class Response
{


    public function returnSuccess(array $payload): void
    {
        $array = [
            'ok'      => true,
            'payload' => $payload,
        ];

        $this->json($array);
    }


    public function returnException(Exception $exception): void
    {
        $array = [
            'ok'      => false,
            'code'    => $exception->getCode(),
            'message' => $exception->getMessage(),
            'class'   => get_class($exception),
            'trace'   => $exception->getTrace(),
        ];

        $this->json($array);
    }


    private function json(array $array): void
    {
        $json = json_encode($array);

        header('Cache-Control: nocache, no-cache, no-store, max-age=0, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: Fri, 01 Jan 1990 00:00:00 GMT');
        header('Content-Type: application/json');
        echo $json;

        exit;
    }


}
