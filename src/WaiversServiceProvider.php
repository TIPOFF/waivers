<?php

namespace Tipoff\Waivers;

use Illuminate\Support\Facades\Gate;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tipoff\Waivers\Models\Signature;
use Tipoff\Waivers\Policies\SignaturePolicy;

class WaiversServiceProvider extends PackageServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        parent::boot();
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('waivers')
            ->hasConfigFile()
            ->hasViews();
    }

    public function registeringPackage()
    {
        Gate::policy(Signature::class, SignaturePolicy::class);
    }
}
