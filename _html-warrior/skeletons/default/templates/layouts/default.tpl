<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
   "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="et">
  <head>
    {htmlwarrior_init}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style/reset.css" media="all" />
    <link rel="stylesheet" type="text/css" href="style/style.css" media="all" title="" />
    <link rel="stylesheet" type="text/css" href="style/print.css" media="print" title="" />
    {htmlwarrior_plugins indent="    "}
    <title>{$title}</title>
    <!--[if lt IE 8]>
    <link href="style/style_lt_ie8.css" rel="stylesheet" type="text/css" media="screen" />
    <![endif]-->
  </head>
  <body>
    {partial template="oldbrowser"}
    <div id="wrapper">
      <div id="header">
        <a id="logo" href="index{$logged_sufix}.html">{partial tpl="img" src="base/logo.jpg"}</a>
      </div><!-- #header -->
      <div id="nav">
        <ul>
          <li><a {if $page == "index"}class="active" {/if}href="javascript:void(0)">Frontpage</a></li>
          <li><a href="javascript:void(0)"></a></li>
          <li><a href="javascript:void(0)"></a></li>
          <li><a href="javascript:void(0)"></a></li>
        </ul>
      </div>
      <div id="content">
        {$yield}
      </div><!-- #content -->
      <div id="footer">

      </div><!-- #footer -->
    </div><!-- #wrapper -->
    {htmlwarrior_plugins position="bottom" indent="    "}
    {partial tpl=script file="general"}
    {htmlwarrior_init position="bottom"}
  </body>
</html>