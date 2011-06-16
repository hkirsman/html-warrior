{if false}
{partial template="button" class="button01" caption="Muuda oma profiili" indent="            "}
{/if}
<div class="frmrow{if $error} error{/if}"><span class="{if $class}chooser {$class}{else}chooser{/if}"><span class="frmcaption">{$caption}{if $mandatory}<span class="frmMandatoryMark">*</span>{/if}</span><span class="inputs">{if $values}
{foreach from=$values key=key item=item name=$values}
  <label class="option"><input class="input" type="{if $type}{$type}{else}checkbox{/if}" name="" /><span class="caption">{$item}</span></label>
{/foreach}
{else}
no
{/if}</span></span></div>