<?php

namespace Flowframe\Docs\Http\Controllers;

use Flowframe\Docs\Doc;
use Flowframe\Docs\Repository;
use Illuminate\Support\Facades\File;
use SplFileInfo;

class ShowDocController
{
    public function __invoke(string $repository, ?string $doc = null)
    {
        if ($doc === 'index') {
            return redirect(to: route('repositories.doc', [$repository]), status: 301);
        }

        $doc = $doc ?: 'index';

        $file = resource_path("docs/{$repository}/{$doc}.md");

        abort_unless(File::exists($file), 404);

        $doc = Doc::fromFile(new SplFileInfo($file));

        $categories = collect(File::allFiles(resource_path("docs/{$repository}")))
            ->filter(fn (SplFileInfo $file) => $file->getExtension() === 'md')
            ->map(fn (SplFileInfo $file) => Doc::fromFile($file))
            ->sortBy('order')
            ->groupBy('category');

        $repository = Repository::fromFile(resource_path("docs/{$repository}/_meta.yml"));

        seo()
            ->title($doc->title)
            ->description($repository->description)
            ->url(url()->current());

        return view('docs::show-doc', [
            'categories' => $categories,
            'doc' => $doc,
            'repository' => $repository,
        ]);
    }
}
