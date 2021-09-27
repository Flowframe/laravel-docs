<?php

namespace Flowframe\Docs\Jobs;

use Flowframe\Docs\Commands\GenerateDocsCommand;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;

class GenerateDocsJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public string $repository,
    ) {
    }

    public function handle(): void
    {
        Artisan::call(GenerateDocsCommand::class, ['repository' => $this->repository]);
    }
}
