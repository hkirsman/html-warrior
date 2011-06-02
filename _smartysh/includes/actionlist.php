<?php

function actionlist($actionlist_opened=false) {
    global $smarty, $config, $debug, $smartysh;

    return $smarty->fetch("admin/templates/site_actionlist.tpl");
}

?>