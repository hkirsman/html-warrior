<?php

$time_start = microtime(1);

set_time_limit(999);
error_reporting(~E_NOTICE);

header('Content-Type: text/html; charset=utf-8');

// init empty Smartysh class to add variables. Todo: create some method etc.
class Smartysh {}
$smartysh = new Smartysh();

require_once("includes/functions.php");
require 'config.php';
require $smartysh->config["code_path"] . '/init.php';
$smartysh->config = $smartysh->config; // todo: move $smartysh->config to object

if ( $smartysh->config["frontpage_site"] ) {
  $smartysh->runtime["site_dir"] = trim($smartysh->config["frontpage_site"], "/");
} else {
  $site_dir = explode("/", trim($smartysh->runtime["parsed_url"]["path"], "/"));
  $smartysh->runtime["site_dir"] = current($site_dir);
  unset($site_dir);
}

$smarty->assign("config", $smartysh->config);

$smarty->loadFilter("pre", "fix_smarty_syntax_indents");
$smarty->loadFilter("pre", "add_partial_indents");
$smarty->loadFilter("output", "fix_smarty_syntax_indents");

// admin
if ( $smartysh->config["frontpage_site"] === false ) {
  if ($smartysh->runtime["site_dir"] == "") {
      if (isset($_GET["action"])) {
          if ($_GET["action"] == "new_project") {
              if (isset($_GET["name"])) {
                  echo "todo new ";
              } else {
                  die("name attribute needed");
              }
          }
      }

      $smarty->template_dir = $smartysh->config["code_path"] . "/admin/templates";
      $smarty->assign("access_log", get_access_log(array("limit" => 10)));

      $smarty->assign("access_log_site", get_site_access_log(array("limit" => 10)));

      $files = dir_list($smartysh->config["basepath"]);
      foreach ($files as &$ma)
          $tmp[] = &$ma["timestamp"];
      array_multisort($tmp, SORT_DESC, $files, SORT_DESC);
      $smarty->assign("files", $files);
      $smarty->display("index.tpl");
      die();
  }
}

// load custom site functions
if (file_exists($smartysh->config["basepath"] . "/" . $smartysh->runtime["site_dir"] . "/functions.php")) {
    require_once($smartysh->config["basepath"] . "/" . $smartysh->runtime["site_dir"] . "/functions.php");
}


// build all templates
// todo build also logged templates
if ( $smartysh->config["build"] ) {
  if (isset($_GET["build"])) {
      if ($_GET["build"] == 1) {
          require_once($smartysh->config["code_path"] . '/includes/build.php');
          die("Site build done... go to <a href=\"index.html\">frontpage</a>");
      }
  }
}

$smarty->template_dir = $smartysh->config["basepath"] . "/".$smartysh->runtime["site_dir"]."/templates";

$request_uri = explode("/", trim($smartysh->runtime["parsed_url"]["path"], "/"));

if ( $smartysh->config["live"]  ) {
  if (!isset($request_uri[0]) || $request_uri[0]=="") {
      $smartysh->page = "index";
  } else {
      $request_uri[0] = str_replace(".html", "", end($request_uri));
      $smartysh->page = $request_uri[0];
  }
} else {
  if (!isset($request_uri[1])) {
      $smartysh->page = "index";
  } else {
      $request_uri[1] = str_replace(".html", "", end($request_uri));
      $smartysh->page = $request_uri[1];
  }
}

if (isset($_GET["debug"])) {
    $debug = $_GET["debug"];
} else {
    $debug = 1;
}
$smarty->assign("debug", $debug);

$smarty->assign("page", $smartysh->page); // cool var; must stay in future code
// shortcut for frontpage
if ($smartysh->page == "index" || $smartysh->page == "index__logged") {
    $smarty->assign("frontpage", true);
} else {
    $smarty->assign("frontpage", false);
}

/*
// template copy if not exists
if (!file_exists($smarty->template_dir . "/pages/" . $smartysh->page . ".tpl") && !strpos($request_uri[1], "__logged")) {
    echo '<div style="background: red">Templatet ei ole olemas. Kopeerin uue?. <a href="?copy=yes">jah</a></div>';
    if (@$_GET["copy"] == "yes") {
        if (copy($smarty->template_dir . "/pages/" . $smartysh->page . ".tpl", $smartysh->config["basepath"] . "/" . $smarty->template_dir . "/pages/" . $smartysh->page . ".tpl")) {
            echo "done";
        } else {
            echo $smarty->template_dir . "/pages/" . $smartysh->page . ".tpl does not exist!";
        }
    }
    die();
}
 */

// logged and not logged switching
if (@strpos($request_uri[1], "__logged")) {
    $smarty->assign("logged_sufix", "__logged");
    $smartysh->logged_sufix = "__logged";
    $smarty->assign("logged", true);
    $smartysh->logged = true;

} else {
    $smarty->assign("logged_sufix", "");
    $smartysh->logged_sufix = "";
    $smarty->assign("logged", false);
    $smartysh->logged = false;
}
$page_content = $smarty->fetch(get_page_template_path($smartysh->runtime["parsed_url"]["path"]));
if ($smartysh->config["build"]) {
  $template_filetime = filemtime(get_page_template_path($smartysh->runtime["parsed_url"]["path"]));
}
$page_variables = parse_variables($page_content);

if (!isset($page_variables["layout"])) {
    $smartysh->layout = "default";
} else {
    $smartysh->layout = $page_variables["layout"];
}
$layout_path = "layouts/" . $smartysh->layout . ".tpl";
$variable_indents = get_indents_for_variables(file_get_contents($smarty->template_dir . "/" . $layout_path));

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
if ( $smartysh->config["log"] ) {
  add_access_log(array(
      "site_dir" => $smartysh->runtime["site_dir"],
      "url" => $_SERVER["REQUEST_URI"]
  ));
}

require_once($smartysh->config["basepath"] . "/".$smartysh->runtime["site_dir"]."/cfg/config.php");

//require_once("filelist.php");

ob_start("callback");
$smarty->display($layout_path);
$smarty->assign("debug", 0);
$content = $smarty->fetch($layout_path);
@ob_end_flush();

if ( $smartysh->config["build"] ) {
  build_template($smartysh->config["basepath"] . "/".$smartysh->runtime["site_dir"]."/" . $smartysh->config["build_dir"] . "/" . $smartysh->page . ".html", $content, $template_filetime);
}

if ($smartysh->config["debug"]) {
    $time_end = microtime(1) - $time_start;
    echo "<!--";
    echo("Script load time: " . $time_end);
    echo "-->";
}
?>