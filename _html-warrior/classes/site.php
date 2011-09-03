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

        $site_path = $htmlwarrior->config['basepath'] . '/' . $arr['site_name'];

        // cleanup - delete contents of build dir prior to copy and compile
        recursive_remove_directory($site_path . '/' .
                $htmlwarrior->config['build_dir'], true);

        // compile templates
        // todo: also compile loggedin templates
        $files = array();
        if ($handle = opendir($site_path . '/templates/pages')) {
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

        // copy dirs to build dir
        // all except build, templates, overlays and cfg
        $site_root_files = glob($site_path . '/*');
        foreach ($site_root_files as $path) {
            if (is_dir($path)) {
                // check if dir is templates dir
                $path_templates = str_replace('/', '\/', $htmlwarrior->config['path_templates']);
                $is_templates_dir = preg_match('/' . $path_templates . '$/imsU', $path, $mt);

                // check if dir is cfg dir
                $path_cfg = str_replace('/', '\/', $htmlwarrior->config['path_cfg']);
                $is_cfg_dir = preg_match('/' . $path_cfg . '$/imsU', $path, $mt);

                // check if dir is build dir
                $path_build = str_replace('/', '\/', $htmlwarrior->config['path_build']);
                $is_build_dir = preg_match('/' . $path_build . '$/imsU', $path, $mt);

                // check if dir is overlays dir
                $path_overlays = str_replace('/', '\/', $htmlwarrior->config['path_overlays']);
                $is_overlays_dir = preg_match('/' . $path_overlays . '$/imsU', $path, $mt);

                if (!$is_templates_dir &&
                        !$is_cfg_dir &&
                        !$is_build_dir &&
                        !$is_overlays_dir) {
                    $dir = end(explode('/', $path));
                    $target = $site_path . '/' .
                            $htmlwarrior->config['build_dir'] . '/' .
                            $dir;
                    recursive_remove_directory($target);
                    full_copy($path, $target);
                }
            }
        }

        printf($txt['site_build_done'], $arr['site_name'], $arr['return_url']);
    }

}