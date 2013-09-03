<?php

namespace BambooApiBundle\Tests;

/**
 * Mocks JSON responses that returns an error for unit testing purposes.
 */
class ErrorResponseMock
{
    protected $response;

    public function __construct()
    {
    }

    public function json()
    {
        return array(
            'errorMessages' => array(),
            'errors'        => array(),
        );
    }
}
