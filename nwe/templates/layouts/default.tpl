<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
   "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="et">
  <head>
    {htmlwarrior_init}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style/fonts/customfonts.css" media="all" />
    <link rel="stylesheet" type="text/css" href="style/reset.css" media="all" />
    <link rel="stylesheet" type="text/css" href="style/style.css" media="all" title="" />
    <link rel="stylesheet" type="text/css" href="style/print.css" media="print" title="" />
    {htmlwarrior_plugins indent="    "}
    <title>{$title}</title>
  </head>
  <body>
    <div id="header">
      <ul id="lang" class="daxmedium">
        <li><a href="">eNG</a></li>
        <li class="spacer">|</li>
        <li><a href="">RUS</a></li>
        <li class="spacer">|</li>
        <li><a href="">FIN</a></li>
        <li class="spacer">|</li>
        <li><a href="">SWE</a></li>
        <li class="spacer">|</li>
        <li><a href="">NOR</a></li>
      </ul>
      <a id="logo" href="index{$logged_sufix}.html">{partial tpl="img" src="base/logo.png"}</a>
    </div><!-- #header -->

    {*
    <div id="nav" class="daxmedium">
      <ul>
        <li class="{if $page == 'index'}active {/if}cat-item">
          <a href="javascript:void(0)"><span>Firmast</span></a>
          <ul class="children hidden">
            <li><a href="">Ajalugu</a></li>
            <li><a href="">Missioon</a></li>
            <li><a href="">Visioon</a></li>
            <li><a href="">Usaldus</a></li>
          </ul>
        </li>
        <li><a href="javascript:void(0)"><span>Teenused</span></a></li>
        <li><a href="javascript:void(0)"><span>Ost/müük</span></a></li>
        <li><a href="javascript:void(0)"><span>Masinapark</span></a></li>
        <li><a href="javascript:void(0)"><span>Kontakt</span></a></li>
      </ul>
    </div>
    *}

    <div class="daxmedium" id="nav">
      <ul class="menu" id="menu-nav_et">
        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-39" id="menu-item-39">
          <a href="http://nwe.hanneskirsman.com/firmast/">Firmast</a>
          <ul class="sub-menu">
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-34" id="menu-item-34"><a href="http://nwe.hanneskirsman.com/ajalugu/">Ajalugu</a></li>
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-33" id="menu-item-33"><a href="http://nwe.hanneskirsman.com/missioon/">Missioon</a></li>
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-32" id="menu-item-32"><a href="http://nwe.hanneskirsman.com/visioon/">Visioon</a></li>
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-31" id="menu-item-31"><a href="http://nwe.hanneskirsman.com/usaldus/">Usaldus</a></li>
          </ul>
        </li>
        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-38" id="menu-item-38"><a href="http://nwe.hanneskirsman.com/teenused/">Teenused</a></li>
        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-37" id="menu-item-37"><a href="http://nwe.hanneskirsman.com/ostmuuk/">Ost/müük</a></li>
        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-36" id="menu-item-36">
          <a href="http://nwe.hanneskirsman.com/masinapark/">Masinapark</a>
          <ul class="sub-menu">
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30" id="menu-item-30"><a href="http://nwe.hanneskirsman.com/testileht/">Teine tase test</a></li>
          </ul>
        </li>
        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-35" id="menu-item-35"><a href="http://nwe.hanneskirsman.com/kontakt/">Kontakt</a></li>
      </ul>
    </div>


    <div id="splash">
      <div id="splash-inner">
        {if $page=="index"}
          <div id="splash-inner2">
            <div id="splash-inner3">
              <ul id="splash-menu" class="daxregular">
                <li class="active"><a href="">Hakkepuidu tootmine</a></li>
                <li class="spacer"><!-- --></li>
                <li><a href="">Raieteenus</a></li>
                <li class="spacer"><!-- --></li>
                <li><a href="">Kinnistute ja kasvava metsa ost/müük</a></li>
                <li class="spacer"><!-- --></li>
                <li><a href="">Metsamaterjali ost</a></li>
                <li class="spacer"><!-- --></li>
                <li><a href="">Väljaveoteenus</a></li>
              </ul>
              <div id="splash-content-wrapper">
                <div class="splash-content">
                  {partial tpl="img" src="data/sisupilt1.png" align="right"}
                  <h2>Hakkepuidu tootmine</h2>
                  <div class="text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do ex ea commodo consequat.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                  </div>
                </div>
                <div class="splash-content">
                  {partial tpl="img" src="data/sisupilt1.png" align="right"}
                  <h2>Raieteenus</h2>
                  <div class="text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                  </div>
                </div>
                <div class="splash-content">
                  {partial tpl="img" src="data/sisupilt1.png" align="right"}
                  <h2>Kinnistute ja kasvava metsa ost/müük</h2>
                  <div class="text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do ex ea commodo consequat.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                  </div>
                </div>
                <div class="splash-content">
                  {partial tpl="img" src="data/sisupilt1.png" align="right"}
                  <h2>Metsamaterjali ost</h2>
                  <div class="text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do ex ea commodo consequat.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                  </div>
                </div>
                <div class="splash-content">
                  {partial tpl="img" src="data/sisupilt1.png" align="right"}
                  <h2>Väljaveoteenus</h2>
                  <div class="text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do ex ea commodo consequat.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                  </div>
                </div>
              </div>
            </div>
            <div id="staple"></div>
          </div>
        {/if}
      </div>
    </div>
    <div id="content">
      {$yield}
    </div><!-- #content -->


    {htmlwarrior_plugins position="bottom" indent="    "}
    {partial tpl=script file="general"}
    {htmlwarrior_init position="bottom"}
  </body>
</html>