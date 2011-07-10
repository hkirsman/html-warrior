<?php

function actionlist($actionlist_opened=false) {
    global $smarty, $config, $htmlwarrior;

    return $smarty->fetch("admin/templates/site_actionlist.tpl");
}