<?php

namespace App\Services;

use App\Exceptions\HttpRequestFailedException;
use ErrorException;

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
    private $body;


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


    public function addHttpHeaders(array $headers): self
    {
        $this->headers = array_merge($this->headers, $headers);

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


    public function setBody(array $body = null): self
    {
        $this->body = $body;

        return $this;
    }


    public function makeRequest(): HttpResponse
    {
        $glue        = "\r\n";
        $httpHeaders = implode($glue, $this->headers);


        $content = http_build_query($this->body ?? []);

        $options = [
            'http' => [
                'method'  => $this->requestMethod,
                'header'  => $httpHeaders,
                'content' => $content,
                'timeout' => $this->timeout, //seconds
            ]
        ];
        $context = stream_context_create($options);
        try {
            $response = file_get_contents($this->url, false, $context, 0);
        } catch (ErrorException $ex) {

            throw new HttpRequestFailedException($ex->getMessage(), $ex->getCode(), $ex->getPrevious());
        }
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
