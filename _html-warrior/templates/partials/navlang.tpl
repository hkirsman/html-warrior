{$langs_used}

<div id="lang">
  {foreach $langs_used as $key=>$var}
    {if $key != $lang_current}
      <a href="/{$key}">{$var}</a>
    {/if}
  {/foreach}
</div>