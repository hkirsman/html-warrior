<?php
$link = mysqli_connect($config["db"]["server"], $config["db"]["username"], $config["db"]["password"]);
if (!$link) {
    die("Could not connect: " . mysql_error() );
}
mysqli_select_db($link, $config["db"]["db"]);
//mysql_set_charset('utf8',$link); 
//mysqli_query($this->link, "SET NAMES 'utf8'");
mysqli_set_charset($link, 'utf8'); 
?>