<?php

namespace App\Services;

use App\Exceptions\HttpRequestFailedException;
use App\Services\JsonManager;
use ErrorException;

/**
 * @property string         $url
 * @property array          $headers
 * @property array          $body
 * @property string         $requestMethod
 * @property int            $timeout                in seconds
 */
class HttpRequest
{

    private $url;
    private $requestMethod;
    private $timeout;
    private $headers = [];
    private $body    = [];


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


    public function addHttpHeader(string $key, string $value): self
    {
        $this->headers[$key] = $value;

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
        $this->body = $body ?? [];

        return $this;
    }


    private function getAllHeadersAsString(): string
    {
        $headers = [];
        foreach ($this->headers as $key => $value) {
            $headers[] = $key . ': ' . $value;
        }
        $glue        = "\r\n";
        $httpHeaders = implode($glue, $headers);

        return $httpHeaders;
    }


    public function makeRequest(): HttpResponse
    {
        $content     = null;
        $contentType = $this->headers["Content-type"] ?? null;
        $contentType = trim(explode(';', $contentType)[0]); // for text/html; charset=ISO-8859-1

        if ($contentType === "application/json") {
            $content = (new JsonManager())->json_encode($this->body);
        }
        if ($contentType === "application/x-www-form-urlencoded") {
            $content = http_build_query($this->body);
        }

        //$this->headers['Host']           = parse_url($this->url, PHP_URL_HOST);
        $this->headers['Content-Length'] = strlen($content);

        $options = [
            'http' => [
                'method'  => $this->requestMethod,
                'header'  => $this->getAllHeadersAsString(),
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
