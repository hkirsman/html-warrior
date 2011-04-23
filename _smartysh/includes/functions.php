<?php

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
                url,
                date
            )
        VALUES (
            NULL ,
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
        SELECT url
        FROM access_log
        ORDER BY
        date desc
        $limit");

    foreach ($results as $entry) {
        $out[] = $entry;
        $name = explode("/", $entry["url"]);
        $name = $name[1];
        $out[count($out) - 1]["name"] = $name;
    }
    return $out;
}

function datetime($timestamp=false) {
    global $config;

    if ($timestamp) {
        $date = date("Y-m-d H:M:s", $timestamp + $config["timeoffset"]);
    } else {
        $date = date("Y-m-d H:i:s", time() + $config["timeoffset"]);
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
function html_javascript($file) {
    $a_file = explode("/", $file);
    $template_name = end($a_file);
    $file = str_replace($template_name, "", $file);
    if (strpos($template_name, ".php") === false) {
        $file .= $template_name . ".js";
    } else {
        $file .= $template_name;
    }
    return '<script type="text/javascript" src="scripts/' . $file . '"></script>';
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

?>