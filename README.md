# [Grav](http://getgrav.org/) BibLaTeX Plugin

Reads a Bibtex-file (`.bib`) with academic references and renders it as HTML at the end of the page.

Depends on [BibTeX 2 HTML](https://github.com/acla/bibtex2html) for Bibtex parsing. **Note: Bibtex must be formatted strictly adhering to [standards](http://www.bibtex.org/Format/), or the script may fail fatally. Test locally!**

## Installation and Configuration

1. Download the zip version of [this repository](https://github.com/OleVik/grav-plugin-biblatex) and unzip it under `/your/site/grav/user/plugins`.
2. Rename the folder to `biblatex`.

You should now have all the plugin files under

    /your/site/grav/user/plugins/biblatex

The plugin is enabled by default, and can be disabled by copying `user/plugins/biblatex/biblatex.yaml` into `user/config/plugins/biblatex.yaml` and setting `enabled: false`.

## Usage

Copy your properly formatted bibtex file to the same folder as the page you which to display it on, and set a FrontMatter-variable to point to the file, like so:

```
---
title: Home
bibtex: sample.bib
---
```

For example, using [this gist](https://gist.github.com/davestevens/2146887) as `sample.bib`, with the default options, returns this:

```
<div class="biblatex">
	<h2>Articles</h2>
	<h3>2011</h3>
	<ol start="1">
		<li>
			<span class="authors">Stevens, D.; Chouliaras, V.; Azorin-Peris, V. et al.</span>
			<span class="title">BioThreads: A Novel VLIW-Based Chip Multiprocessor for Accelerating Biomedical Image Processing Applications</span>. 
			<span class="in">In IEEE Transactions on Biomedical Circuits and Systems</span>, 2011.
			<span class="links"></span>
		</li>
	</ol>
	<h2>In Proceedings</h2>
	<h3>2011</h3>
	<ol start="2">
		<li>
			<span class="authors">Chouliaras, V.; Lentaris, G.; Reisis, D. et al.</span>
			<span class="title">Customizing a VLIW Chip Multiprocessor for Motion Estimation Algorithms</span>. 
			<span class="in">In Architecture of Computing Systems, 2011. ARCS 2011. 24th International Conference on</span>, 2011.
			<span class="links"></span>
		</li>
	</ol>
	<h3>2010</h3>
	<ol start="3">
		<li>
			<span class="authors">Stevens, D. and Chouliaras, V.</span>
			<span class="title">LE1: A Parameterizable VLIW Chip-Multiprocessor with Hardware PThreads Support</span>. 
			<span class="in">In IEEE Computer Society Annual Symposium on VLSI</span>, pages 122-126, 2010.
			<span class="links"></span>
		</li>
	</ol>
	<h3>2009</h3>
	<ol start="4">
		<li>
			<span class="authors">Stevens, D.; Glynn, N.; Galiatsatos, P. et al.</span>
			<span class="title">Evaluating the performance of a configurable, extensible VLIW processor in FFT execution</span>. 
			<span class="in">In Electronics, Circuits, and Systems, 2009. ICECS 2009. 16th IEEE International Conference on</span>, pages 771-774, 2009.
			<span class="links"></span>
		</li>
		<li>
			<span class="authors">Moyers, S.; Stevens, D.; Chouliaras, V. A. et al.</span>
			<span class="title">Implementation of a Fixed-Point FastSLAM2.0 Algorithm on a Configurable and Extensible VLIW Processor</span>. 
			<span class="in">In Electronics, Circuits, and Systems, 2009. ICECS 2009. 16th IEEE International Conference on</span>, 2009.
			<span class="links"></span>
		</li>
	</ol>
</div>
```

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

## Caveats

There are no graceful fallbacks if the Bibtex file is incorrectly formatted, nor is there hinting to where the improper formatting occurs. Thus, a third-party service to maintain the bibliography and format it is imperative.

Further, styles are currently very limited - singular infact - and so it really is a simplistic plugin. It is recommended to style the output targetting the `.biblatex`-class, as it wraps around the output. Suggestions of more up-to-date back-end libraries for parsing Bibtex in PHP are welcome!

Performance may be slow on initial load with a large bibliography, but if cached the impact is negligible - it is just a bunch of HTML.

MIT License 2016 by [Ole Vik](http://github.com/olevik).