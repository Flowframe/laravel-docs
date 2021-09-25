<?php

return [

    'webhook_route' => '/webhooks/github/docs/update',

    'list_repositories_route' => '/',

    'show_doc_route' => '/docs/{repository}/{doc?}',

    'main_branch' => 'master',

    'github_secret' => env('LARAVEL_DOCS_GITHUB_SECRET'),

];
