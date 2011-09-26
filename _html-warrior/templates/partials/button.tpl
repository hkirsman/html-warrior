{strip}
<{if isset($href)}a{elseif isset($tag)}{$tag}{else}button{/if} class="{if $class}{$class}{else}button{/if}{if $align=='right'} rbutton{/if}" {if (!isset($tag) || $tag=="button") && !isset($href)}type="submit"{/if} {if $click} onclick="{$click}"{/if}{if isset($href)} href="{$href}"{/if}>
  <span>{if $label_caption}{$label_caption}{else}{literal}label_caption{/literal}{/if}</span>
</{if isset($href)}a{elseif isset($tag)}{$tag}{else}button{/if}>
{/strip}