<?php

namespace BambooApiBundle\Tests\Service;

use BambooApiBundle\Tests\TestCase;
use BambooApiBundle\Service\BuildService;
use BambooApiBundle\Tests\JsonResponseMock;

class BuildServiceTest extends TestCase
{
    public function testGetLatestResults()
    {
        $jsonFile = __DIR__ . '/../assets/response/results.json';

        $service = new BuildService($this->getClientMock($jsonFile));
        $builds = $service->getLatestBuilds(
            array(
                'expand' => 'results.result'
            )
        );

        $this->assertCount(5, $builds);
        $this->assertCount(12, $builds['result']);
    }
}
