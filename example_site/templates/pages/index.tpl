@title = "Frontpage"

<div id="post-1" class="post-1 post type-post status-publish format-standard hentry category-maaratlemata">
  <h2 class="entry-title"><a href="index.html" title="Permalink: Hello, html guru!" rel="bookmark">Hello, html guru!</a></h2>

  <div class="entry-content">
    <p>Welcome to Smartysh! I'm index.tpl called from page templates (templates\pages). Page templates are called based on url - thus index.html calls index.tpl.

    <p>Before I go on, that thing on the top right corner, it's part of Smartysh. It's for creating overlay of your desing. Just save your
    PSD to png and save it to overlays directory. Name the png index.png ( in case for index.tpl ).</p>

    <p>But lets continue... I'm index.tpl and I have wrapped header and footer around me from templates\layouts\default.tpl.
    In that file you'll find {literal}{$yield}{/literal} variable. It's the place where I land.</p>

    <p>From the first line (index.tpl) you'll find:<br />
    @title = "Frontpage"<br />
    So string "Frontpage" is put in the layout template where {literal}{$title}{/literal} variable is ( <span style="white-space:nowrap;">{literal}&lt;title&gt;{$title} - Smartysh&lt;/title&gt;{/literal}</span> )
    </p>

    <p>Right after generating this page I was written to <a href="build/index.html">build/index.html</a>.
    I might look a bit ugly if you clicked on the built version. So for now go back and read on. You can build the whole site by going to url
    <a href="?build=1">?build=1</a>. This will also copy images, scripts, style. So <a href="build/index.html">try again the built version</a>.</p>

  </div><!-- .entry-content -->

</div><!-- #post-## -->