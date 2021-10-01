<?php

use Flowframe\Docs\Commands\GenerateDocsCommand;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertDirectoryExists;

it('should generate docs', function () {
    artisan(GenerateDocsCommand::class, ['repository' => 'git@github.com:Flowframe/laravel-docs.git']);

    assertCount(1, File::directories(resource_path('docs')));

    assertCount(0, File::directories(storage_path('tmp')));

    assertDirectoryExists(resource_path('docs/laravel-docs'));
});
