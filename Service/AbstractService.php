<?php

namespace BambooApiBundle\Service;

use Guzzle\Http\Client;

/**
 * Base class that contain common features that is needed by other classes.
 */
abstract class AbstractService
{
    /**
     *
     * @var Guzzle\Http\Client
     */
    protected $client;

    /**
     * Constructor.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Creates and returns a Bamboo REST API compatible URL.
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
     * Retrieve response from Bamboo in JSON encoding for the given API call.
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
