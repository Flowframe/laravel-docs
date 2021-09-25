<?php

namespace Flowframe\Docs;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Http\Request;

class Repository implements Jsonable
{
    public function __construct(
        public string $url,
        public string $htmlUrl,
        public string $name,
        public ?string $description = null,
        public string $fullName,
        public int $starsCount,
        public int $forksCount,
        public int $openIssuesCount,
        public ?string $language = null,
        public ?array $license = null,
    ) {
    }

    public function toJson($options = 0): string
    {
        return json_encode($this, $options);
    }

    public static function fromRequest(Request $request): self
    {
        return new static(
            url: $request->json('repository.ssh_url'),
            htmlUrl: $request->json('repository.html_url'),
            name: $request->json('repository.name'),
            description: $request->json('repository.description'),
            fullName: $request->json('repository.full_name'),
            starsCount: $request->json('repository.stargazers_count'),
            forksCount: $request->json('repository.forks_count'),
            openIssuesCount: $request->json('repository.open_issues_count'),
            language: $request->json('repository.language'),
            license: $request->json('repository.license'),
        );
    }

    public static function fromJsonFile(string $path): self
    {
        $json = json_decode(file_get_contents($path), 1);

        return new static(
            url: $json['url'],
            htmlUrl: $json['htmlUrl'],
            name: $json['name'],
            description: $json['description'] ?? null,
            fullName: $json['fullName'],
            starsCount: $json['starsCount'] ?? 0,
            forksCount: $json['forksCount'] ?? 0,
            openIssuesCount: $json['openIssuesCount'] ?? 0,
            language: $json['language'] ?? null,
            license: $json['license'] ?? null,
        );
    }
}
