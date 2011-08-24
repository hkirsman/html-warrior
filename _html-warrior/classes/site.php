<?php

// todo: get from here http://127.0.0.1:8080/_html-warrior/orb.php?class=site&action=generate&site_name=foo&redirect=1
class site {

    /**
     * Create new site and redirect to it ( optional )
     * @global <type> $htmlwarrior
     * @param string site_name
     */
    public function create($arr = array()) {
        global $htmlwarrior, $txt;

        if (!isset($arr['donor'])) {
            die('donor parameter missing');
        }

        if (!isset($arr['site_name'])) {
            die('site_name parameter missing');
        }

        $source = $htmlwarrior->config['basepath'] .
                $htmlwarrior->config['path_code'] .
                '/skeletons/' .
                $arr['donor'];

        $target = $htmlwarrior->config['basepath'] .
                '/' . $arr['site_name'];

        $target_build = $target . '/' . $htmlwarrior->config['path_build'];

        // copy
        if (!is_dir($target)) {
            full_copy($source, $target);
        } else {
            die(printf($txt['site_site_exists'], $arr['site_name']));
        }

        // create build dir if it does not exists. Happens in GIT
        if (!is_dir($target_build)) {
            mkdir($target_build);
        }

        if ($arr['redirect']) {
            header('Location:/' . $arr['site_name'] . '/');
        }
    }

    /**
     *
     * @global  $htmlwarrior
     * @param string site_name What site to build
     */
    public function build($arr = array()) {
        global $htmlwarrior, $txt;

        $files = array();
        if ($handle = opendir($htmlwarrior->config['basepath'] . '/' .
                        $arr['site_name'] . '/templates/pages')) {
            while (false !== ($file = readdir($handle))) {
                if ($file != '.' && $file != '..') {
                    $tpl_files[] = $file;
                }
            }
            closedir($handle);

            foreach ($tpl_files as $tpl_file) {
                file_get_contents($htmlwarrior->config['baseurl'] . '/' .
                        $arr['site_name'] . '/' .
                        str_replace('.tpl', '.html', $tpl_file) . '?debug=0');
            }
        }

        // copy dirs
        // copy images
        $source = $htmlwarrior->config['basepath'] . '/' .
                $arr['site_name'] .
                $htmlwarrior->config['path_images'];
        if (is_dir($source)) {
            $target = $htmlwarrior->config['basepath'] . '/' .
                    $arr['site_name'] . '/' .
                    $htmlwarrior->config['build_dir'] .
                    $htmlwarrior->config['path_images'];
            full_copy($source, $target);
        }

        // copy scripts
        $source = $htmlwarrior->config['basepath'] . '/' .
                $arr['site_name'] .
                $htmlwarrior->config['path_scripts'];
        if (is_dir($source)) {
            $target = $htmlwarrior->config['basepath'] . '/' .
                    $arr['site_name'] . '/' .
                    $htmlwarrior->config['build_dir'] .
                    $htmlwarrior->config['path_scripts'];
            full_copy($source, $target);
        }

        //  copy styles
        $source = $htmlwarrior->config['basepath'] . '/' .
                $arr['site_name'] .
                $htmlwarrior->config['path_style'];
        if (is_dir($source)) {
            $target = $htmlwarrior->config['basepath'] . '/' .
                    $arr['site_name'] . '/' .
                    $htmlwarrior->config['build_dir'] .
                    $htmlwarrior->config['path_style'];
            full_copy($source, $target);
        }

        printf($txt['site_build_done'], $arr['site_name'], $arr['return_url']);
    }
}