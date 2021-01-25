<?php

namespace Tipoff\Waivers;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tipoff\Waivers\Commands\WaiversCommand;

class WaiversServiceProvider extends PackageServiceProvider
{
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
            ->hasViews()
            ->hasMigration('create_waivers_table')
            ->hasCommand(WaiversCommand::class);
    }
}
