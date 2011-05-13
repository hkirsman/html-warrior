{strip}
  <span class="{if isset($rowclass)}{$rowclass}{else}frmrow{/if} input_{$type}{if $class_extra} {$class_extra}{/if}{if $error} error{/if}">
    <label class="{if $frmcaptionclass}{$frmcaptionclass}{else}frmcaption{/if}">{if $label_caption}{$label_caption}{else}label_caption{/if}</label>
    <span class="input">
      {if $type=="text"}
        <input type="text" name="" value="{$value}" />
      {else if $type=="textarea"}
        <span><textarea rows="5" cols="60">{$value}</textarea></span>
      {else if $type=="check_one"}
        {foreach from=$values key=key item=item name=check_one}
          <span><input type="radio" class="radio lfloat" value="" name="" /><label class="sidefloat">{$item}</label></span>
        {/foreach}
      {else if $type=="check_many"}
        {foreach from=$values key=key item=item name=check_many}
          <span><input type="checkbox" class="checkbox lfloat" value="" name="" /><label class="sidefloat">{$item}</label></span>
        {/foreach}
      {else if $type=="select"}
        <select name="">
          {foreach from=$values key=key item=item name=select}
            <option value="">{$item}</option>
          {/foreach}
        </select>
      {else if $type=="multiselect"}
        <select multiple="multiple" name="">
          {foreach from=$values key=key item=item name=multiselect}
            <option value="">{$item}</option>
          {/foreach}
        </select>
      {/if}
    </span>
  </span>
{/strip}