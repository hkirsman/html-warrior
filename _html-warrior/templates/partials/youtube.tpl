{strip}
  {php}
  global $site_dir, $smarty;
  $defaultWidth = 595;
  $defaultHeight = 390;
  $width = $smarty->getTemplateVars("width");
  $height = $smarty->getTemplateVars("height");
  if ( !isset($width) && !isset($height) ) {
    $width = $defaultWidth;
    $height = $defaultHeight;
  } else if ( !isset($width) && isset($height) ) {
    $width = round($defaultWidth * ($height/390));
  } else if ( isset($width) && !isset($height) ) {
    $height = round($defaultHeight * ($width/$defaultWidth));
  }
  $smarty->assign("width",$width);
  $smarty->assign("height",$height);
  {/php}
  <object width="{$width}" height="{$height}">
    <param name="movie" value="http://www.youtube.com/v/{$video_id}?fs=1&amp;hl=en_US&amp;rel=0"></param>
    <param name="allowFullScreen" value="true"></param>
    <param name="allowscriptaccess" value="always"></param>
    <param name="wmode" value="transparent"></param>
    <embed src="http://www.youtube.com/v/{$video_id}?fs=1&amp;hl=en_US&amp;rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="{$width}" height="{$height}" wmode="transparent"></embed>
  </object>
  {php}
    global $smarty;
    $smarty->clearAssign("width");
    $smarty->clearAssign("height");
  {/php}
{/strip}