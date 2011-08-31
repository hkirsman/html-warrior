<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
   "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="et">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="{$config.path_code}/admin/style/reset.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{$config.path_code}/admin/style/_style.css" media="all" title="" />
    <link rel="stylesheet" type="text/css" href="{$config.path_code}/admin/style/jquery-ui.css" media="all" title="" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" href="favicon.png" type="image/png" />
    <title>HTML Warrior</title>
  </head>
  <body>

    <div id="header">
      <div class="rfloat">
        <div><input type="text" id="filter" class="filter" value="{$txt.admin_search}"
              onclick="if(this.value=='{$txt.admin_search}'){ this.value=''; }"
              onblur="if(this.value==''){ this.value='{$txt.admin_search}'; }" /></div>
        <script type="text/javascript">
          var filter = document.getElementById("filter");
          filter.focus();
        </script>
      </div>
      <h1 class="logo sidefloat">HTML Warrior</h1>
    </div>

    <div id="newsite">
      <form action="{$config.path_code}/orb.php">
        <input type="hidden" name="class" value="site" />
        <input type="hidden" name="action" value="create" />
        <input type="hidden" name="redirect" value="1" />

        <div>
          {$txt.admin_create_site}:
          <select name="donor">
            <option value="default">default</option>
            <option value="newsletter">newsletter</option>
          </select>

          <input type="text" name="site_name" value="{$txt.admin_new_site_name}"
                  onclick="if(this.value=='{$txt.admin_new_site_name}'){ this.value=''; }"
                  onblur="if(this.value==''){ this.value='{$txt.admin_new_site_name}'; }" />

          <button><span>{$txt.admin_create}</span></button>
        </div>
      </form>
    </div>

    <div id="content">
      <div class="col col01">
        <h1>{$txt.admin_page_access_log}</h1>
        {foreach $access_log as $key=>$var}
          <div class="item"><a href="{$var.url}" project="{$var.name}">{$var.url_wo_slash}</a></div>
        {/foreach}
      </div>

      <div class="col col01">
         <h1>{$txt.admin_site_access_log}</h1>
        {foreach $access_log_site as $key=>$var}
          <div class="item"><a href="{$var}" project="{$var}">{$var}</a></div>
        {/foreach}
      </div>

      <div class="col col01">
         <h1>{$txt.admin_all_sites}</h1>

        {foreach $files as $key=>$var}
          {if strpos($var["name"], "_")!==0 && $var["type"]=="dir" && strpos($var["name"], "-files")===false && strpos($var["name"], "-failid")===false && strpos($var["name"], ".")===false}
            <div class="item"><a href="{$var.name}/index.html" project="{$var.name}">{$var.name}</a></div>
          {/if}
        {/foreach}
      </div>
    </div>

    <script type="text/javascript" src="{$config.path_code}/admin/scripts/externals/jquery.js"></script>
    <script type="text/javascript" src="{$config.path_code}/admin/scripts/externals/jquery-ui.js"></script>
    <script type="text/javascript" src="{$config.path_code}/admin/scripts/general.js"></script>
  </body>
</html>