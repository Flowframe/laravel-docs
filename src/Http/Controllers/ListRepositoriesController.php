<?php

namespace Flowframe\Docs\Http\Controllers;

use Flowframe\Docs\Repository;
use Illuminate\Support\Facades\File;

class ListRepositoriesController
{
    public function __invoke()
    {
        $repositories = collect(File::directories(resource_path('docs')))
            ->map(fn (string $path) => Repository::fromFile("{$path}/_meta.yml"));

        return view('docs::list-repositories', [
            'repositories' => $repositories,
        ]);
    }
}
