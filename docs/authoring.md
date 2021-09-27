---
category: Docs
title: Authoring
order: 4
---

When using this package you'll have to adhere to our authoring format.

Docs should be structured like:

```md
---
category: <Category>
title: <Title>
order: <Order>
---

Markdown _content_
```

Don't start your doc with a `# Title`, instead, use the title property to manually render your `h1`. This allows for more styling freedom and supports a better structured HTML document.

## `Docs` directory

All documents have to be put inside the `/docs` directory, we do not allow nesting.

We expect there to be one `_meta.yml` file which contains meta data about your repository. It'll look like this:

```yml
url: https://github.com/flowframe/laravel-docs
name: laravel-docs
fullName: flowframe/laravel-docs
description: Easily self host your documentation.
language: PHP
license: MIT
```

We're also expecting a `index.md` document which will be used as the index, or landing page for your repository's documentation.

## Grouping

Documents get group by the `category` property and order by the `order` property. Orders are ascending, so 1 will appear first and 99 will appear last.
