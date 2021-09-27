<?php

namespace Flowframe\Docs\Http\Controllers;

use Flowframe\Docs\Jobs\GenerateDocsJob;
use Illuminate\Http\Response;

class HandleWebhookController
{
    public function __invoke()
    {
        $receivedSignature = request()->header('X-Hub-Signature-256');
        $expectedSignature = 'sha256=' . hash_hmac('sha256', request()->getContent(), config('laravel-docs.github_secret'));

        abort_unless(
            hash_equals($expectedSignature, $receivedSignature),
            Response::HTTP_UNAUTHORIZED,
            'Invalid signature',
        );

        dispatch(
            new GenerateDocsJob(request()->json('repository.ssh_url'))
        )->afterResponse();

        return response('ok');
    }
}
