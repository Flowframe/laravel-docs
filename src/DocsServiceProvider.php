<?php

namespace Flowframe\Docs;

use Flowframe\Docs\Commands\GenerateDocsCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DocsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-docs')
            ->hasCommand(GenerateDocsCommand::class)
            ->hasConfigFile('laravel-docs')
            ->hasRoute('web')
            ->hasViews();
    }
}
