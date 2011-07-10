<?php

class html2css {

    public function generate($arr=array()) {
        global $htmlwarrior;

        require_once($htmlwarrior->config['code_path'] .
                '/externals/simplehtmldom/simple_html_dom.php');

        //require_once '';
        // Create a DOM object
        $html = new simple_html_dom();

        // Load HTML from a string
        $html->load('<div id="nav" class="cuprum">
        <div id="nav-inner">
          <ul id="nav-ul">
            <li class="nav-li nav-frontpage"><a class="nav-a active" href="index.html">Avaleht</a></li>
          </ul>
          <ul id="nav-social">
            <li class="nav-social-li"><a class="nav-social-a nav-social-twitter" href="javascript:void(0)"></a></li>
          </ul>
        </div>
      </div>');

        foreach ($html->find('html,body,div,span,applet,object,iframe,
            h1,h2,h3,h4,h5,h6,p,blockquote,pre,
            a,abbr,acronym,address,big,cite,code,
            del,dfn,em,font,img,ins,kbd,q,s,samp,
            small,strike,strong,sub,sup,tt,var,
            b,u,i,center,
            dl,dt,dd,ol,ul,li,
            fieldset,form,label,legend,
            table,caption,tbody,tfoot,thead,tr,th,td') as $element) {
            if ($element->id ) {
                echo '#' . $element->id . '<br />';
            } else if ($element->class) {
                $classes = explode(" ", $element->class);
                foreach($classes as $key=>$var) {
                    echo '.' . $var . '<br />';
                }
            }
        }
    }

}