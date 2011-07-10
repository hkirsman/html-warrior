<?php

$pages = array(
    'index' => 'http://127.0.0.1:8080/example_site/index.html',
    'partials' => 'http://127.0.0.1:8080/example_site/partials.html',
    'about' => 'http://127.0.0.1:8080/example_site/about.html',
);

$pages_hashes = array(
    'index' => '1c74c8c9ef6b040269cbf9cfc6ae820c',
    'partials' => '99ef6c189be0e626777076232fbfb724',
    'about' => '05e7d0045b563462fe7f57be1dfd8e4a',
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