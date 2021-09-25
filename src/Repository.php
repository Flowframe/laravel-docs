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
        public ?string $description,
        public string $fullName,
        public int $starsCount,
        public int $forksCount,
        public int $openIssuesCount,
        public ?string $language,
        public ?string $license,
    ) {
    }

    public function toJson($options = 0): string
    {
        return json_encode($this, $options);
    }

    public static function fromRequest(Request $request): self
    {
        return new static(
            url: $request->post('repository')['ssh_url'],
            htmlUrl: $request->post('repository')['html_url'],
            name: $request->post('repository')['name'],
            description: $request->post('repository')['description'],
            fullName: $request->post('repository')['full_name'],
            starsCount: $request->post('repository')['stargazers_count'],
            forksCount: $request->post('repository')['forks_count'],
            openIssuesCount: $request->post('repository')['open_issues_count'],
            language: $request->post('repository')['language'],
            license: $request->post('repository')['license'],
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
