<?php

namespace Muratgorken\LaravelWithWhereHasAggregate;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Muratgorken\LaravelWithWhereHasAggregate\Commands\LaravelWithWhereHasAggregateCommand;

class LaravelWithWhereHasAggregateServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-with-where-has-aggregate')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-with-where-has-aggregate_table')
            ->hasCommand(LaravelWithWhereHasAggregateCommand::class);
    }
}
