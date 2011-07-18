<?php

$time_start = microtime(1);

set_time_limit(999);
error_reporting(~E_NOTICE);

header('Content-Type: text/html; charset=utf-8');

require $htmlwarrior->config['code_path'] . '/init.php';

if ($htmlwarrior->config['frontpage_site']) {
    $htmlwarrior->runtime['site_dir'] = trim($htmlwarrior->config['frontpage_site'], '/');
} else {
    $site_dir = explode('/', trim($htmlwarrior->runtime['parsed_url']['path'], '/'));
    $htmlwarrior->runtime['site_dir'] = current($site_dir);
    unset($site_dir);
}

$smarty->assign('config', $htmlwarrior->config);

$smarty->loadFilter('pre', 'fix_smarty_syntax_indents');
$smarty->loadFilter('pre', 'add_partial_indents');
$smarty->loadFilter('output', 'fix_smarty_syntax_indents');

// admin
if ($htmlwarrior->config["frontpage_site"] === false) {
    if ($htmlwarrior->runtime["site_dir"] == "") {
        if (isset($_GET["action"])) {
            if ($_GET["action"] == "new_project") {
                if (isset($_GET["name"])) {
                    echo "todo new ";
                } else {
                    die("name attribute needed");
                }
            }
        }

        $smarty->setTemplateDir($htmlwarrior->config["code_path"] . "/admin/templates");
        $smarty->assign("access_log", get_access_log(array("limit" => 10)));

        $smarty->assign("access_log_site", get_site_access_log(array("limit" => 10)));

        $files = dir_list($htmlwarrior->config["basepath"]);
        foreach ($files as &$ma)
            $tmp[] = &$ma["timestamp"];
        array_multisort($tmp, SORT_DESC, $files, SORT_DESC);
        $smarty->assign("files", $files);
        $smarty->display("index.tpl");
        die();
    }
}

// load custom site functions
if (file_exists($htmlwarrior->config["basepath"] . "/" . $htmlwarrior->runtime["site_dir"] . "/functions.php")) {
    require_once($htmlwarrior->config["basepath"] . "/" . $htmlwarrior->runtime["site_dir"] . "/functions.php");
}


// build all templates
// todo build also logged templates
if ($htmlwarrior->config["build"]) {
    if (!is_dir($htmlwarrior->config['basepath'] . '/' .
                    $htmlwarrior->runtime['site_dir'] . '/' .
                    $htmlwarrior->config["build_dir"])) {
        mkdir($htmlwarrior->config['basepath'] . '/' .
                $htmlwarrior->runtime['site_dir'] . '/' .
                $htmlwarrior->config["build_dir"]);
    }

    if (isset($_GET["build"])) {
        if ($_GET["build"] == 1) {
            require_once($htmlwarrior->config["code_path"] . '/includes/build.php');
            die("Site build done... go to <a href=\"index.html\">frontpage</a>");
        }
    }
}

$smarty->setTemplateDir($htmlwarrior->config["basepath"] . "/" . $htmlwarrior->runtime["site_dir"] . "/templates");

$request_uri = explode("/", trim($htmlwarrior->runtime["parsed_url"]["path"], "/"));

// delete lang part of request_uri
if ( $htmlwarrior->config['multilingual'] ) {
    $request_uri = array_splice ($request_uri, 1 );
}

if ($htmlwarrior->config["live"]) {
    if (!isset($request_uri[0]) || $request_uri[0] == "") {
        $htmlwarrior->page = "index";
    } else {
        $request_uri[0] = str_replace(".html", "", end($request_uri));
        $htmlwarrior->page = $request_uri[0];
    }
} else {
    if (!isset($request_uri[1])) {
        $htmlwarrior->page = "index";
    } else {
        $request_uri[1] = str_replace(".html", "", end($request_uri));
        $htmlwarrior->page = $request_uri[1];
    }
}

if (isset($_GET["debug"])) {
    $htmlwarrior->config["debug"] = $_GET["debug"];
} else {
    //$htmlwarrior->config["debug"] = 1;
}
$smarty->assign("debug", $htmlwarrior->config["debug"]);

$smarty->assign("page", $htmlwarrior->page); // cool var; must stay in future code
// shortcut for frontpage
if ($htmlwarrior->page == "index" || $htmlwarrior->page == "index__logged") {
    $smarty->assign("frontpage", true);
} else {
    $smarty->assign("frontpage", false);
}

/*
  // template copy if not exists
  if (!file_exists($smarty->template_dir . "/pages/" . $htmlwarrior->page . ".tpl") && !strpos($request_uri[1], "__logged")) {
  echo '<div style="background: red">Templatet ei ole olemas. Kopeerin uue?. <a href="?copy=yes">jah</a></div>';
  if (@$_GET["copy"] == "yes") {
  if (copy($smarty->template_dir . "/pages/" . $htmlwarrior->page . ".tpl", $htmlwarrior->config["basepath"] . "/" . $smarty->template_dir . "/pages/" . $htmlwarrior->page . ".tpl")) {
  echo "done";
  } else {
  echo $smarty->template_dir . "/pages/" . $htmlwarrior->page . ".tpl does not exist!";
  }
  }
  die();
  }
 */

// logged and not logged switching
if (@strpos($request_uri[1], "__logged")) {
    $smarty->assign("logged_sufix", "__logged");
    $htmlwarrior->logged_sufix = "__logged";
    $smarty->assign("logged", true);
    $htmlwarrior->logged = true;
} else {
    $smarty->assign("logged_sufix", "");
    $htmlwarrior->logged_sufix = "";
    $smarty->assign("logged", false);
    $htmlwarrior->logged = false;
}
$page_content = $smarty->fetch(get_page_template_path($htmlwarrior->runtime["parsed_url"]["path"]));
if ($htmlwarrior->config["build"]) {
    $template_filetime = filemtime(get_page_template_path($htmlwarrior->runtime["parsed_url"]["path"]));
}
$page_variables = parse_variables($page_content);

if (!isset($page_variables["layout"])) {
    $htmlwarrior->layout = "default";
} else {
    $htmlwarrior->layout = $page_variables["layout"];
}
$layout_path = "layouts/" . $htmlwarrior->layout . ".tpl";
$variable_indents = get_indents_for_variables(file_get_contents($smarty->getTemplateDir(0) . "/" . $layout_path));

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
if ($htmlwarrior->config["log"]) {
    add_access_log(array(
        "site_dir" => $htmlwarrior->runtime["site_dir"],
        "url" => $_SERVER["REQUEST_URI"]
    ));
}

require_once($htmlwarrior->config["basepath"] . "/" . $htmlwarrior->runtime["site_dir"] . "/cfg/config.php");

//require_once("filelist.php");

ob_start("callback");
$smarty->display($layout_path);
$htmlwarrior->config["devmode"] = false;
$content = $smarty->fetch($layout_path);
@ob_end_flush();

if ($htmlwarrior->config["build"]) {
    build_template($htmlwarrior->config["basepath"] . "/" .
            $htmlwarrior->runtime["site_dir"] . "/" .
            $htmlwarrior->config["build_dir"] . "/" .
            $htmlwarrior->page . ".html", $content, $template_filetime);
}

if ($htmlwarrior->config["debug"]) {
    $time_end = microtime(1) - $time_start;
    echo "<!--";
    echo("Script load time: " . $time_end);
    echo "-->";
}