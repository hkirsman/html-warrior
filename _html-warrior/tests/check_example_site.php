<?php

$pages = array(
    "index" => "http://127.0.0.1:8080/example_site/index.html",
    "partials" => "http://127.0.0.1:8080/example_site/partials.html",
    "about" => "http://127.0.0.1:8080/example_site/about.html",
);

$pages_hashes = array(
    "index" => "ce6888f594bcdf6d366d4bd10ffb0db6",
    "partials" => "dbcc92e4f9a63218ea3f168285b6c0e7",
    "about" => "e63d06d40ad0e3f26d8733cc30114a22",
);

foreach($pages as $key=>$var) {
   $hash = md5(file_get_contents($var));
   echo $pages[$key] . " ... ";
   if ($hash == $pages_hashes[$key]) {
       echo "ok\n";
   } else {
       echo "fail\n";
   }
}