@title = "Frontpage"

<div id="post-1" class="post-1 post type-post status-publish format-standard hentry category-maaratlemata">
  <h2 class="entry-title"><a href="index.html" title="Permalink: Hello, html guru!" rel="bookmark">Hello, html guru!</a></h2>

  <div class="entry-content">
    <p>Welcome to HTML Warrior! I'm index.tpl called from page templates ( example_site\templates\pages\ ). Page templates are called based on url - thus index.html calls index.tpl.

    <p>Before I go on, that thing on the top right corner, it's part of HTML Warrior. It's for creating overlay of your design. Just save your
    PSD to png and save it to overlays directory ( example_site\overlays\ ). Name the png index.png ( in case for index.tpl ).</p>

    <p>
      There happens to be index.png for current page. So just click on Toggle. Drag the overlay around with left mouse down + ctrl. Arrows on the top right navigation also move the layer.
      And if you include shift key, overlay will move by 10px steps. You can lock the position so that you won't accidentally move it. And lastly the Reset pos.(ition): there's
      a bug where sometimes overlay will move so much that you can't see it anymore.
    </p>

    <p>But lets continue... I'm index.tpl and I have wrapped header and footer around me from example_site\templates\layouts\default.tpl.
    In that template you'll find {literal}{$yield}{/literal} variable. It's the place where I land.</p>

    <p>From the first line (index.tpl) you'll find:<br />
    @title = "Frontpage"<br />
    So string "Frontpage" is put in the layout template where {literal}{$title}{/literal} variable is ( <span style="white-space:nowrap;">{literal}&lt;title&gt;{$title} - HTML Warrior&lt;/title&gt;{/literal}</span> )
    </p>

    <p>Right after generating this page I was written to <a href="build/index.html">example_site\build\index.html</a>.
    I might look a bit ugly if you clicked on the built version. So for now go back and read on. You can build the whole site by going to url
    <a href="?build=1">?build=1</a>. This will also copy images, scripts, style. So <a href="build/index.html">try again the built version</a>.</p>

    <p>
      There are 4 page templates in this site. You can either click on them in site (top navigation + search) or move your mouse to top left corner of this page. An popup will slide up - it will list all page templates.
      Plus, if you configure your Firefox, you can click on edit and it will open up the template in your favorite editor.
    </p>

    <p>
      So you'll want to make the edit button work (works only in Firefox). Edit your Firefoxes user.js or create one. It's path is<br />
      c:\Users\USERNAME\AppData\Roaming\Mozilla\Firefox\Profiles\XXXXXXXXXXXXX\user.js,</br>
      where USERNAME AND XXXXXXXXXXXXX has to be changed to whatever they are on your system.
    </p>

    <p>
      Add the following 3 lines to user.js:<br />
      user_pref("capability.policy.policynames", "localfilelinks");<br />
      user_pref("capability.policy.localfilelinks.sites", "http://127.0.0.1:8080 http://192.168.1.170:8080");<br />
      user_pref("capability.policy.localfilelinks.checkloaduri.enabled", "allAccess");
    </p>

    <p>Change http://192.168.1.170:8080 to your ip. Or if you're going to use localhost 127.0.0.1, then you don't need to modify anything.</p>

    <p>
      Now you need to teach Firefox what to do with .tpl files. Click on this link:<br />
      <a href="{$config.baseurl}/example_site/templates/pages/index.tpl">{$config.baseurl}/example_site/templates/pages/index.tpl</a>
    </p>

    <p>
      Dont't forget to check the option to always do that action. Don't worry if you didn't check it. Just click on the template again.
    </p>

    <p>
      Lastly, when creating new site, just copy the skeleton dir from _html-warrior or copy this site. That'll set you up in no time.
      This will be matter of button push in near future.
    </p>

    <p>That's it for now. Check out the other pages.</p>

  </div><!-- .entry-content -->

</div><!-- #post-## -->