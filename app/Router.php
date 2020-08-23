<?php

namespace App;

use App\Controllers\Controller;
use App\Exceptions\RouteNotFoundException;
use App\Request;

class Router
{

    CONST REQUEST_METHOD_GET  = 'GET';
    CONST REQUEST_METHOD_POST = 'POST';
    CONST KEY_REQUEST_METHOD  = 'REQUEST_TYPE';
    CONST KEY_ROUTE           = 'ROUTE';
    CONST KEY_CALLBACK        = 'CALLBACK';
    CONST ROUTES              = [
        [
            self::KEY_REQUEST_METHOD => self::REQUEST_METHOD_GET,
            self::KEY_ROUTE          => 'send_http_request',
            self::KEY_CALLBACK       => [Controller::class, 'sendHttpRequest'],
        ],
        [
            self::KEY_REQUEST_METHOD => self::REQUEST_METHOD_GET,
            self::KEY_ROUTE          => 'send_json',
            self::KEY_CALLBACK       => [Controller::class, 'getSendJson'],
        ],
    ];


    /**
     * @throws RouteNotFoundException
     */
    public function execute(): array
    {
        $url           = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $theRoute = parse_url($url, PHP_URL_PATH);
        $theRoute = trim($theRoute, '/');

        foreach (self::ROUTES as $key => $route) {
            if ($this->checkRoute($route, $theRoute, $requestMethod)) {
                $result = call_user_func($route[self::KEY_CALLBACK], $this->makeRequest());

                return $result;
            }
        }

        throw new RouteNotFoundException();
    }


    private function checkRoute(array $route, string $theRoute, string $requestMethod): bool
    {
        return $route[self::KEY_ROUTE] === $theRoute && $route[self::KEY_REQUEST_METHOD] === $requestMethod;
    }


    private function makeRequest()
    {
        return new Request();
    }


}
