<?php

use Flowframe\Docs\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

/**
 * Slimmed down request body with only necesarry data
 */
function githubWebhookRequestBody(array $data = []): array
{
    $body = array_merge([
        'ref' => 'refs/heads/master',
        'repository' => [
            'name' => 'laravel-docs',
            'full_name' => 'Flowframe/laravel-docs',
            'html_url' => 'https://github.com/Flowframe/laravel-docs',
            'ssh_url' => 'git@github.com:Flowframe/laravel-docs.git',
            'description' => 'Test description',
            'stargazers_count' => 10,
            'forks_count' => 3,
            'open_issues_count' => 1,
            'language' => 'PHP',
            'license' => 'MIT'
        ],
    ], $data);

    return $body;
}
