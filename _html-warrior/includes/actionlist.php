<?php

function actionlist($actionlist_opened=false) {
    global $smarty, $htmlwarrior;

    $build_url = mk_orb('site', 'build', array(
                'site_name' => $htmlwarrior->runtime['site_dir'],
                'return_url' => $htmlwarrior->runtime['url']
            ));

    $tpl = $smarty->createTemplate('admin/templates/site_actionlist.tpl');
    $tpl->assign('build_url', $build_url);

    return $smarty->fetch($tpl);
}