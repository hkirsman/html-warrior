<div class="basketSteps">
  <{if $page=='basket-1' || $page=='basket-2'}a{else}span{/if} class="step{if $page=='basket-1'} active{/if}" {if $page=='basket-1' || $page=='basket-2'}href="basket-2.html"{/if}>
    <span class="title">Sinu ostukorv</span>
    <span class="description">Lisatud tooted</span>
  </{if $page=='basket-1' || $page=='basket-2'}a{else}span{/if}>
  <{if $page=='basket-2'}a{else}span{/if} class="step{if $page=='basket-2'} active{/if}" {if $page=='basket-2'}href="basket-2.html"{/if}>
    <span class="title">Andmed</span>
    <span class="description">Teie andmed</span>
  </{if $page=='basket-2'}a{else}span{/if}>
  <span class="step{if $page=='basket-3'} active{/if}">
    <span class="title">Maksmine</span>
    <span class="description">Tellimuse eest tasumine</span>
  </span>
  <span class="step{if $page=='basket-4'} active{/if}">
    <span class="title">Kinnitus</span>
    <span class="description">Tellimus esitatud</span>
  </span>

  <div class="buttons">
{if $page=="basket-1"}
    <button class="button02" type="submit"><span>{if $label_next}{$label_next}{else}{literal}label_next{/literal}{/if}<img class="iconForward" src="images/base/button02arrowforward.gif" alt="" /></span></button>
{elseif  $page=="basket-2"}
    <a href="basket-1.html" class="button02"><span><img class="iconBack" src="images/base/button02arrowbackward.gif" alt="" />{if $label_back}{$label_back}{else}{literal}label_back{/literal}{/if}</span></a>
    <button class="button02" type="submit"><span>{if $label_next}{$label_next}{else}{literal}label_next{/literal}{/if}<img class="iconForward" src="images/base/button02arrowforward.gif" alt="" /></span></button>
{/if}
  </div>
</div><!-- .basketSteps -->