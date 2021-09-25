<?php

namespace Flowframe\Docs;

use Spatie\YamlFrontMatter\YamlFrontMatter;
use SplFileInfo;

class Doc
{
    public function __construct(
        public string $title,
        public string $slug,
        public string $category,
        public int $order,
        public string $content,
    ) {
    }

    public static function fromFile(SplFileInfo $file): self
    {
        $frontMatter = YamlFrontMatter::parseFile($file->getPathname());

        return new static(
            title: $frontMatter->matter('title'),
            slug: $file->getBasename('.md'),
            category: $frontMatter->matter('category'),
            order: $frontMatter->matter('order'),
            content: $frontMatter->body(),
        );
    }
}
