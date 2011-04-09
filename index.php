<?php

//if(strpos($_SERVER["HTTP_USER_AGENT"], "MSIE"))
header('Content-Type: text/html; charset=utf-8');
//else
//header('Content-type: application/xhtml+xml; charset=utf-8');

require '_smartysh/config.php';
require $config["code_path"] . '/init.php';
require $config["code_path"] . '/externals/smarty/libs/Smarty.class.php';
require_once($config["code_path"] . '/filesystem.php');

$exploded_url = explode("/", trim($_SERVER["REQUEST_URI"], "/"));
$site_dir = $exploded_url[0];

$smarty = new Smarty;
$smarty->allow_php_tag = true;

$smarty->assign("config", $config);

// admin
if ($site_dir == "") {
    $smarty->template_dir = $config["code_path"] . "/admin/templates/";
    $smarty->assign("access_log", get_access_log(array("limit" => 10)));

    $files = dir_list($config["basepath"]);
    foreach ($files as &$ma)
        $tmp[] = &$ma["timestamp"];
    array_multisort($tmp, SORT_DESC, $files, SORT_DESC);
    $smarty->assign("files", $files);
    /*
      echo '<input type="text" id="filter" />';
      echo '
      <script type="text/javascript">
      var filter = document.getElementById("filter");
      filter.focus();
      </script>';


      echo "<h1>Proto Smarty access log</h1>";
      $access_log = ;

      foreach($access_log as $key=>$var) {
      echo '<a href="'.$var["url"].'">'.$var["url"].'</a><br />';
      }

      echo "<h1>Proto Smarty latest sites</h1>";



      $files = dir_list( $config["basepath"] );
      foreach($files as &$ma)
      $tmp[] = &$ma["timestamp"];
      array_multisort($tmp, SORT_DESC, $files, SORT_DESC);
      foreach($files as &$ma)
      if(strpos($ma["name"], "_")!==0 && is_dir($ma["name"]) && $ma["name"]!="templates_c" && strpos($ma["name"], "-files")===false && strpos($ma["name"], "-failid")===false ) {
      echo '<div><a href="/'.$ma["name"].'/index.html">'.$ma["name"].'</a></div>';
      }

      echo "<h1>Latest opened files</h1>";
     */
    $smarty->display("index.tpl");
    die();
}

// build all templates
// todo build also logged templates
if (isset($_GET["build"])) {
    if ($_GET["build"] == 1) {
        require_once($config["code_path"] . '/build.php');
        die("Site build done... go to <a href=\"index.html\">frontpage</a>");
    }
}

$smarty->template_dir = $site_dir . "/templates/";
//$smarty->force_compile = true;

$smarty->error_reporting = ~E_NOTICE;

// clean url from parameters
// like form search
$_SERVER["REQUEST_URI"] = url_remove_parameters($_SERVER["REQUEST_URI"]);

// temp hack
$request_uri = explode("/", trim($_SERVER["REQUEST_URI"], "/"));


if (!isset($request_uri[1])) {
    $page = "index";
} else {
    $request_uri[1] = str_replace(".html", "", $request_uri[1]);
    $page = $request_uri[1];
}

if (isset($_GET["debug"])) {
    $debug = $_GET["debug"];
} else {
    $debug = 1;
}
$smarty->assign("debug", $debug);

$smarty->assign("page", $page); // cool var; must stay in future code
// shortcut for frontpage
if ($page == "index" || $page == "index__logged")
    $smarty->assign("frontpage", true);
else
    $smarty->assign("frontpage", false);

// template copy if not exists
if (!file_exists($config["basepath"] . "/" . $smarty->template_dir . "/pages/" . $page . ".tpl") && !strpos($request_uri[1], "__logged")) {
    echo '<div style="background: red">Templatet ei ole olemas. Kopeerin uue?. <a href="?copy=yes">jah</a></div>';
    if (@$_GET["copy"] == "yes") {
        if (copy($config["code_path"] . "/templates/pages/" . $page . ".tpl", $config["basepath"] . "/" . $smarty->template_dir . "pages/" . $page . ".tpl")) {
            echo "done";
        } else {
            echo $config["code_path"] . "/templates/pages/" . $page . ".tpl does not exist!";
        }
    }
    die();
}
// logged and not logged switching
if (@strpos($request_uri[1], "__logged")) {
    $smarty->assign("logged_sufix", "__logged");
    $smarty->assign("logged", true);
    $page_content = $smarty->fetch("pages/" . str_replace("__logged", "", $page) . ".tpl");
    $template_filetime = filemtime($config["basepath"] . "/$site_dir/templates/pages/" . str_replace("__logged", "", $page) . ".tpl");
} else {
    $smarty->assign("logged_sufix", "");
    $smarty->assign("logged", false);
    $page_content = $smarty->fetch("pages/" . $page . ".tpl");
    $template_filetime = filemtime($config["basepath"] . "/$site_dir/templates/pages/" . $page . ".tpl");
}
$page_variables = parse_variables($page_content);

