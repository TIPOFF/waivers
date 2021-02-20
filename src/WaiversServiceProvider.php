<?php

declare(strict_types=1);

namespace Tipoff\Waivers;

use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;
use Tipoff\Waivers\Events\WaiverSigned;
use Tipoff\Waivers\Listeners\CreateParticipant;
use Tipoff\Waivers\Listeners\SendWaiverConfirmation;
use Tipoff\Waivers\Models\Signature;
use Tipoff\Waivers\Models\Waiver;
use Tipoff\Waivers\Policies\SignaturePolicy;
use Tipoff\Waivers\Policies\WaiverPolicy;

class WaiversServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->hasPolicies([
                Signature::class => SignaturePolicy::class,
                Waiver::class    => WaiverPolicy::class,
            ])
            ->hasNovaResources([
                \Tipoff\Waivers\Nova\Signature::class,
                \Tipoff\Waivers\Nova\Waiver::class
            ])
            ->hasEvents([
                WaiverSigned::class => [
                    SendWaiverConfirmation::class,
                    CreateParticipant::class,
                ],
            ])
            ->name('waivers')
            ->hasConfigFile();
    }
}
