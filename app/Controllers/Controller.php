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
        $params = json_decode($request->q, true);
        if (is_null($params)) {

            throw new JsonDecodeException('decoding params');
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
            'request_method'        => $requestMethod,
            'url'                   => $url,
            'http_request_headers'  => $httpRequest->getHttpHeaders(),
            'http_response_headers' => $httpResponse->getHttpResponseHeaders(),
            'response'              => $httpResponse->getHttpResponseBody(),
        ];
    }


    public static function getSendJson(Request $request): array
    {
        $params = json_decode($request->q, true);
        if (is_null($params)) {

            throw new JsonDecodeException('decoding params');
        }

        $requestBody = file_get_contents('php://input');
        $requestBody = json_decode($requestBody, true);
        if (is_null($requestBody)) {

            throw new JsonDecodeException('decoding body');
        }

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
        $responseBody = json_decode($responseBody, true);

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
