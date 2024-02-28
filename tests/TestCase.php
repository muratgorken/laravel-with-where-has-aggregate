<?php

namespace Muratgorken\LaravelWithWhereHasAggregate\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Muratgorken\LaravelWithWhereHasAggregate\LaravelWithWhereHasAggregateServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Muratgorken\\LaravelWithWhereHasAggregate\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelWithWhereHasAggregateServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-with-where-has-aggregate_table.php.stub';
        $migration->up();
        */
    }
}
