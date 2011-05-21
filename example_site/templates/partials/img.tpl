{strip}
  {php}
  global $config, $site_dir, $smarty;

  $width = $smarty->getTemplateVars("width");
  $height = $smarty->getTemplateVars("height");

  if ( array_key_exists("src", $smarty->tpl_vars) ) {
    $src = $smarty->tpl_vars["src"]->value;
  } else {
    $src = $smarty->tpl_vars["file"]->value;
  }

  if ( !isset($width) && !isset($height) ) { 
    $full_image_path = $config["basepath"] . "/" . $site_dir . "/images/".$src;
    list($width, $height) = getimagesize($full_image_path);
  }
  $smarty->assign("width",$width);
  $smarty->assign("height",$height);
  $smarty->assign("src",$src);
  {/php}
  {if isset($href) || isset($onclick)}
    <a href="{if isset($href)}{$href}{else}javascript:void(0){/if}"{if isset($onclick)} onclick="{$onclick}"{/if}{if isset($aclass)} class="{$aclass}"{/if}>
  {/if}
    <img src="images/{$src}" alt="{$alt}" title="{$alt}" {if $class}class="{$class}" {/if}{if $id}id="{$id}" {/if}{if !$nodimension}{if isset($width)}width="{$width}" {/if}{if isset($height)}height="{$height}" {/if}{/if}{if $align}style="{if $align=='center'}display:block;margin-left:auto;margin-right:auto;{else}float: {$align}{/if}" {/if}{if isset($border)}border="{$border}" {/if}/>
  {if isset($href) || isset($onclick)}
    </a>
  {/if}

  {php}
    global $smarty;
    $smarty->clearAssign("width");
    $smarty->clearAssign("height");
  {/php}
{/strip}