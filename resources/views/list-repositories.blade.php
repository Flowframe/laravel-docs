<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        http-equiv="X-UA-Compatible"
        content="IE=edge"
    >

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <x-seo::meta />
</head>

<body>
    <h1>Repositories</h1>

    <ul>
        @foreach ($repositories as $repository)
            <li>
                <a href="{{ route('repositories.doc', $repository->name) }}">
                    <h2>{{ $repository->fullName }}</h2>
                </a>

                <dl>
                    <dt>Description</dt>
                    <dd>{{ $repository->description ?? 'No description' }}</dd>

                    <dt>Language</dt>
                    <dd>{{ $repository->language }}</dd>

                    <dt>License</dt>
                    <dd>{{ $repository->license ?? 'No license' }}</dd>
                </dl>

                <p>
                    <a
                        target="_blank"
                        href="{{ $repository->url }}"
                    >View on GitHub</a>
                </p>
            </li>
        @endforeach
    </ul>
</body>

</html>
