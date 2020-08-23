<?php

namespace App\Controllers;

use App\Exceptions\HttpRequestFailedException;
use App\Request;

class Controller
{


    public static function sendHttpRequest(Request $request): array
    {


        $url           = $request->url;
        $httpHeaders   = $request->http_headers;
        $requestMethod = $request->request_method;

        $content  = [];
        $options  = [
            'http' => [
                'header'  => $httpHeaders,
                'method'  => $requestMethod,
                'content' => http_build_query($content),
                'timeout' => 3, //seconds
            ]
        ];
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context, 0);
        if ($response === false) {

            throw new HttpRequestFailedException();
        }

        /* @var $http_response_header array */

        return [
            'function'              => __FUNCTION__,
            'request_method'        => $request->request_method,
            'http_request_headers'  => $httpHeaders,
            'url'                   => $request->url,
            'http_response_headers' => $http_response_header,
            'response'              => $response,
            //'test160'    => '-' . chr(160) . '-',
        ];
    }


    public static function getSendJson(Request $request): array
    {

        return ['data'];
    }


}
