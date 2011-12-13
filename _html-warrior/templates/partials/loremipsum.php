<?php

require_once($config["code_path"].'/externals/LoremIpsum.class.php');


$out = '';


if (!isset($params['withoutTags'])) {
  $params['withoutTags'] = true;
}


if (!$params['wordCount']) {
   $wordCount = 100;
} else {
  $wordCount = $params['wordCount'];
}


if (!$params['paragraphCount']) {
   $paragraphCount = 1;
} else {
  $paragraphCount = $params['paragraphCount'];
}


for($i=0;$i<$paragraphCount;$i++) {
  if ( !isset($loremIpsumGenerator) ) {
    $loremIpsumGenerator = new LoremIpsumGenerator;
  }
  $out .= $loremIpsumGenerator->getContent($wordCount)."\n";
}


if ($params['withoutTags']) {
  $out = strip_tags($out);
}


$params['out'] = $out;