<?php

$pages = array(
    'index' => 'http://127.0.0.1:8080/example_site/index.html',
    'partials' => 'http://127.0.0.1:8080/example_site/partials.html',
    'about' => 'http://127.0.0.1:8080/example_site/about.html',
);

$pages_hashes = array(
    'index' => '648585c16903b904c15dc5b6df32d156',
    'partials' => 'f482ad1c529459a794b8d023e40110a8',
    'about' => '95f560c3b31674d7a4657e2df719f0c3',
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