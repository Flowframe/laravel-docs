<?php

namespace Flowframe\Docs\Events;

use Flowframe\Docs\Repository;
use Illuminate\Foundation\Events\Dispatchable;

class DocsGeneratedEvent
{
    use Dispatchable;

    public function __construct(
        public Repository $repository
    ) {
    }
}
