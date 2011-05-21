{*
  This is Smarty comment. There are lot comments here to explore!
*}
<!DOCTYPE html>
<html dir="ltr" lang="et">
  <head>
    {*
      This s used for extra navigation and features during sites development.
      It will be removed during the output to build dir
    *}
    {if $debug==1}
      {partial tpl=script file="../..{$config.path_code}/scripts/smartysh_init.php"}
      {partial tpl=script file="../..{$config.path_code}/scripts/smartysh_helpers"}
    {/if}
    <meta charset="UTF-8" />
    {*
      You can add plugins cfg\config.php. There's one activated - jquery.
      Currently files are not copied automatically. So if you want to activate more plugins,
      add them to $plugin array in config.cfg and also copy contents from _smartysh\plugins\PLUGIN_NAME\files\
    *}
    {smartysh_plugins indent="    "}
    {*
      $title comes from page templates (e:\www\example_site\templates\pages\
    *}
    <title>{$title} - Smartysh</title>
    <link rel="stylesheet" type="text/css" media="all" href="style/style.css" />
  </head>
  {*
    Here we detect what page we're on and change body classes respectively
  *}
  <body class="{if $page=='index'}home blog{else if $page=='search'}search search-results{else}single single-post single-format-standard{/if}">
    <div id="wrapper" class="hfeed">
      <div id="header">
        <div id="masthead">
          <div id="branding" role="banner">
            <h1 id="site-title">
              <span>
                <a href="index.html" title="Twenty Ten Wordpress theme" rel="home">Twenty Ten Wordpress theme</a>
              </span>
            </h1>
            <div id="site-description">Demo page for Smartysh</div>
            {*
              Image partial. Writes img tag and also adds width and height
            *}
            {partial tpl="img" src="base/fern.jpg"}
          </div><!-- #branding -->
          <div id="access" role="navigation">
            <div class="skip-link screen-reader-text"><a href="#content" title="Liigu sisu juurde">Liigu sisu juurde</a></div>
            <div class="menu">
              <ul>
                {*
                  Add active calls to navigation dependind on what url we're on. We could write navigation partial for this and give
                  array of links and names as parameters.
                *}
                <li class="{if $page=='index'}current_page_item{/if}"><a href="index.html" title="Frontpage">Frontpage</a></li>
                <li class="{if $page=='partials'}current_page_item{else}page_item{/if}"><a href="partials.html" title="">Partial templates</a></li>
                <li class="{if $page=='about'}current_page_item{else}page_item{/if}"><a href="about.html" title="">About</a></li>
              </ul>
            </div>
          </div><!-- #access -->
        </div><!-- #masthead -->
      </div><!-- #header -->
      <div id="main">
        <div id="container">
          <div id="content" role="main">
            {*
              Again detect page and show navigation only on subpages
            *}
            {if $page!="index"}
              <div class="navigation" id="nav-above">
                <div class="nav-previous"><a rel="prev" href="index.html"><span class="meta-nav">←</span>Back (defined in layout, only shown on subpages)</a></div>
                <div class="nav-next"></div>
              </div>
            {/if}
            {$yield}
            {*
              Again detect page and show navigation only on subpages
            *}
            {if $page!="index"}
              <div class="navigation" id="nav-below">
                <div class="nav-previous"><a rel="prev" href="index.html"><span class="meta-nav">←</span>Back (defined in layout, only shown on subpages)</a></div>
                <div class="nav-next"></div>
              </div><!-- #nav-below -->
            {/if}
          </div><!-- #content -->
        </div><!-- #container -->
        <div id="primary" class="widget-area" role="complementary">
          <ul class="xoxo">
            <li id="search-2" class="widget-container widget_search">
              <form role="search" method="get" id="searchform" action="search.html" >
                <div>
                  <label class="screen-reader-text" for="s">Search:</label>
                  <input type="text" value="" name="s" id="s" />
                  <input type="submit" id="searchsubmit" value="Search" />
                </div>
              </form>
            </li>
            <li id="calendar-3" class="widget-container widget_calendar">
              <h3 class="widget-title">&nbsp;</h3>
                <div id="calendar_wrap">
                <table id="wp-calendar">
                  <caption>may 2011</caption>
                  <thead>
                    <tr>
                      <th scope="col" title="Esmaspäev">M</th>
                      <th scope="col" title="Teisipäev">T</th>
                      <th scope="col" title="Kolmapäev">W</th>
                      <th scope="col" title="Neljapäev">T</th>
                      <th scope="col" title="Reede">F</th>
                      <th scope="col" title="Laupäev">S</th>
                      <th scope="col" title="Pühapäev">S</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <td colspan="3" id="prev" class="pad">&nbsp;</td>
                      <td class="pad">&nbsp;</td>
                      <td colspan="3" id="next" class="pad">&nbsp;</td>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>
                      <td colspan="6" class="pad">&nbsp;</td><td>1</td>
                    </tr>
                    <tr>
                      <td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td>
                    </tr>
                    <tr>
                      <td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td>
                    </tr>
                    <tr>
                      <td>16</td><td>17</td><td>18</td><td><a href="partials.html" title="">19</a></td><td>20</td><td id="today">21</td><td>22</td>
                    </tr>
                    <tr>
                      <td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td><td>29</td>
                    </tr>
                    <tr>
                      <td>30</td><td>31</td>
                      <td class="pad" colspan="5">&nbsp;</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </li>
            <li id="recent-posts-2" class="widget-container widget_recent_entries">
              <h3 class="widget-title">New posts</h3>
              <ul>
                <li><a href="index.html" title="Hello, html guru!">Hello, html guru!</a></li>
                <li><a href="partials.html" title="Partial templates">Partial templates</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- #primary .widget-area -->
      </div><!-- #main -->

      <div id="footer" role="contentinfo">
        <div id="colophon">
          <div id="site-info">
            <a href="index.html" title="Smartysh demo site" rel="home">Smartysh demo site</a>
          </div><!-- #site-info -->
        </div><!-- #colophon -->
      </div><!-- #footer -->
    </div><!-- #wrapper -->

    {*
      This is the same plugin code that's defined on the top of the page.
      This way we can choose where to include scripts and css.
    *}
    {smartysh_plugins position="bottom" indent="    "}
    {*
      Rest of the Smartysh extras we see on example site.
    *}
    {if $debug==1}
      {partial tpl=script file="../..{$config.path_code}/scripts/externals/jquery-ui"}
      {partial tpl=script file="../..{$config.path_code}/scripts/externals/jquery.cookie"}
      {partial tpl=script file="../..{$config.path_code}/scripts/psdOverlay"}
    {/if}
    {*
      Scripts partial. Just adds extension and scripts folder in path.
    *}
    {partial tpl=script file="general"}
  </body>
</html>