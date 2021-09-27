<?php

namespace Flowframe\Docs\Commands;

use Flowframe\Docs\Events\DocsGeneratedEvent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use TitasGailius\Terminal\Terminal;

class GenerateDocsCommand extends Command
{
    protected $signature = 'laravel-docs:generate-docs {repository}';

    protected $description = 'Generate docs for a given repository';

    public function handle(): int
    {
        $repositoryUrl = $this->argument('repository');
        $name = $this->parseName($repositoryUrl);
        $fullName = $this->parseFullName($repositoryUrl);

        $tmpPath = storage_path("tmp/{$name}");
        $newPath = resource_path("docs/{$name}");

        $this->info("Cloning repository {$fullName}");

        Terminal::with([
            'url' => $repositoryUrl,
            'path' => $tmpPath,
        ])->run('git clone {{ $url }} {{ $path }}');

        $this->comment('Checking for `docs` directory');

        if (! File::exists("{$tmpPath}/docs")) {
            $this->info('No `docs` directory found');

            return self::FAILURE;
        }

        $this->comment('Checking for stale docs');

        File::ensureDirectoryExists($newPath);

        if (File::exists($newPath)) {
            $this->comment('Deleting stale docs');

            File::deleteDirectory($newPath);
        }

        $this->comment('Moving docs to `resources` directory');

        File::moveDirectory(
            "{$tmpPath}/docs",
            $newPath
        );

        $this->comment('Deleting `tmp` directory');

        File::deleteDirectory($tmpPath);

        $this->info('Updated docs');

        event(new DocsGeneratedEvent(
            $fullName,
            $repositoryUrl,
        ));

        return self::SUCCESS;
    }

    protected function parseFullName(string $repository): string
    {
        return (string) Str::of($repository)
            ->after(':')
            ->beforeLast('.git');
    }

    protected function parseName(string $repository): string
    {
        return (string) Str::of($repository)
            ->afterLast('/')
            ->beforeLast('.git');
    }
}
