<?php

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
 *
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

?>