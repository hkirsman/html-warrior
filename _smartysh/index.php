<?php

$time_start = microtime(1);
set_time_limit(999);
//if(strpos($_SERVER["HTTP_USER_AGENT"], "MSIE"))
header('Content-Type: text/html; charset=utf-8');
//else
//header('Content-type: application/xhtml+xml; charset=utf-8');

require_once("includes/functions.php");
require 'config.php';
require $config["code_path"] . '/init.php';
require $config["code_path"] . '/externals/smarty/libs/Smarty.class.php';

$exploded_url = explode("/", trim($_SERVER["REQUEST_URI"], "/"));
$exploded_url = explode("?", $exploded_url[0]);
$site_dir = $exploded_url[0];
$smartysh->site_dir = $site_dir;

$smarty = new Smarty;
$smarty->allow_php_tag = true;

$smarty->assign("config", $config);

$smarty->loadFilter("pre", "fix_smarty_syntax_indents");
$smarty->loadFilter("pre", "add_partial_indents");
$smarty->loadFilter("output", "fix_smarty_syntax_indents");

// admin
if ($site_dir == "") {
    if (isset($_GET["action"])) {
        if ($_GET["action"] == "new_project") {
            if (isset($_GET["name"])) {
                echo "todo new ";
            } else {
                die("name attribute needed");
            }
        }
    }

    $smarty->template_dir = $config["code_path"] . "/admin/templates";
    $smarty->assign("access_log", get_access_log(array("limit" => 10)));

    $smarty->assign("access_log_site", get_site_access_log(array("limit" => 10)));

    $files = dir_list($config["basepath"]);
    foreach ($files as &$ma)
        $tmp[] = &$ma["timestamp"];
    array_multisort($tmp, SORT_DESC, $files, SORT_DESC);
    $smarty->assign("files", $files);
    $smarty->display("index.tpl");
    die();
}

// load custom site functions
if (file_exists($config["basepath"] . "/" . $smartysh->site_dir . "/functions.php")) {
    require_once($config["basepath"] . "/" . $smartysh->site_dir . "/functions.php");
}

// build all templates
// todo build also logged templates
if (isset($_GET["build"])) {
    if ($_GET["build"] == 1) {
        require_once($config["code_path"] . '/includes/build.php');
        die("Site build done... go to <a href=\"index.html\">frontpage</a>");
    }
}

$smarty->template_dir = $config["basepath"] . "/$site_dir/templates";
//$smarty->force_compile = true;

$smarty->error_reporting = ~E_NOTICE;

// clean url from parameters
// like form search
$_SERVER["REQUEST_URI"] = url_remove_parameters($_SERVER["REQUEST_URI"]);

// temp hack
$request_uri = explode("/", trim($_SERVER["REQUEST_URI"], "/"));


if (!isset($request_uri[1])) {
    $smartysh->page = "index";
} else {
    $request_uri[1] = str_replace(".html", "", $request_uri[1]);
    $smartysh->page = $request_uri[1];
}

if (isset($_GET["debug"])) {
    $debug = $_GET["debug"];
} else {
    $debug = 1;
}
$smarty->assign("debug", $debug);

$smarty->assign("page", $smartysh->page); // cool var; must stay in future code
// shortcut for frontpage
if ($smartysh->page == "index" || $smartysh->page == "index__logged")
    $smarty->assign("frontpage", true);
else
    $smarty->assign("frontpage", false);

// template copy if not exists
if (!file_exists($smarty->template_dir . "/pages/" . $smartysh->page . ".tpl") && !strpos($request_uri[1], "__logged")) {
    echo '<div style="background: red">Templatet ei ole olemas. Kopeerin uue?. <a href="?copy=yes">jah</a></div>';
    if (@$_GET["copy"] == "yes") {
        if (copy($smarty->template_dir . "/pages/" . $smartysh->page . ".tpl", $config["basepath"] . "/" . $smarty->template_dir . "/pages/" . $smartysh->page . ".tpl")) {
            echo "done";
        } else {
            echo $smarty->template_dir . "/pages/" . $smartysh->page . ".tpl does not exist!";
        }
    }
    die();
}
// logged and not logged switching
if (@strpos($request_uri[1], "__logged")) {
    $smarty->assign("logged_sufix", "__logged");
    $smartysh->logged_sufix = "__logged";
    $smarty->assign("logged", true);
    $smartysh->logged = true;
    $page_content = $smarty->fetch("pages/" . str_replace("__logged", "", $smartysh->page) . ".tpl");
    $template_filetime = filemtime($smarty->template_dir . "/pages/" . str_replace("__logged", "", $smartysh->page) . ".tpl");
} else {
    $smarty->assign("logged_sufix", "");
    $smartysh->logged_sufix = "";
    $smarty->assign("logged", false);
    $smartysh->logged = false;
    $page_content = $smarty->fetch("pages/" . $smartysh->page . ".tpl");
    $template_filetime = filemtime($smarty->template_dir . "/pages/" . $smartysh->page . ".tpl");
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
add_access_log(array(
    "site_dir" => $smartysh->site_dir,
    "url" => $_SERVER["REQUEST_URI"]
));

require_once($config["basepath"] . "/$site_dir/cfg/config.php");

//require_once("filelist.php");

ob_start("callback");
$smarty->display($layout_path);
$smarty->assign("debug", 0);
$content = $smarty->fetch($layout_path);
@ob_end_flush();

build_template($config["basepath"] . "/$site_dir/" . $config["build_dir"] . "/" . $smartysh->page . ".html", $content, $template_filetime);

if ($config["debug"]) {
    $time_end = microtime(1) - $time_start;
    echo "<!--";
    echo("Script load time: " . $time_end);
    echo "-->";
}
?>