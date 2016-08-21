# [Grav](http://getgrav.org/) BibLaTeX Plugin

Reads a Bibtex-file (`.bib`) with academic references and renders it as HTML at the end of the page.

Depends on [BibTeX 2 HTML](https://github.com/acla/bibtex2html) for Bibtex parsing.

# Installation and Configuration

1. Download the zip version of [this repository](https://github.com/OleVik/grav-plugin-biblatex) and unzip it under `/your/site/grav/user/plugins`.
2. Rename the folder to `biblatex`.

You should now have all the plugin files under

    /your/site/grav/user/plugins/biblatex

The plugin is enabled by default, and can be disabled by copying `user/plugins/biblatex/biblatex.yaml` into `user/config/plugins/biblatex.yaml` and setting `enabled: false`.

## Options

All options follow the [BibTeX 2 HTML script](https://raw.githubusercontent.com/acla/bibtex2html/master/bibtex2html.php).

### displayTypes

An associative array specifying which bibtex entrytypes you want to list and in which order. The key is the bibtex entry type, and the value is what is displayed as a group title.  Only entries whose type is among those in this array will be shown, except if you use the special key `"_unknown"`, which acts as a sink for those where the key could not be found. If you leave the parameter empty all common bibtex types and their names in english are shown. **Default: None (empty)**

### groupType

A boolean indicating whether entries should be grouped by type. **Default: `true`**

### groupYear

A boolean indicating whether entries should be grouped by year. **Default: `true`**

### highlightName

If the second name of an author matches this parameter, it will be put into `<span class="highlight"></span>`. **Default: None (empty)**

### numbersDesc

By default, the references are numbered in ascending order. This can be reversed changed by setting this parameter to `true`. **Default: `false`**

### sorting

This field is used to sort the entries (within a grouping). Any field can be used for this. Special values are: 'citation' (the rendered citation), 'key' (the BibTeX key), 'author' (the rendered author list, not the list as it appears in the file) and 'timestamp' (a non-standard field). All fields except for 'year' and 'timestamp' are sorted in ascending order.  It is also possible to specify multiple sort criteria by passing an array of field names. If left empty, the entries are listed in the order in which they appear in the file. **Default: None (empty)**

### authorLimit

Limits the number of authors shown for each entry. Instead
of the remaining authors, "et al." is shown. **Default: `3`**

MIT License 2016 by [Ole Vik](http://github.com/olevik).