<?php

namespace App;

use App\Controllers\Controller;
use App\Exceptions\RouteNotFoundException;

class Router
{

    CONST REQUEST_TYPE_GET      = 'GET';
    CONST REQUEST_TYPE_POST     = 'POST';
    CONST KEY_REQUEST_TYPE_TYPE = 'REQUEST_TYPE';
    CONST KEY_ROUTE             = 'ROUTE';
    CONST KEY_CALLBACK          = 'CALLBACK';
    CONST ROUTES                = [
        [
            self::KEY_REQUEST_TYPE_TYPE => self::REQUEST_TYPE_GET,
            self::KEY_ROUTE             => 'send_json',
            self::KEY_CALLBACK          => [Controller::class, 'getSendJson'],
        ],
    ];


    /**
     * @throws RouteNotFoundException
     */
    public function execute(): array
    {
        $url      = $_SERVER['REQUEST_URI'];
        $theRoute = parse_url($url, PHP_URL_PATH);
        $theRoute = trim($theRoute, '/');

        foreach (self::ROUTES as $key => $route) {
            if ($route[self::KEY_ROUTE] === $theRoute) {
                $request = null;
                $result  = call_user_func($route[self::KEY_CALLBACK], $request);

                return $result;
            }
        }

        throw new RouteNotFoundException();
    }


}
