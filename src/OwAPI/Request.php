<?php

namespace OwAPI;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\RequestOptions;

/**
 * Class Request
 * @package OwAPI
 */
class Request extends GuzzleClient
{
    private $url;
    private $type;

    /**
     * Request constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        parent::__construct([
            'base_uri' => 'https://' . Configuration::DOMAIN . '/' . Configuration::VERSION . '/',
            RequestOptions::HEADERS => [
                'User-Agent' => Configuration::USER_AGENT . phpversion() . '/' . Configuration::CLIENT_VERSION,
            ]
        ]);

        $this->type = 'application/json';
        $this->url  = $url;
    }

    /**
     * @param $call
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function call($call): Response
    {
        $response = null;

        if ($call) {
            try {
                $response = $this->get($this->url, [
                    'headers' => [
                        'content-type' => $this->type,
                    ]
                ]);
            } catch (ClientException $exception) {
                $response = $exception->getResponse();
            } catch (ServerException $exception) {
                $response = $exception->getResponse();
            }
        }

        return new Response($this, $response);
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
