<?php

use Flowframe\Docs\Jobs\GenerateDocsJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertDirectoryExists;

it('should generate docs', function () {
    Bus::fake();

    Bus::dispatch(new GenerateDocsJob('git@github.com:Flowframe/laravel-docs.git'));

    assertCount(1, File::directories(resource_path('docs')));

    assertCount(0, File::directories(storage_path('tmp')));

    assertDirectoryExists(resource_path('docs/laravel-docs'));
});
