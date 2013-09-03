<?php

namespace BambooApiBundle\Service;

use Guzzle\Http\Client;
use Guzzle\Http\Exception\BadResponseException;

/**
 * Service class for retrieving build results from Bamboo.
 */
class BuildService extends AbstractService
{
    /**
     * Returns a list of latest build results.
     *
     * @param array $options
     *
     * @return array
     *
     * @see https://developer.atlassian.com/display/BAMBOODEV/Bamboo+REST+Resources#BambooRESTResources-BuildService%E2%80%94AllBuilds
     */
    public function getLatestResults($options)
    {
        $url = $this->createUrl('result', '', $options);

        $data = $this->getResponseAsArray($url);

        if (false === isset($data['results'])) {
            return null;
        }

        return $data['results'];
    }
}
