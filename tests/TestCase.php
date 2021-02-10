<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Tests;

use Tipoff\TestSupport\BaseTestCase;
use Tipoff\Support\SupportServiceProvider;
use Tipoff\Waivers\WaiversServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            SupportServiceProvider::class,
            WaiversServiceProvider::class
        ];
    }
}
