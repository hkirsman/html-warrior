<?php

// todo: get from here http://127.0.0.1:8080/_html-warrior/orb.php?class=gensite&action=generate&site_name=foo&redirect=1
class gensite {

    /**
     * Create new site and redirect to it ( optional )
     * @global <type> $htmlwarrior
     * @param string site_name
     */
    public function generate($arr = array()) {
        global $htmlwarrior, $txt;

        $source = $htmlwarrior->config['basepath'] .
                $htmlwarrior->config['path_code'] .
                '/skeletons/' .
                $arr['skeleton'];

        $target = $htmlwarrior->config['basepath'] .
                '/' . $arr['site_name'];

        $target_build = $target . '/' . $htmlwarrior->config['path_build'];

        // copy
        if (!is_dir($target)) {
            full_copy($source, $target);
        } else {
            die(printf($txt['gensite_site_exists'], $arr['site_name']));
        }

        // create build dir if it does not exists. Happens in GIT
        if (!is_dir($target_build)) {
            mkdir($target_build);
        }

        if ($arr['redirect']) {
            header('Location:/' . $arr['site_name'] . '/');
        }
    }

}