if (!isset($page_variables["layout"])) {
    $layout = "default";
} else {
    $layout = $page_variables["layout"];
}
$layout_path = "layouts/" . $layout . ".tpl";

$variable_indents = get_indents_for_variables(file_get_contents("$site_dir/templates/" . $layout_path));

if (isset($page_variables["title"]))
    $smarty->assign("title", $page_variables["title"]);
else
    $smarty->assign("title", "");

if (isset($page_variables["custom1"]))
    $smarty->assign("custom1", $page_variables["custom1"]);
else
    $smarty->assign("custom1", "");


$smarty->assign("yield", indent(remove_variables($page_content), $variable_indents["yield"]));

// add access log; must be after frontpage so we don't log that
add_access_log(array("url" => $_SERVER["REQUEST_URI"]));

require_once($site_dir . "/cfg/config.php");

ob_start("callback");
$smarty->display($layout_path);
$smarty->assign("debug", 0);
$content = $smarty->fetch($layout_path);
ob_end_flush();

build_template($config["basepath"] . "/$site_dir/" . $config["build_dir"] . "/" . $page . ".html", $content, $template_filetime);

// write file to $path
function build_template($path, $content, $touchtime = false) {
    $fh = fopen($path, 'w') or die("can't open file");
    fwrite($fh, $content);
    fclose($fh);
    if ($touchtime) {
        touch($path, $touchtime); // set time
    }
}

// get variables from template
// example:
// @layout = "contact"
function parse_variables($content) {
    $variables = array();
    $file = explode("\n", $content);
    foreach ($file as $key => $var) {
        if (preg_match("/^@/", $var)) {
            $tempvar = explode(" = ", $var);
            $tempvar_key = trim(str_replace("@", "", $tempvar[0]));
            $tempvar_value = trim(str_replace('"', "", $tempvar[1]));
            $variables[$tempvar_key][] = $tempvar_value;
        }
    }
    foreach ($variables as $key => $var) {
        if (count($var) == 1) {
            $variables[$key] = $var[0];
        } else {
            $variables[$key] = $var;
        }
    }
    return $variables;
}

// remove @ variables from template
function remove_variables($content) {
    $file = explode("\n", $content);
    foreach ($file as $key => $var) {
        if (preg_match("/^@/", $var)) {
            unset($file[$key]);
        }
    }
    return implode("\n", $file);
}

/*
  $indent = amount of tabs or spaces
 */

function indent($content, $indent, $ignore_first_row=true, $char="  ") {
    $file = explode("\n", $content);
    $real_indent = "";
    for ($i = 0; $i < $indent; $i++) {
        $real_indent = " " . $real_indent;
    }
    for ($i = 0; $i < count($file); $i++) {
        if ($ignore_first_row && $i == 0) {
            continue;
        }
        $file[$i] = $real_indent . $file[$i];
    }
    return implode("\n", $file);
}

// todo: ($pos-1)/2; --> calculate real indent with help of config
function get_indents_for_variables($content) {
    global $config;
    $indents = array();
    $file = explode("\n", $content);
    for ($i = 0; $i < count($file); $i++) {
        $pos = strpos($file[$i], "{\$");
        if ($pos !== false) {
            preg_match("/{\\$.*}/iU", $file[$i], $mt);
            $variable = str_replace(array("{", "\$", "}"), "", $mt[0]);
            $indents[$variable] = $pos;
        }
    }
    return $indents;
}

function url_remove_parameters($uri) {
    $uri_new = explode("?", $uri);
    return $uri_new[0];
}

// unified javascript tag
function html_javascript($file) {
    return '<script type="text/javascript" src="scripts/' . $file . '.js"></script>';
}

// unified style link tag
function html_css($file, $media=false) {
    return '<link rel="stylesheet" type="text/css" href="style/' . $file . '.css" ' . ($media ? " media=\"" . $media . "\"" : " media=\"all\"") . ' title="" />';
}

?>