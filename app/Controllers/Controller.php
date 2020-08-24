<?php

namespace App\Controllers;

use App\Exceptions\JsonDecodeException;
use App\Request;
use App\Services\HttpRequest;
use App\Services\HttpResponse;

class Controller
{


    public static function sendHttpRequest(Request $request): array
    {
        $url           = $request->url;
        $httpHeader    = $request->http_headers;
        $requestMethod = $request->request_method;

        $httpRequest = (new HttpRequest())
            ->setUrl($url)
            ->setRequestMethod($requestMethod)
            ->addHttpHeader($httpHeader)
            ->setTimeout(3);

        /* @var $httpResponse HttpResponse */
        $httpResponse = $httpRequest->makeRequest();

        return [
            'function'              => __FUNCTION__,
            'request_method'        => $request->request_method,
            'url'                   => $request->url,
            'http_request_headers'  => $httpRequest->getHttpHeaders(),
            'http_response_headers' => $httpResponse->getHttpResponseHeaders(),
            'response'              => $httpResponse->getHttpResponseBody(),
            //'test160'    => '-' . chr(160) . '-',
        ];
    }


    public static function sendHttpRequestWithJsonParameters(Request $request): array
    {
        $params = json_decode($request->q, true);
        if (is_null($params)) {

            throw new JsonDecodeException();
        }

        $url           = $params['url'];
        $requestMethod = $params['request_method'];
        $httpHeaders   = $params['http_headers']; //array

        $httpRequest = (new HttpRequest())
            ->setUrl($url)
            ->setRequestMethod($requestMethod)
            ->addHttpHeaders($httpHeaders)
            ->setTimeout(3);

        /* @var $httpResponse HttpResponse */
        $httpResponse = $httpRequest->makeRequest();

        return [
            'function'              => __FUNCTION__,
            'request_method'        => $request->request_method,
            'url'                   => $request->url,
            'http_request_headers'  => $httpRequest->getHttpHeaders(),
            'http_response_headers' => $httpResponse->getHttpResponseHeaders(),
            'response'              => $httpResponse->getHttpResponseBody(),
            //'test160'    => '-' . chr(160) . '-',
        ];
    }


    public static function getSendJson(Request $request): array
    {

        return ['data'];
    }


}
