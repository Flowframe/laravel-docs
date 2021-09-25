<?php

namespace Flowframe\Docs;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DocsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-docs')
            ->hasConfigFile('laravel-docs')
            ->hasRoute('web')
            ->hasViews();
    }
}
