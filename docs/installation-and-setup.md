---
category: Getting started
title: Installation and setup
order: 3
---

You can install the package via composer:

```
composer require flowframe/laravel-docs
```

## Setup

To get started:

1. Install the package in a Laravel project
1. Obtain a [GitHub Personal Access Token]()
1. Put the obtained token inside your `.env`: `LARAVEL_DOCS_GITHUB_SECRET=<YOUR_TOKEN>`
1. Specify which branch should be used for the docs via the config using the `main_branch` key. (default is `master`)
1. Add a repository by setting up a [webhook]() which points to your application. Don't forget to use your `LARAVEL_DOCS_GITHUB_SECRET` token.
1. Push a change to your repository and watch it update

## Views

Once installed you should publish the views, by default we provide a simple HTML structure which should give you a rough idea of the working.

## Routes

You can specify the route paths via the config.

## Config

This is what the default config looks like:

## Main branch

We only want to update our docs when changes has been made to a specific branch, in most cases that will be: `master`, `main` or `production`. We advice to use your latest and stable branch.

```php
<?php

return [

    'webhook_route' => '/webhooks/github/docs/update',

    'list_repositories_route' => '/',

    'show_doc_route' => '/docs/{repository}/{doc?}',

    'main_branch' => 'master',

    'github_secret' => env('LARAVEL_DOCS_GITHUB_SECRET'),

];
```
