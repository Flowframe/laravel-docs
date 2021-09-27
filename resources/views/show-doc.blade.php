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

    <title>{{ $repository->name }} / {{ $doc->title }}</title>
</head>

<body>
    <h1>{{ $doc->title }}</h1>

    <details>
        <summary>Documents in {{ $repository->fullName }}</summary>

        <ul>
            @foreach ($categories as $categoryTitle => $categoryDocs)
                <li>
                    <h2>{{ $categoryTitle }}</h2>

                    <ul>
                        @foreach ($categoryDocs as $categoryDoc)
                            <li>
                                <a href="{{ route('repositories.doc', [$repository->name, $categoryDoc->slug]) }}">
                                    {{ $categoryDoc->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </details>

    <main>
        {!! Str::markdown($doc->content) !!}
    </main>

    <a
        target="_blank"
        href="{{ "{$repository->url}/blob/master/docs/{$doc->slug}.md" }}"
    >Edit on GitHub</a>
</body>

</html>
