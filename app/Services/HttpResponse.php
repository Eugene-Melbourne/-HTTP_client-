<?php

namespace App\Services;

/**
 * @property array      $headers
 * @property string     $body
 */
class HttpResponse
{

    private $headers;
    private $body;


    public function setHttpResponseHeaders(array $httpResponseHeaders): self
    {
        $this->headers = $httpResponseHeaders;

        return $this;
    }


    public function setHttpResponseBody(string $responseBody): self
    {
        $this->body = $responseBody;

        return $this;
    }


    public function getHttpResponseHeaders(): ?array
    {
        return $this->headers;
    }


    public function getHttpResponseBody(): ?string
    {
        return $this->body;
    }


}
