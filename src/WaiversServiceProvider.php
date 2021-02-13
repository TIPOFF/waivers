<?php

declare(strict_types=1);

namespace Tipoff\Waivers;

use Tipoff\Waivers\Models\Signature;
use Tipoff\Waivers\Policies\SignaturePolicy;
use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class WaiversServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->hasPolicies([
                Waiver::class => SignaturePolicy::class,
            ])
            ->name('waivers')
            ->hasConfigFile();
    }
}
