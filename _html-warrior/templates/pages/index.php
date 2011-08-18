<?php

$path = $htmlwarrior->config['basepath'] . '/' .
        $htmlwarrior->runtime['site_dir'] .
        $htmlwarrior->config['path_templates_pages'];

$files = glob($path . '/*.tpl');

$sorted = array();

if (sizeof($files) > 0) {
    foreach ($files as $filename) {
        $filename_tpl = end(explode('/', $filename));

        if (strpos($filename_tpl, '__') === 0 || strpos($filename_tpl, 'index.tpl') === 0) {
            continue;
        }

        $f = explode('.', $filename);
        $f = explode('/', $f[0]);
        $group = end($f);
        if (!$sorted[$group]) {
            $sorted[$group] = array();
        }

        $sorted[$group][] = $filename;
    }

    $out = '';

    foreach ($sorted as $key => $group) {
        foreach ($group as $index => $filename) {
            $tplcontent = file_get_contents($filename);
            $page_variables = parse_variables($tplcontent);
            list($grouptitle, $filetitle) = explode('::', $page_variables['title']);


            if ($index == 0) {
                if (!$grouptitle) {
                    $grouptitle = ucfirst($key);
                }

                $out .= '<h3>' . $grouptitle . '</h3>' . "\n";
                $out .= '<ul>' . "\n";
            }

            $filename_tpl = end(explode('/', $filename));
            $filename_html = str_replace('.tpl', '.html', $filename_tpl);

            if (!$filetitle) {
                $filetitle = $filename_html;
            }

            $out .= '<li><a href="' . $filename_html . '">' . $filetitle . '</a>' . "\n";
        }
        $out .= '</ul>' . "\n";
    }

    $params['out'] = $out;
}

unset($out, $sorted, $path, $files);