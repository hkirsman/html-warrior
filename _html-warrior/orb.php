<?php

require_once("init.php");

$args = $_GET;

// load class
if (isset($args["class"])) {
    $cl = classload($args["class"]);
} else {
    die("class not set");
}

// load method aka class
if (isset($args["class"])) {
    $cl->$args["action"]($args);
} else {
    die("action not set");
}