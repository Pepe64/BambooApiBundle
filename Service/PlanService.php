<?php

namespace BambooApiBundle\Service;

use Guzzle\Http\Client;

/**
 * Service class for retrieving build plans from Bamboo.
 */
class PlanService extends AbstractService
{
    /**
     * Constructor.
     *
     * @param Guzzle\Http\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Returns an array of all plans defined in Bamboo.
     *
     * @param array $options
     *
     * @return array
     *
     * @see https://developer.atlassian.com/display/BAMBOODEV/Bamboo+REST+Resources#BambooRESTResources-PlanService
     */
    public function getAllPlans($options)
    {
        $url = $this->createUrl('plan', '', $options);
        $data = $this->getResponseAsArray($url);
        if (false === isset($data['plans'])) {
            return null;
        }

        return $data['plans'];
    }
}
