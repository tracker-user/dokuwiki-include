# Include plugin for DokuWiki — local fork

Displays another wiki page (or a section of one, or all pages in a namespace) inline within the current page. Upstream: [dokuwiki.org/plugin:include](https://dokuwiki.org/plugin:include) by Michael Hamann, Gina Häußge, Michael Klier, Christopher Smith, Esther Brunner.

## Syntax

```
{{page>pagename}}                  include a full page
{{page>pagename#section}}          include one section
{{section>pagename#section}}       same, section-only mode
{{namespace>ns:name}}              include every page in a namespace
{{tagtopic>tagname}}               include all pages with a given tag (requires tag plugin)
```

Flags are appended with `&`:

```
{{page>pagename&noheader&firstseconly}}
```

### Common flags

| Flag | Effect |
|------|--------|
| `header` / `noheader` | Show or hide the first heading of the included page |
| `firstseconly` / `fullpage` | Show only the first section, or the full page |
| `editbtn` / `noeditbtn` | Show or hide the inline edit button |
| `footer` / `nofooter` | Show or hide the meta footer |
| `date` / `nodate` | Show or hide creation date in footer |
| `mdate` / `nomdate` | Show or hide modification date in footer |
| `user` / `nouser` | Show or hide author in footer |
| `link` / `nolink` | Link the first heading back to the included page |
| `permalink` / `nopermalink` | Show a permalink in the footer |
| `indent` / `noindent` | Indent heading levels to match inclusion depth |
| `inline` | Inline mode — suppress section wrappers |
| `linkonly` / `nolinkonly` | Render a link only, not the page content |
| `title` / `notitle` | Use first heading as link text in linkonly mode |
| `pageexists` / `nopageexists` | In linkonly mode, suppress link if page doesn't exist |
| `parlink` / `noparlink` | Wrap linkonly link in a paragraph |
| `readmore` / `noreadmore` | Show "Read more…" link at end of firstseconly content |
| `redirect` / `noredirect` | Redirect back to including page after editing |
| `order=id\|title\|created\|modified\|indexmenu\|custom` | Sort order for namespace includes |
| `rsort` / `sort` | Reverse or forward sort for namespace includes |
| `depth=N` | Max namespace recursion depth (0 = unlimited) |
| `exclude=/regex/` | Exclude pages matching a regex from namespace includes |
| `beforeeach=X` / `aftereach=X` | Insert text before/after each included page |

### Macro substitution in page IDs

Page IDs support substitution tokens for user-personalised includes:

| Token | Replaced with |
|-------|---------------|
| `@USER@` | Login name (cleaned) |
| `@NAME@` | Display name (cleaned) |
| `@GROUP@` | First group membership |
| `@YEAR@` `@MONTH@` `@WEEK@` `@DAY@` | Current date parts |
| `@PMONTH@` `@NMONTH@` `@PWEEK@` `@NWEEK@` etc. | Relative date offsets |
| `@BROWSER_LANG@` | Best matching language from `Accept-Language` header |

## Configuration

| Key | Default | Description |
|-----|---------|-------------|
| `noheader` | 0 | Hide the first heading of included pages by default |
| `firstseconly` | 0 | Show only the first section by default |
| `showeditbtn` | 1 | Show inline edit buttons |
| `showfooter` | 1 | Show meta footer below included content |
| `showlink` | 0 | Link first heading to included page |
| `showpermalink` | 0 | Show permalink in footer |
| `showdate` | 1 | Show creation date in footer |
| `showmdate` | 0 | Show modification date in footer |
| `showuser` | 1 | Show author in footer |
| `showcomments` | 1 | Show comment count (requires discussion plugin) |
| `showlinkbacks` | 1 | Show linkback count (requires linkback plugin) |
| `showtags` | 1 | Show tags (requires tag plugin) |
| `showtaglogos` | 0 | Show image for first tag |
| `doredirect` | 1 | Redirect back to including page after edit |
| `doindent` | 1 | Indent headings relative to inclusion depth |
| `linkonly` | 0 | Default to linkonly mode |
| `title` | 0 | Use first heading as link text in linkonly mode |
| `pageexists` | 0 | Suppress link if page missing in linkonly mode |
| `parlink` | 1 | Wrap linkonly link in a paragraph |
| `order` | `id` | Default sort order for namespace includes |
| `rsort` | 0 | Reverse sort order |
| `depth` | 1 | Max namespace recursion depth |
| `readmore` | 1 | Show "Read more…" in firstseconly mode |
| `safeindex` | 1 | Prevent indexing metadata from non-public included pages |
| `debugoutput` | 0 | Write verbose debug info to DokuWiki debug log |

## Local fork changes

Applied during Librarian (2025-05-14b) / PHP 8.3 compatibility review:

- Added `DOKU_INC` guards to all non-namespaced PHP files
- Added explicit visibility (`public`/`protected`/`private`) to all properties and methods; replaced `var` with typed declarations where applicable
- Replaced `$_REQUEST`/`$_SERVER` superglobal access with the `$INPUT` wrapper throughout; direct `$_SERVER` manipulation retained only in `handle_indexer` where intentional user impersonation requires modifying the raw superglobal
- Removed dead pre-Greebo `SEC_EDIT_PATTERN` compatibility branches (constant always defined since Greebo 2020)
- Removed dead DokuWiki < 2010 version check in `handle_redirect`
- Removed dead `function_exists('userlink')` fallback (`userlink()` has existed since 2014)
- Removed legacy `HTML_EDITFORM_OUTPUT`, `HTML_CONFLICTFORM_OUTPUT`, `HTML_DRAFTFORM_OUTPUT` event registrations and the corresponding `addHidden()` code path
- Removed redundant `extract()` call in `syntax/include.php` `render()`
- Fixed `@preg_match` suppressor on the `exclude` flag: regex is validated once before use, no longer silently swallows malformed patterns
- Added `hsc()` escaping to `syntax/locallink.php` `href` and `title` attributes
- Converted `array()` to `[]` throughout all files

## License

GPL 2 — see `LICENSE`.
