<?php

if ($db = new SQLiteDatabase($smartysh->config["path_db"])) {
    // create tables if these do not exist
    $q = @$db->query('SELECT id FROM access_log WHERE id = 1');
    if ($q === false) {
        $db->queryExec("
            CREATE TABLE access_log (id int,
            site_dir varchar(255) NOT NULL,
            url varchar(255) NOT NULL,
            date datetime NOT NULL,
            PRIMARY KEY (id)
        )");
    }
} else {
    die($err);
}
?>