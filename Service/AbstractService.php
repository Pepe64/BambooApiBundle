<?php

namespace BambooApiBundle\Service;

use Guzzle\Http\Client;
use Guzzle\Http\Exception\BadResponseException;

/**
 * Base class that contains common functionality for all services in the bundle.
 */
abstract class AbstractService
{
    /**
     * Constructor.
     *
     * @param \Guzzle\Http\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @var \Guzzle\Http\Client
     */
    protected $client;

    /**
     * Creates and returns a compatible URL.
     *
     * @param string $service
     * @param string $action
     * @param array  $params
     *
     * @return string
     */
    protected function createUrl($service, $action, array $params = array())
    {
        $url = sprintf('%s/%s', $service, $action);
        if (count($params)) {
            $url .= '?' . http_build_query($params);
        }

        return $url;
    }

    /**
     * Retrieve response from in JSON encoding for the given API call.
     *
     * @param string $url
     *
     * @return array
     */
    protected function getResponseAsArray($url)
    {
        $request = $this->client->get($url);

        $request->setHeader('Accept', 'application/json');

        $response = $request->send();

        return $response->json();
    }
}
