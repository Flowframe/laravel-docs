<?php

use Flowframe\Docs\Http\Controllers\HandleWebhookController;
use Flowframe\Docs\Http\Controllers\ListRepositoriesController;
use Flowframe\Docs\Http\Controllers\ShowDocController;
use Illuminate\Support\Facades\Route;

Route::post(config('laravel-docs.webhook_route'), HandleWebhookController::class)
    ->middleware('web');

Route::get(config('laravel-docs.list_repositories_route'), ListRepositoriesController::class)
    ->middleware('web')
    ->name('repositories');

Route::get(config('laravel-docs.show_doc_route'), ShowDocController::class)
    ->middleware('web')
    ->name('repositories.doc');
