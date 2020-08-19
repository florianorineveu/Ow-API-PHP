<?php

namespace OwAPI;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Response
 * @package OwAPI
 */
class Response
{
    private $body;
    private $rawResponse;
    private $request;
    private $status;
    private $success;

    /**
     * Response constructor.
     * @param ClientInterface $request
     * @param $response
     */
    public function __construct(ClientInterface $request, $response)
    {
        $this->request = $request;

        if ($response) {
            $this->body        = json_decode($response->getBody(), true, 512);
            $this->rawResponse = $response;
            $this->status      = $response->getStatusCode();
            $this->success     = floor($this->status / 100) == 2;
        }
    }

    /**
     * @return array|null
     */
    public function getBody(): ?array
    {
        return $this->body;
    }

    /**
     * @return ResponseInterface
     */
    public function getRawResponse(): ResponseInterface
    {
        return $this->rawResponse;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @return ClientInterface
     */
    public function getRequest(): ClientInterface
    {
        return $this->request;
    }
}
