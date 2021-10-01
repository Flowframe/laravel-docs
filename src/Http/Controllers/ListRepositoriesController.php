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

        seo()
            ->title('All repositories')
            ->description('An overview of all our documented repositories.')
            ->url(url()->current());

        return view('docs::list-repositories', [
            'repositories' => $repositories,
        ]);
    }
}
