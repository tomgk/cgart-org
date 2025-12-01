<?php
header("Content-Type:text/html;charset=UTF-8");

require_once 'base.php';
import("smarty.Smarty");
import('MySQL');

#$conn = mysql_connect("localhost", "root", "");
#mysql_select_db("cg");

$menus = array();

if(MySQL::$connectErrno)
{
    import('Log', 'core');
    Log::write("Cannot connect to database (".MySQL::$connectErrno."): ".MySQL::$connectError, Log::FATAL);
    header('HTTP/1.0 503 Service Unavailable');
    ?>
<html>
    <head>
        <title>Fehler</title>
        <style type="text/css">
            body
            {
                font-family: Arial, sans-serif;
            }
            
            div
            {
                margin: auto;
                width: 20em;
                border: 3px double red;
                background-color: #fcc;
                padding: 0 1em;
            }

            h1
            {
                font-size: 1.2em;
                padding: 0.25em 0;
                color: red;
            }
        </style>
    </head>
    
    <body>
        <div>
            <h1>Datenbankfehler</h1>
            <p>Es konnte keine Verbindung zur Datenbank hergestellt werden.</p>
        </div>
    </body>
</html>
    <?php
    exit;
}

$RS = MySQL::getRows("SELECT menu.loc, menuitem.title, CONCAT('/index.php/', menuitem.alias,'/') AS href FROM menu INNER JOIN menuitem USING(menu_id) ORDER BY id");

//while($m = mysql_fetch_assoc($RS))
foreach($RS as $m)
    $menus[$m['loc']][] = $m;

//mysql_free_result ($RS);

//mysql_close($conn);

/*echo '<code style="white-space:pre-wrap">';
var_dump($menus);
echo '</code>';*/

$smarty = new Smarty();

import('ModulCall', 'core');
$mc = new ModulCall('base');
ob_start();

$path = array_get($_SERVER,'PATH_INFO');

if($path[0]=='/')
    $path = substr($path, 1);

import('PathGenerator');
class PathGen implements PathGenerator
{
    private $prefix;
    
    public function __construct($prefix)
    {
        $this->prefix = $prefix;
    }
    
    public function createPath($pieces, $query=null, $fragment = null)
    {
        $query = $query ? '?'.http_build_query($query) : '';
        $fragment = $fragment ? '#'.$fragment : '';
        return $this->prefix.implode('/', $pieces).$query.$fragment;
    }
}

$p_arr = explode('/', $path);

if($p_arr[count($p_arr)-1] == '')
    array_pop($p_arr);

$data = $mc->call($p_arr, new PathGen('/index.php/'));
$content = ob_get_contents();
ob_end_clean();

$mm = Scope::getModelManager();

$smarty->assign('skin', $mc);
$smarty->assign('content', $content);//''.$text);
$smarty->assign('skin', $mm->getConfig('skin'));

if($data->menu)
    $menus['submenu'] = $data->menu;

$title = $data->model['title'];
$wtitle = $data->model['wtitle'];
$wurl = $data->model['wurl'];

function try_assign($name)
{
    global $data, $smarty;
    
    if(isset($data->model[$name.'_path']) && $data->model[$name.'_path'])
    {
        $smarty->assign($name.'_path', $data->model[$name.'_path']);
        $smarty->assign($name.'_title', $data->model[$name.'_title']);
    }
}

try_assign('start');
try_assign('prev');
try_assign('next');
try_assign('up');
try_assign('first');
try_assign('last');

$smarty->assign('title', $title);
$smarty->assign('menu', $menus);
$smarty->assign('wtitle', $wtitle);
$smarty->assign('wurl', $wurl);
$smarty->assign('css_path', CSS_PATH);
$smarty->assign('pic_path', PIC_PATH);

$smarty->template_dir = TEMPLATE_PATH.'base'.DS;
$smarty->compile_dir = TEMPLATE_COMPILE_PATH.'base'.DS;
#$smarty->cache_dir = CACHE_SITES_PATH.'base'.DS;
#$smarty->caching = true;
$smarty->display('main.tpl.html', $path);

?>