<?php

namespace Flowframe\Docs\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Flowframe\Docs\DocsServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Flowframe\\Docs\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            DocsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('laravel-docs.github_secret', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-docs_table.php.stub';
        $migration->up();
        */
    }
}
