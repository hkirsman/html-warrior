{strip}
  {if $tag == "button" || $tag==""}
    <button class="{if $class}{$class}{else}button{/if}{if $align=='right'} rbutton{/if}" type="submit"{if $click} onclick="{$click}"{/if}>
      <span>{if $label_caption}{$label_caption}{else}{literal}label_caption{/literal}{/if}</span>
    </button>
  {elseif $tag == "a"}
    <a class="{if $class}{$class}{else}button{/if}{if $align=='right'} rbutton{/if}" href="{if $href}{$href}{else}javascript:void(0){/if}"{if $click} onclick="{$click}"{/if}>
      <span>{if $label_caption}{$label_caption}{else}{literal}label_caption{/literal}{/if}</span>
    </a>
  {/if}
{/strip}