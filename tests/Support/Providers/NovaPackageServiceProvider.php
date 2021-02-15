<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Tests\Support\Providers;

use Tipoff\TestSupport\Providers\BaseNovaPackageServiceProvider;
use Tipoff\Waivers\Models\Signature;

class NovaPackageServiceProvider extends BaseNovaPackageServiceProvider
{
    public static array $packageResources = [
        Signature::class,
    ];
}
