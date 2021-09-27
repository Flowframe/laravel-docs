<?php

namespace Flowframe\Docs\Events;

use Illuminate\Foundation\Events\Dispatchable;

class DocsGeneratedEvent
{
    use Dispatchable;

    public function __construct(
        public string $repositoryName,
        public string $repositoryUrl,
    ) {
    }
}
