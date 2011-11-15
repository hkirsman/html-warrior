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
            <option value="html5">html5</option>
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
      <div><strong>Partial was not found.</strong> <a href="{$runtime.url}&amp;copy_and_return=1">Copy and return to site</a></div>

      <div>
        <textarea id="partial_css" cols="60" rows="10" style="border:1px solid gray; padding: 5px; margin: 20px 0;">{$partial.css}</textarea>
        {literal}
          <script type="text/javascript">
            document.getElementById('partial_css').onclick = function() {
              this.select()
            }
          </script>
        {/literal}
      </div>


    </div>

    <script type="text/javascript" src="{$config.path_code}/admin/scripts/externals/jquery.js"></script>
    <script type="text/javascript" src="{$config.path_code}/admin/scripts/externals/jquery-ui.js"></script>
    <script type="text/javascript" src="{$config.path_code}/admin/scripts/general.js"></script>
  </body>
</html>