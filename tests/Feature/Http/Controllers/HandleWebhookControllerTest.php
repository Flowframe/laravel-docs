<?php

use Flowframe\Docs\Jobs\GenerateDocsJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\postJson;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertDirectoryExists;
use function PHPUnit\Framework\assertFileExists;

it('should fail due to invalid signature', function () {
    postJson(
        '/webhooks/github/docs/update',
        githubWebhookRequestBody(),
        ['X-Hub-Signature-256' => 'false-signature'],
    )->assertStatus(401);
});

it('should process the request', function () {
    $body = githubWebhookRequestBody();
    $signature = 'sha256=' . hash_hmac('sha256', json_encode($body), config('laravel-docs.github_secret'));

    Bus::fake([GenerateDocsJob::class]);

    postJson(
        '/webhooks/github/docs/update',
        $body,
        ['X-Hub-Signature-256' => $signature],
    )->assertStatus(200)->assertSee('ok');

    Bus::assertDispatchedAfterResponse(GenerateDocsJob::class);

    assertCount(1, File::directories(resource_path('docs')));

    assertCount(0, File::directories(storage_path('tmp')));

    assertDirectoryExists(resource_path('docs/laravel-docs'));

    assertFileExists(resource_path('docs/laravel-docs/meta.json'));
});
