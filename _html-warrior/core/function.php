<?php

function arr($arr,$die=false,$see_html=false)
{
        echo '<hr/>';
        $tmp = '';
        ob_start();
        print_r($arr);
        $tmp = ob_get_contents();
        ob_end_clean();
        echo '<pre style="text-align: left;">';
        echo $see_html?htmlspecialchars($tmp):$tmp;
        echo '</pre>';
        echo '<hr/>';
        if ($die)
        {
                die();
        }
        return $arr;
}