<span{if (isset($rowclass) && $rowclass!='') || !isset($rowclass) || $error} class="{if isset($rowclass)}{$rowclass}{else}frmrow{/if}{if $error} error{/if}"{/if}>
  <span class="selectDate1">
    <span class="frmcaption">{if $label_caption}{$label_caption}{else}label_caption{/if}</span><span class="selDate">
      {html_select_date prefix="" month_extra="class='month'" day_extra="class='day'" year_extra="class='year'"}
    </span>
  </span>
</span>