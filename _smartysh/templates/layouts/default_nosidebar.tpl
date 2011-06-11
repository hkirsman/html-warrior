<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
   "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="et">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style/reset.css" media="all" />
    <link rel="stylesheet" type="text/css" href="style/theme_blue.css" media="all" title="" />
    <link rel="stylesheet" type="text/css" href="style/_style.css" media="all" title="" />
    <link rel="stylesheet" type="text/css" href="style/externals/jquery.ad-gallery.css" media="all" title="" />
    <link rel="stylesheet" type="text/css" href="style/print.css" media="print" title="" />
    <title>{$title}</title>
  </head>
  <body>
    <div id="header">
      <a href="index.xhtml"><img id="logo" src="images/base/logo.png" alt="" title="" /></a>
      <a href="javascript:void(0)"><img id="logo_tallinn_2011" src="images/base/logo_tallinn_2011.gif" alt="" title="" /></a>
      <form id="search" action="search.xhtml"><div><input type="text" name="" value="{$custom1}" /><button><span>otsi</span></button></div></form>
    </div><!-- .header -->
    <div id="nav" class="clearfix">
      <ul class="main lfloat">
        <li><a class="first" href="index.xhtml">Avaleht</a></li>
        <li><a {if $page == "program"}class="active" {/if}href="program.xhtml">Programm</a></li>
        <li><a href="text.xhtml">Kino</a></li>
        <li><a href="text.xhtml">Piletid</a></li>
        <li><a {if $page == "newslist"}class="active" {/if}href="newslist.xhtml">Press</a></li>
        <li><a href="text.xhtml">Põhuteatrist</a></li>
        <li><a href="text.xhtml">Toetajad</a></li>
        <li><a href="text.xhtml">Kontakt</a></li>
      </ul>
      <div class="clear"></div>
      <ul class="sub lfloat">
        <li><a class="first" href="javascript:void(0)">Programm</a></li>
        <li><a href="javascript:void(0)">kino</a></li>
        <li><a href="javascript:void(0)">piletid</a></li>
        <li><a href="javascript:void(0)">press</a></li>
        <li><a href="javascript:void(0)">põhuteatrist</a></li>
        <li><a href="javascript:void(0)">toetajad</a></li>
        <li><a href="javascript:void(0)">kontakt</a></li>
      </ul>
    </div>
    <div id="content" class="nosidebar clearfix">
      {$yield}
    </div><!-- #content -->
    <div id="footer">
      <ul id="lang">
        <li><a class="active" href="javascript:void(0)">Est</a></li>
        <li><a href="javascript:void(0)">Eng</a></li>
      </ul>

      <ul class="menu">
      	<li><a class="first" href="javascript:void(0)">Facebook</a><span>/</span></li>
        <li><a href="javascript:void(0)">Twitter</a><span>/</span></li>
        <li><a class="last" href="http://itunes.apple.com/ee/app/kultuuri-net/id347634730?mt=8">iPhone</a></li>
      </ul>
    </div><!-- #footer -->
    <!--[if lte IE 6]>
    <script type="text/javascript" src="scripts/supersleight.js"></script>
    <![endif]-->
    <script type="text/javascript" src="scripts/externals/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="scripts/externals/jquery.ad-gallery.js"></script>
    <script type="text/javascript" src="scripts/general.js"></script>
  </body>
</html>