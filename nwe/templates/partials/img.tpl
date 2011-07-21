{strip}
  {if isset($href) || isset($onclick)}
    <a href="{if isset($href)}{$href}{else}javascript:void(0){/if}"{if isset($onclick)} onclick="{$onclick}"{/if}{if isset($aclass)} class="{$aclass}"{/if}>
  {/if}
    <img src="images/{$src}" alt="{$alt}" title="{$alt}" {if $class}class="{$class}" {/if}{if $id}id="{$id}" {/if}{if !$nodimension} width="{$width}" height="{$height}" {/if}{if $align}style="{if $align=='center'}display:block;margin-left:auto;margin-right:auto;{else}float: {$align}{/if}" {/if}{if isset($border)}border="{$border}" {/if}/>
  {if isset($href) || isset($onclick)}
    </a>
  {/if}
{/strip}