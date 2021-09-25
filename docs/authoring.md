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

## Guidelines and tips

-   A `docs` directory has to be placed in the root of your repository
-   An `index.md` file is required as it will be the "index page" for your documentation
-   Docs will be grouped by the `category`, nesting documents will not work
-   Don't start your doc with a `# Title`, instead, use the title property to manually render your `h1`
-   Orders are ascending, so 1 will appear first and 99 will appear last
