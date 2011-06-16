{php}
global $config, $wordCount, $smarty;
require_once($config["code_path"].'/externals/LoremIpsum.class.php');

if (!$smarty->tpl_vars['wordCount']->value) {
   $wordCount = 100;
} else {
  $wordCount = $smarty->tpl_vars['wordCount']->value;
}

if (!$smarty->tpl_vars['paragraphCount']->value) {
   $paragraphCount = 1;
} else {
  $paragraphCount = $smarty->tpl_vars['paragraphCount']->value;
}

for($i=0;$i<$paragraphCount;$i++) {
  if ( !isset($loremIpsumGenerator) ) {
    $loremIpsumGenerator = new LoremIpsumGenerator;
  }
  echo $loremIpsumGenerator->getContent($wordCount)."\n";
}
{/php}