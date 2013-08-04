<?php

namespace BambooApiBundle\Tests\Service;

use BambooApiBundle\Tests\TestCase;
use BambooApiBundle\Service\PlanService;
use BambooApiBundle\Tests\JsonResponseMock;

class PlanServiceTest extends TestCase
{
    public function testGetAllPlans()
    {
        $jsonFile = __DIR__ . '/../assets/response/plans.json';

        $service = new PlanService($this->getClientMock($jsonFile));
        $plans = $service->getAllPlans(
            array(
                'expand' => 'plans.plan.actions'
            )
        );

        $this->assertCount(5, $plans);
        $this->assertCount(12, $plans['plan']);
    }
}
