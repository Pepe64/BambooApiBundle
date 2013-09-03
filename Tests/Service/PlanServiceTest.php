<?php

namespace BambooApiBundle\Tests\Service;

use BambooApiBundle\Tests\TestCase;
use BambooApiBundle\Service\PlanService;

class PlanServiceTest extends TestCase
{
    public function testPlanServiceGetAllPlans()
    {
        $jsonFile = __DIR__ . '/../assets/response/plans.json';

        $service = new PlanService($this->getClientMock($jsonFile));
        $result = $service->getAllPlans(
            array(
                'expand' => 'plans.plan.actions'
            )
        );

        $this->assertCount(5, $result);
        $this->assertCount(12, $result['plan']);
    }

    public function testPlanServiceGetAllPlansException()
    {
        $service = new PlanService($this->getClientMockException());

        $result = $service->getAllPlans(
            array(
                'expand' => 'plans.plan.actions'
            )
        );

        $this->assertEquals(false, $result);
    }

    public function testPlanServiceGetAllPlansNoData()
    {
        $service = new PlanService($this->getClientMockNoData());

        $result = $service->getAllPlans(
            array(
                'expand' => 'plans.plan.actions'
            )
        );

        $this->assertEquals(false, $result);
    }
}
