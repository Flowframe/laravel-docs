<?php

namespace Flowframe\Docs;

use Symfony\Component\Yaml\Yaml;

class Repository
{
    public function __construct(
        public string $url,
        public string $name,
        public string $fullName,
        public string $description,
        public string $language,
        public string $license,
    ) {
    }

    public static function fromFile(string $path): self
    {
        $json = Yaml::parseFile($path);

        return new static(
            url: $json['url'],
            name: $json['name'],
            fullName: $json['fullName'],
            description: $json['description'],
            language: $json['language'],
            license: $json['license'],
        );
    }
}
