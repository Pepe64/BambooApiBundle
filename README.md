JiraApiBundle
=============

Master: [![Build Status](https://secure.travis-ci.org/MedicoreNL/BambooApiBundle.png?branch=master)](http://travis-ci.org/MedicoreNL/BambooApiBundle)

A [Symfony2](http://symfony.com) bundle that integrates the [Bamboo](https://www.atlassian.com/software/bamboo/overview) [REST API](https://developer.atlassian.com/bamboo/docs/latest/reference/rest-api.html) into native Symfony2 services.

Installation
------------

 1. Install [Composer](https://getcomposer.org).

    ```bash
    # Install Composer
    curl -sS https://getcomposer.org/installer | php
    ```

 2. Add this bundle to the `composer.json` file of your project.

    ```bash
    # Add BambooApiBundle as a dependency
    php composer.phar require medicorenl/jira-api-bundle dev-master
    ```

 3. After installing, you need to require Composer's autloader in the bootstrap of your project.

    ```php
    // app/autoload.php
    $loader = require __DIR__ . '/../vendor/autoload.php';
    ```

 4. Add the bundle to your application kernel.

    ```php
    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new BambooApiBundle\BambooApiBundle(),
            // ...
        );
    }
    ```

 5. Configure the bundle by adding parameters to the `config.yml` file:

    ```yaml
    # app/config/config.yml
        bamboo_api.url:         "http://bamboo.your-organisation.com/rest/api/latest/"
        bamboo_api.credentials: "username:password"
    ```

Usage
-----

This bundle contains a number of services, to access them through the service container:

```php
// Get the BambooApiBundle\Service\BuildService
$buildService = $this->get('bamboo_api.build');
$buildService->getLatestResults($options);

// Get the BambooApiBundle\Service\ProjectService
$planService = $this->get('bamboo_api.project');
$planService->getAllPlans($options);
```

You can also add them to the service container of your own bundle:

```xml
<!-- src/Project/Bundle/Resources/config/services.xml -->
<?xml version="1.0" encoding="UTF-8"?>
<container xmlns="http://symfony.com/schema/dic/services"
           xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
           xsi:schemaLocation="http://symfony.com/schema/dic/services http://symfony.com/schema/dic/services/services$
    <services>
        <service id="myproject.myservice" class="MyProject\MyBundle\Services\MyService.php" public="true">
            <argument type="service" id="bamboo_api.build" />
            <argument type="service" id="bamboo_api.plan" />
        </service>
    </services>
</container>
```

You can then use them in your own services

```php
<?php

namespace Project\Bundle\Services;

use BambooApiBundle\Service\BuildService;
use BambooApiBundle\Service\PlanService;

/**
 * Service class for my bundle.
 */
class MyService
{
    /**
     * @var \BambooApiBundle\Service\BuildService
     */
    private $buildService;

    /**
     * @var \BambooApiBundle\Service\PlanService
     */
    private $planService;

    /**
     * Constructor.
     *
     * @param \BambooApiBundle\Service\BuildService $buildService
     * @param \BambooApiBundle\Service\PlanService  $planService
     */
    public function __construct(
        BuildService $buildService,
        PlanService $planService,
    ) {
        $this->buildService = $buildService;
        $this->planService  = $planService;
    }
}
```

Unit testing
------------

BambooApiBundle uses [PHP Unit](http://phpunit.de) for unit testing.

 1. Download PHP Unit.

    ```bash
    # Download PHP Unit
    wget http://pear.phpunit.de/get/phpunit.phar
    chmod +x phpunit.phar
    ```

 2. Make sure all dependencies are installed through Composer.

    ```bash
    # Install dependencies
    php composer.phar install
    ```

 3. Run the unit tests.

    ```bash
    # Run unit tests
    php phpunit.phar
    ```
