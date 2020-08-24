<?php

namespace App\Controllers;

use App\Request;
use App\Services\HttpRequest;
use App\Services\HttpResponse;
use App\Services\JsonManager;

class Controller
{


    public static function sendHttpRequest(Request $request): array
    {
        $url           = $request->url;
        $httpHeaders   = $request->http_headers;
        $requestMethod = $request->request_method;

        $httpHeaders = (new JsonManager())->json_decode($request->http_headers, true);

        $httpRequest = (new HttpRequest())
            ->setUrl($url)
            ->setRequestMethod($requestMethod)
            ->setTimeout(3);

        foreach ($httpHeaders as $key => $value) {
            $httpRequest->addHttpHeader($key, $value);
        }

        /* @var $httpResponse HttpResponse */
        $httpResponse = $httpRequest->makeRequest();

        return [
            'function'              => __FUNCTION__,
            'request_method'        => $requestMethod,
            'url'                   => $url,
            'http_request_headers'  => $httpRequest->getHttpHeaders(),
            'http_response_headers' => $httpResponse->getHttpResponseHeaders(),
            'response'              => $httpResponse->getHttpResponseBody(),
            //'test160'    => '-' . chr(160) . '-',
        ];
    }


    public static function sendHttpRequestWithJsonParameters(Request $request): array
    {
        $params = (new JsonManager())->json_decode($request->q, true);

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
            'request_method'        => $requestMethod,
            'url'                   => $url,
            'http_request_headers'  => $httpRequest->getHttpHeaders(),
            'http_response_headers' => $httpResponse->getHttpResponseHeaders(),
            'response'              => $httpResponse->getHttpResponseBody(),
        ];
    }


    public static function getSendJson(Request $request): array
    {
        $params = (new JsonManager())->json_decode($request->q, true);

        $requestBody = file_get_contents('php://input');
        $requestBody = (new JsonManager())->json_decode($requestBody, true);

        $url           = $params['url'];
        $requestMethod = $params['request_method'];
        $httpHeaders   = $params['http_headers']; //array

        $httpRequest = (new HttpRequest())
            ->setUrl($url)
            ->setRequestMethod($requestMethod)
            ->addHttpHeaders($httpHeaders)
            ->setBody($requestBody)
            ->setTimeout(3);

        /* @var $httpResponse HttpResponse */
        $httpResponse = $httpRequest->makeRequest();

        $responseBody = $httpResponse->getHttpResponseBody();
        $responseBody = (new JsonManager())->json_decode($responseBody, true);

        return [
            'function'              => __FUNCTION__,
            'request_method'        => $requestMethod,
            'url'                   => $url,
            'http_request_headers'  => $httpRequest->getHttpHeaders(),
            'request_body'          => $requestBody,
            'http_response_headers' => $httpResponse->getHttpResponseHeaders(),
            'response_string'       => $httpResponse->getHttpResponseBody(),
            'response'              => $responseBody,
        ];
    }


}
