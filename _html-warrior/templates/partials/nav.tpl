{if onlyul}
<ul id="nav">
{foreach from=$links key=key item=item name=links}
  <li{if $item.1=="$page.html"} class="active"{/if}><a href="{if is_array($item)}{$item.1}{else}javascript:void(0){/if}"><span>{if is_array($item)}{$item.0}{else}{$item}{/if}</span></a></li>
{/foreach}
</ul><!-- #nav -->
{else}
<div id="nav">
  <ul id="nav">
{foreach from=$links key=key item=item name=links}
    <li{if $key==1} class="selected" {/if}><a href="{if is_array($item)}{$item.1}{else}javascript:void(0){/if}"><span>{if is_array($item)}{$item.0}{else}{$item}{/if}</span></a></li>
{/foreach}
  </ul>
</div><!-- #nav -->
{/if}