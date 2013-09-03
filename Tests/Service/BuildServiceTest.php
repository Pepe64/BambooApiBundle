<?php

namespace BambooApiBundle\Tests\Service;

use BambooApiBundle\Tests\TestCase;
use BambooApiBundle\Service\BuildService;

class BuildServiceTest extends TestCase
{
    public function testBuildServiceGetLatestBuilds()
    {
        $jsonFile = __DIR__ . '/../assets/response/results.json';

        $service = new BuildService($this->getClientMock($jsonFile));
        $builds = $service->getLatestResults(
            array(
                'expand' => 'results.result'
            )
        );

        $this->assertCount(5, $builds);
        $this->assertCount(12, $builds['result']);
    }

    public function testBuildServiceGetLatestBuildsException()
    {
        $service = new BuildService($this->getClientMockException());

        $result = $service->getLatestResults(
            array(
                'expand' => 'results.result'
            )
        );

        $this->assertEquals(false, $result);
    }

    public function testBuildServiceGetLatestBuildsNoData()
    {
        $service = new BuildService($this->getClientMockNoData());

        $result = $service->getLatestResults(
            array(
                'expand' => 'results.result'
            )
        );

        $this->assertEquals(false, $result);
    }
}
