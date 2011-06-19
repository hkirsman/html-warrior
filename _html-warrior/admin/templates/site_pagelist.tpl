<div id="htmlwarrior__pagelist" class="htmlwarrior" style="left: {if $template_list_opened}-200{else}-2000{/if}px;">
  <div id="htmlwarrior__pagelist-inner">
    <div style="padding: 2px 0;">
      <a href="/" style="font-size: 14px; color: #404040; text-decoration: none; font-weight: bold;">HTML Warrior</a>
    </div>
    <table style="color:black" class="htmlwarrior_templatelist">
      <tbody>
        <tr>
          <td colspan="2">
            edit <a href="{$site_filelist_page_edit_link}" class="htmlwarrior_templatelist_active">this page</a>
            or <a class="htmlwarrior_templatelist_active" href="{$site_filelist_layout_edit_link}">layout</a>
          </td>
        </tr>
        <tr>
          <td colspan="2" style="height: 7px"></td>
        </tr>
        {foreach $site_filelist_template_list as $key=>$var}
          <tr>
            <td style="padding-right: 10px;"><a {if $var.active}class="htmlwarrior_templatelist_active"  {/if}href="{$var.url}" style="font-weight:bold;">{$var.page}</a></td>
            <td><a {if $var.active}class="htmlwarrior_templatelist_active"  {/if} href="{$var.edit_url}" style="">(edit)</a></td>
          </tr>
        {/foreach}
      </tbody>
    </table>
  </div>
</div>