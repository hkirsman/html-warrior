<?php

/**
 * Debug variable - print_r variable but also add pre tags
 * @param bool|string|array $arr
 * @param bool $die optional Also die after output
 * @param bool $see_html optional
 * @return string of the debugable array
 */
function arr($arr, $die=false, $see_html=false) {
    echo '<hr/>';
    $tmp = '';
    ob_start();
    print_r($arr);
    $tmp = ob_get_contents();
    ob_end_clean();
    echo '<pre style="text-align: left;">';
    echo $see_html ? htmlspecialchars($tmp) : $tmp;
    echo '</pre>';
    echo '<hr/>';
    if ($die) {
        die();
    }
    return $arr;
}

/**
 * Saves opened urls to database
 * @global <type> $db
 * @param array $arr
 */
function add_access_log($arr=array()) {
    global $db;
    $q = "
        INSERT INTO
            access_log
            (
                id,
                site_dir,
                url,
                date
            )
        VALUES (
            NULL ,
            '" . $arr["site_dir"] . "',
            '" . $arr["url"] . "',
            '" . datetime() . "'
        );
    ";
    $db->queryExec($q);
}

/**
 * Gets latest viewed pages
 * @global  $db
 * @param array $arr
 * @return array
 */
function get_access_log($arr=array()) {
    global $db;
    $out = array();
    if ($arr["limit"]) {
        $limit = " LIMIT 0, " . $arr["limit"] . " ";
    }
    $results = $db->arrayQuery("
        SELECT
            site_dir, url
        FROM
            access_log
        ORDER BY
            date desc
        $limit");

    foreach ($results as $entry) {
        $out[] = $entry;
        $name = explode("/", $entry["url"]);
        $name = $name[1];

        $out[count($out) - 1]["url_wo_slash"] = trim($entry["url"], "/");
        $out[count($out) - 1]["name"] = $name;
    }
    return $out;
}

/**
 * Gets latest viewed pages
 * @global  $db
 * @param array $arr
 * @return array
 */
function get_site_access_log($arr=array()) {
    global $db;
    $out = array();
    $limit = "";
    if (@$arr["limit"]) {
        $limit = " LIMIT 0, " . $arr["limit"] . " ";
    }
    $results = $db->arrayQuery("
        SELECT
        DISTINCT
            site_dir
        FROM
            access_log
        ORDER BY
            date desc
            $limit
    ");

    foreach ($results as $entry) {
        $out[] = $entry["site_dir"] . "/";
    }
    return $out;
}

function datetime($timestamp=false) {
    global $htmlwarrior;

    if ($timestamp) {
        $date = date("Y-m-d H:M:s", $timestamp + $htmlwarrior->config["timeoffset"]);
    } else {
        $date = date("Y-m-d H:i:s", time() + $htmlwarrior->config["timeoffset"]);
    }
    return $date;
}

/**
 * Dir copy
 * @param string $source
 * @param string $target
 */
function full_copy($source, $target) {
    if (is_dir($source)) {
        @mkdir($target);
        $d = dir($source);
        while (FALSE !== ( $entry = $d->read() )) {
            if ($entry == '.' || $entry == '..') {
                continue;
            }
            $Entry = $source . '/' . $entry;
            if (is_dir($Entry)) {
                full_copy($Entry, $target . '/' . $entry);
                continue;
            }
            copy($Entry, $target . '/' . $entry);
            touch($target . '/' . $entry, filemtime($Entry)); // set time
        }
        $d->close();
    } else {
        copy($source, $target);
        touch($target, filemtime($source)); // set time
    }
}

/**
 * dir_list is currently used to get the latest projects in ordered by dir
 * create date (newer first)
 * @param string $dir
 * @return array
 * @todo sort by
 */
function dir_list($dir) {
    if ($dir[strlen($dir) - 1] != '/')
        $dir .= '/';

    if (!is_dir($dir))
        return array();

    $dir_handle = opendir($dir);
    $dir_objects = array();
    while (false !== ($object = readdir($dir_handle))) {
        if (!in_array($object, array('.', '..'))) {
            $filename = $dir . $object;
            $file_object = array(
                'name' => $object,
                'size' => filesize($filename),
                'type' => filetype($filename),
                'time' => date("d F Y H:i:s", filemtime($filename)),
                'timestamp' => filemtime($filename)
            );
            $dir_objects[] = $file_object;
        }
    }
    return $dir_objects;
}

/**
 * Unified javascript tag
 * @param string $file required URI to js. Js extension can be omitted. Php
 * extension can be used.
 * @return string <script> tag
 */
function html_javascript($file, $scripts_as_root = true) {
    $a_file = explode("/", $file);
    $template_name = end($a_file);
    $file = str_replace($template_name, "", $file);
    if (strpos($template_name, ".php") === false) {
        $file .= $template_name . ".js";
    } else {
        $file .= $template_name;
    }
    return '<script type="text/javascript" src="' . ($scripts_as_root ? 'scripts/' : '') . $file . '"></script>';
}

/**
 * Unified style link tag
 * @param string $file required URI to css. If extension is missing, .css is added
 * to path
 * @param string $media optional Can be used to define css media type
 * @return <type>
 */
function html_css($file, $media=false) {
    $a_file = explode("/", $file);
    $template_name = end($a_file);
    $file = str_replace($template_name, "", $file);
    if (strpos($template_name, ".php") === false) {
        $file .= $template_name . ".css";
    } else {
        $file .= $template_name;
    }
    return '<link rel="stylesheet" type="text/css" href="style/' . $file . '" ' . ($media ? " media=\"" . $media . "\"" : " media=\"all\"") . ' title="" />';
}

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
    global $htmlwarrior;
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
    $uri_new = explode('?', $uri);
    return $uri_new[0];
}

/**
 * Find first tag name from string
 * @param string $subject
 * @return string Tag name
 */
function get_first_tag_name($subject) {
    preg_match("/<([a-z].*)(\s.*)>/msiU", $subject, $matches);
    return $matches[1];
}

/**
 *
 * @global array $htmlwarrior->config required htmlwarrior config
 * @global string $site_dir required Currently active site name (directory)
 * @param <type> $tpl_name
 * @return <type>
 */
function mk_partial_edit_link($tpl_name) {
    global $htmlwarrior;
    return (!$htmlwarrior->config['template_edit_links_downloadable'] ?
            $htmlwarrior->config['basepath_local'] : '') .
    '/' . $htmlwarrior->runtime['site_dir'] .
    $htmlwarrior->config['path_templates_partials'] . '/' . $tpl_name;
}

/**
 * Get current page url
 * @return string
 */
function get_cur_page_url() {
    $pageurl = 'http';
    if ($_SERVER['HTTPS'] == 'on') {
        $pageurl .= 's';
    }
    $pageurl .= '://';
    if ($_SERVER['SERVER_PORT'] != '80') {
        $pageurl .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
    } else {
        $pageurl .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    }
    return $pageurl;
}

/**
 * Get baseurl. Used in config.
 * @return string
 */
function get_baseurl() {
    $baseurl = 'http';
    if (@$_SERVER['HTTPS'] == 'on') {
        $baseurl .= 's';
    }
    $baseurl .= '://';
    if ($_SERVER['SERVER_PORT'] != '80') {
        $baseurl .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
    } else {
        $baseurl .= $_SERVER['SERVER_NAME'];
    }
    return $baseurl;
}

/**
 * Removes BOM from UTF-8. Although it's not recommended to use it
 * someone might do it. And it breaks HTML.
 * @param string $str
 * @return string
 */
function remove_bom($str='') {
    if (substr($str, 0, 3) == pack('CCC', 0xef, 0xbb, 0xbf)) {
        $str = substr($str, 3);
    }
    return $str;
}

/**
 * Get page template path based on url path ( /site_name/foo )
 * @param string $url_path
 * @return string
 */
function get_page_template_path($url_path) {
    global $htmlwarrior;
    $template_path = '';
    $array_splice_offset = 2;
    if ($htmlwarrior->config['frontpage_site']) {
        $array_splice_offset = 1;
    }
    $a_url_path = explode('/', $url_path);
    $a_url_path_without_site = array_splice($a_url_path, $array_splice_offset, count($a_url_path));
    $url_path_without_site = join('/', $a_url_path_without_site);

    if (strlen($url_path_without_site) === 0) {
        $url_path_without_site = 'index';
    }

    $find = array('__logged', '.html');
    $replace = '';

    $template_path = $htmlwarrior->config['basepath'] . '/' .
            $htmlwarrior->runtime['site_dir'] .
            $htmlwarrior->config['path_templates_pages'] . '/' .
            str_replace($find, $replace, $url_path_without_site);

    $template_path_with_ext = $template_path . '.tpl';

    // if
    if (is_dir($template_path)) {
        // check if index exists
        if (file_exists($template_path . '/index.tpl')) {
            return $template_path . '/index.tpl';
        }
    } else {
        return $template_path_with_ext;
    }
}

function classload($classname) {
    global $htmlwarrior;

    require_once($htmlwarrior->config['basepath'] . $htmlwarrior->config['path_code'] . '/classes/' . $classname . '.php');
    $instance = new $classname();
    return $instance;
}