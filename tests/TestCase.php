<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Tests;

use DrewRoberts\Blog\BlogServiceProvider;
use DrewRoberts\Media\MediaServiceProvider;
use DrewRoberts\Media\MediaServiceProvider;
use Laravel\Nova\NovaCoreServiceProvider;
use Livewire\LivewireServiceProvider;
use Spatie\Permission\PermissionServiceProvider;
use Tipoff\Addresses\AddressesServiceProvider;
use Tipoff\Authorization\AuthorizationServiceProvider;
use Tipoff\Locations\LocationsServiceProvider;
use Tipoff\Seo\SeoServiceProvider;
use Tipoff\Support\SupportServiceProvider;
use Tipoff\TestSupport\BaseTestCase;
use Tipoff\TestSupport\Providers\NovaPackageServiceProvider;
use Tipoff\Waivers\WaiversServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            NovaCoreServiceProvider::class,
            NovaPackageServiceProvider::class,
            SupportServiceProvider::class,
            AddressesServiceProvider::class,
            LivewireServiceProvider::class,
            AuthorizationServiceProvider::class,
            MediaServiceProvider::class,
            SeoServiceProvider::class,
            BlogServiceProvider::class,
            PermissionServiceProvider::class,
            MediaServiceProvider::class,
            WaiversServiceProvider::class,
            LocationsServiceProvider::class,
        ];
    }
}
