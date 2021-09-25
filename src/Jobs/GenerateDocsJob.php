<?php

namespace Flowframe\Docs\Jobs;

use Flowframe\Docs\Events\DocsGeneratedEvent;
use Flowframe\Docs\Repository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use TitasGailius\Terminal\Terminal;

class GenerateDocsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Repository $repository,
    ) {
    }

    public function handle(): void
    {
        $tmpPath = storage_path("tmp/{$this->repository->name}");
        $newPath = resource_path("docs/{$this->repository->name}");

        Terminal::with([
            'url' => $this->repository->url,
            'path' => $tmpPath,
        ])->run('git clone {{ $url }} {{ $path }}');

        if (! File::exists("{$tmpPath}/docs")) {
            return;
        }

        File::ensureDirectoryExists($newPath);

        if (File::exists($newPath)) {
            File::deleteDirectory($newPath);
        }

        File::moveDirectory(
            "{$tmpPath}/docs",
            $newPath
        );

        File::put("{$newPath}/meta.json", $this->repository->toJson());

        File::deleteDirectory($tmpPath);

        event(new DocsGeneratedEvent($this->repository));
    }
}
