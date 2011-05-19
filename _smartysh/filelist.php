<?php

/*
  filelist.php - lists sites prototype files in browser top left corner
 */
require_once("config.php");

$site_dir = $_GET["site_dir"];
$page = $_GET["page"];


$page_template = str_replace(".html", ".tpl", $page);
$page_template = explode("?", $page_template);
$page_template = $page_template[0];

echo "<table class=\"smartysh_templatelist\" style=\"color:black\">";
echo '<tr><td colspan="2"><a href="' . (!$config["template_edit_links_downloadable"] ? $config["basepath_local"] : "") . "/" . $site_dir . $config["path_templates_pages"] . "/" . str_replace("__logged.", ".", $page_template) . '?template_list_opened=1">edit this page</a> or layout</td></tr>';
echo '<tr><td colspan="2">&nbsp;</td></tr>';

$files = array();
$index_in_list = false;
if ($handle = opendir("../$site_dir/templates/pages")) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            if (isset($config["hidden_file_prefix"])) {
                if (strpos($file, $config["hidden_file_prefix"]) === 0) {
                    continue;
                }
            }
            $tpl_files[] = $file;
            //echo tpl_to_link($file, $site_dir) . "<br />";
        }
    }
    closedir($handle);

    sort($tpl_files);
    if (in_array("index.tpl", $tpl_files)) {
        $index_in_list = true;
        foreach ($tpl_files as $key => $val) {
            if ($val == "index.tpl")
                unset($tpl_files[$key]);
        }
    }

    if ($index_in_list) {
        if ($page_template != "" && $page_template != "index.tpl") {
            echo tpl_to_link("index.tpl", $site_dir);
        } else {
            echo tpl_to_link("index.tpl", $site_dir, ";color:red");
        }
    }
    foreach ($tpl_files as $tpl_file) {
        if ($page_template != $tpl_file && str_replace("__logged.", ".", $page_template) != $tpl_file) {
            echo tpl_to_link($tpl_file, $site_dir);
        } else {
            echo tpl_to_link($tpl_file, $site_dir, ";color:red");
        }
    }
}
echo "</table>
<style>
.smartysh_templatelist a {
  color:white;font-family:Verdana,serif; font-size:11px; color: #404040;
}
</style>
";

function tpl_to_link($tpl_name, $site_dir, $style=false) {
    global $config, $smarty;
    $html_name = str_replace(".tpl", ".html", $tpl_name);
    return '<tr><td style="padding-right: 10px;"><a style="' . $style . '; font-weight:bold;" href="/' . $site_dir . "/" . $html_name . '?template_list_opened=1">' . $html_name . '</a></td><td><a style="' . $style . '" href="' . (!$config["template_edit_links_downloadable"] ? $config["basepath_local"] : "") . "/" . $site_dir . $config["path_templates_pages"] . "/" . str_replace("__logged.", "", $tpl_name) . '">(edit)</a></td></tr>';
}

?>