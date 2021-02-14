<?php

declare(strict_types=1);

namespace Tipoff\Waivers;

use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;
use Tipoff\Waivers\Models\Signature;
use Tipoff\Waivers\Policies\SignaturePolicy;

class WaiversServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->hasPolicies([
                Signature::class => SignaturePolicy::class,
            ])
            ->name('waivers')
            ->hasConfigFile();
    }
}
