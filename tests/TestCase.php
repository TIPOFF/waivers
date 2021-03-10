<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Tests;

use DrewRoberts\Media\MediaServiceProvider;
use Laravel\Nova\NovaCoreServiceProvider;
use Spatie\Permission\PermissionServiceProvider;
use Tipoff\Authorization\AuthorizationServiceProvider;
use Tipoff\Locations\LocationsServiceProvider;
use Tipoff\Support\SupportServiceProvider;
use Tipoff\TestSupport\BaseTestCase;
use Tipoff\Waivers\Tests\Support\Providers\NovaPackageServiceProvider;
use Tipoff\Waivers\WaiversServiceProvider;
use Tipoff\Addresses\AddressesServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            NovaCoreServiceProvider::class,
            NovaPackageServiceProvider::class,
            SupportServiceProvider::class,
            AuthorizationServiceProvider::class,
            PermissionServiceProvider::class,
            WaiversServiceProvider::class,
            LocationsServiceProvider::class,
            MediaServiceProvider::class,
            AddressesServiceProvider::class,
        ];
    }
}
