@_files = "images/base/oldbrowser.gif"
@_files = "images/base/oldbrowserA.gif"
@_files = "images/base/firefox.gif"
@_files = "images/base/ie.gif"
@_files = "images/base/safari.gif"
@_files = "images/base/chrome.gif"
@_files = "style/oldbrowser.css"
{if $page=="index"}
<div class="oldbrowser">
  <div class="a">
    <p>{if $lang=="en"}You're using a old browser. For best viewing experierience, please update your browser.{else}Te kasutate vananenud bruserit. Parima tulemuse saavutamiseks, palun uuendage oma brauserit.{/if}</p>
    <div class="browserlist">
      <a href="http://www.getfirefox.com/"><img src="images/base/firefox.gif" alt="" width="31" height="31" /></a>
      <a href="http://www.google.com/chrome"><img src="images/base/chrome.gif" alt="" width="31" height="31" /></a>
      <a href="http://www.apple.com/safari/"><img src="images/base/safari.gif" alt="" width="31" height="31" /></a>
      <a href="http://www.microsoft.com/windows/Internet-explorer/default.aspx"><img src="images/base/ie.gif" alt="" width="31" height="31" /></a>
    </div>
  </div>
</div><!-- .oldbrowser -->
{/if}