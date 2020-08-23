<?php

namespace App\Services;

use App\Exceptions\HttpRequestFailedException;

/**
 * @property string         $url
 * @property array          $headers
 * @property string         $requestMethod
 * @property int            $timeout                in seconds
 */
class HttpRequest
{

    private $url;
    private $headers = [];
    private $requestMethod;
    private $timeout;


    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }


    public function setRequestMethod(string $requestMethod): self
    {
        $this->requestMethod = $requestMethod;

        return $this;
    }


    public function addHttpHeader(string $header): self
    {
        $this->headers[] = $header;

        return $this;
    }


    public function setTimeout(int $seconds)
    {
        $this->timeout = $seconds;

        return $this;
    }


    public function getHttpHeaders(): array
    {
        return $this->headers;
    }


    public function makeRequest(): HttpResponse
    {
        $glue        = "\r\n";
        $httpHeaders = implode($glue, $this->headers);

        $content  = [];
        $options  = [
            'http' => [
                'method'  => $this->requestMethod,
                'header'  => $httpHeaders,
                'content' => http_build_query($content),
                'timeout' => $this->timeout, //seconds
            ]
        ];
        $context  = stream_context_create($options);
        $response = file_get_contents($this->url, false, $context, 0);
        if ($response === false) {

            throw new HttpRequestFailedException();
        }

        /* @var $http_response_header array */

        $httpResponse = (new HttpResponse())
            ->setHttpResponseHeaders($http_response_header)
            ->setHttpResponseBody($response);

        return $httpResponse;
    }


}