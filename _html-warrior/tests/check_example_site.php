<?php

$pages = array(
    'index' => 'http://127.0.0.1:8080/example_site/index.html',
    'partials' => 'http://127.0.0.1:8080/example_site/partials.html',
    'about' => 'http://127.0.0.1:8080/example_site/about.html',
);

$pages_hashes = array(
    'index' => '15494f30dadfcad676b156ccd4230c4b',
    'partials' => '3b14647c9b51c7ccb921ba4169fed9ae',
    'about' => 'c1f060ede0e5e3ac7811d529d557268f',
);

foreach($pages as $key=>$var) {
   $hash = md5(file_get_contents($var));
   //echo $hash . "\n";
   echo $pages[$key] . ' ... ';
   if ($hash == $pages_hashes[$key]) {
       echo "ok\n";
   } else {
       echo "fail\n";
   }
}