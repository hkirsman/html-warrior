<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
   "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="et">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="/_smartysh/admin/style/reset.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/_smartysh/admin/style/_style.css" media="all" title="" />
    <link rel="stylesheet" type="text/css" href="/_smartysh/admin/style/jquery-ui.css" media="all" title="" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" href="favicon.png" type="image/png" />
    <!--[if lt IE 8]>
    <link href="/_smartysh/admin/style/style_lt_ie8.css" rel="stylesheet" type="text/css" media="screen" />
    <![endif]-->
    <!--[if IE 6]>
    <link href="/_smartysh/admin/style/style_ie6.css" rel="stylesheet" type="text/css" media="screen" />
    <![endif]-->
    <title>Smartysh</title>
  </head>
  <body>

    <div id="header">
      <div class="rfloat">
        <div><input type="text" id="filter" class="filter" value="Search"
              onclick="if(this.value=='Search'){ this.value=''; }"
              onblur="if(this.value==''){ this.value='Search'; }" /></div>
        <script type="text/javascript">
          var filter = document.getElementById("filter");
          filter.focus();
        </script>
      </div>
      <h1 class="logo sidefloat">Smartysh</h1>
    </div>

    <div id="content">
      <div class="col col01">
        <h1>Page access log</h1>
        {foreach $access_log as $key=>$var}
          <div class="item"><a href="{$var.url}" project="{$var.name}">{$var.url_wo_slash}</a></div>
        {/foreach}
      </div>

      <div class="col col01">
         <h1>Site access log</h1>
        {foreach $access_log_site as $key=>$var}
          <div class="item"><a href="{$var}" project="{$var}">{$var}</a></div>
        {/foreach}
      </div>

      <div class="col col01">
         <h1>All sites (newer first)</h1>

        {foreach $files as $key=>$var}
          {if strpos($var["name"], "_")!==0 && $var["type"]=="dir" && strpos($var["name"], "-files")===false && strpos($var["name"], "-failid")===false && strpos($var["name"], ".")===false}
            <div class="item"><a href="{$var.name}/index.html" project="{$var.name}">{$var.name}</a></div>
          {/if}
        {/foreach}
      </div>
    </div>

    <script type="text/javascript" src="/_smartysh/admin/scripts/externals/jquery.js"></script>
    <script type="text/javascript" src="/_smartysh/admin/scripts/externals/jquery-ui.js"></script>
    <script type="text/javascript" src="/_smartysh/admin/scripts/general.js"></script>
  </body>
</html>