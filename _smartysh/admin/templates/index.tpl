<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
   "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="et">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="/_smartysh/admin/style/reset.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/_smartysh/admin/style/_style.css" media="all" title="" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" href="favicon.png" type="image/png" />
    <!--[if lt IE 8]>
    <link href="/_smartysh/admin/style/style_lt_ie8.css" rel="stylesheet" type="text/css" media="screen" />
    <![endif]-->
    <!--[if IE 6]>
    <link href="/_smartysh/admin/style/style_ie6.css" rel="stylesheet" type="text/css" media="screen" />
    <![endif]-->
    <title>Smarty'sh proto</title>
  </head>
  <body>
    
    <div id="header">
      <form>
        <div><input type="text" id="filter" class="filter" /> <button id="clearbutton" type="reset" >clear</button></div>
      <script type="text/javascript">
        var filter = document.getElementById("filter");
        filter.focus();
      </script>
      </form>
    </div>


    <div class="clear"></div>

    <div class="col col01">
      <h1>Proto Smarty access log</h1>
      {foreach $access_log as $key=>$var} 
        <div class="item"><a href="{$var.url}" project="{$var.name}">{$var.url}</a></div>
      {/foreach} 
    </div>

    <div class="col col01">
       <h1>Proto Smarty latest sites</h1>

      {foreach $files as $key=>$var}
        {if strpos($var["name"], "_")!==0 && is_dir($var["name"]) && $var["name"]!="templates_c" && strpos($var["name"], "-files")===false && strpos($var["name"], "-failid")===false}
          <div class="item"><a href="{$var.name}/index.html" project="{$var.name}">{$var.name}</a></div>
        {/if}
      {/foreach} 
    </div>

    
    <script type="text/javascript" src="/_smartysh/admin/scripts/external/jquery.js"></script>
    <script type="text/javascript" src="/_smartysh/admin/scripts/general.js"></script>
  </body>
</html>