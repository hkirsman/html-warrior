{if false}
{partial template="tabs" links=array('Kõik','Kasutajad','Ettevõtted','Bookmarks','Partnerid','Uudised') indent="    "}
{/if}
<div class="tabs">
  <ul>
{foreach from=$links key=key item=item name=tabs}
    <li><a {if $smarty.foreach.tabs.index == 0}class="current" {/if}href="{if is_array($item)}{$item.1|lower|replace:" ":""}{else}#{$item|lower|replace:" ":""}{/if}"><span>{if is_array($item)}{$item.0}{else}{$item}{/if}</span></a></li>
{/foreach}
  </ul>
</div><!-- .tabs -->