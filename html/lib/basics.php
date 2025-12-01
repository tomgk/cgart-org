<?php

if(!defined('DS'))
    define('DS', DIRECTORY_SEPARATOR);

define('PROJECT_PATH', dirname(dirname(__FILE__)).DS);//das übergeordnete Verzeichnis!

$THE_INCLUDE_PATHS = array(
    'modul'=>'module',
    'module'=>'module',
    'core'=>'core',
    'lib'=>'lib',
    'controll'=>'controller',
    'cfg'=>'data-private/cfg'
);

function import($class, $type='lib')
{
    $path = str_replace('.', '/', $class);
    loadClass($path, $type);
}

function tryImport($class, $type='lib')
{
    $path = str_replace('.', '/', $class);
    return tryLoadClass($path, $type);
}

function loadClass($path, $type)
{
    global $THE_INCLUDE_PATHS;

    /*$directory = $THE_INCLUDE_PATHS[$type];

    $p1 = PROJECT_PATH.DS.$directory.DS.$path.'.class.php';
    $p2 = PROJECT_PATH.DS.$directory.DS.$path.'.php';

    if(file_exists($p1))
    {
        require_once $p1;
        return;
    }

    require_once $p2;*/

    if(!tryLoadClass($path, $type))
        throw new Exception("file not found '$type::$path'");

//    require_once PROJECT_PATH.DS.$directory.DS.$path.'.php';
}

function tryLoadClass($path, $type)
{
    global $THE_INCLUDE_PATHS;

    if(!isset($THE_INCLUDE_PATHS[$type]))
        return false;
    
    $directory = $THE_INCLUDE_PATHS[$type];
    
    $p1 = PROJECT_PATH.DS.$directory.DS.$path.'.class.php';
    $p2 = PROJECT_PATH.DS.$directory.DS.$path.'.php';

    if(file_exists($p1))
    {
        require_once $p1;
        return true;
    }

    if(file_exists($p2))
    {
        require_once $p2;
        return true;
    }

    return false;
//    require_once PROJECT_PATH.DS.$directory.DS.$path.'.php';
}

function safe_glob($pattern, $flags=0)
{
    $split=explode('/',str_replace('\\','/',$pattern));
    $mask=array_pop($split);
    $path=implode('/',$split);
    if (($dir=opendir($path))!==false) {
        $glob=array();
        while(($file=readdir($dir))!==false) {
            // Recurse subdirectories (GLOB_RECURSE)
            if( ($flags&GLOB_RECURSE) && is_dir($file) && (!in_array($file,array('.','..'))) )
                $glob = array_merge($glob, array_prepend(safe_glob($path.'/'.$file.'/'.$mask, $flags),
                    ($flags&GLOB_PATH?'':$file.'/')));
            // Match file mask
            if (fnmatch($mask,$file)) {
                if ( ( (!($flags&GLOB_ONLYDIR)) || is_dir("$path/$file") )
                  && ( (!($flags&GLOB_NODIR)) || (!is_dir($path.'/'.$file)) )
                  && ( (!($flags&GLOB_NODOTS)) || (!in_array($file,array('.','..'))) ) )
                    $glob[] = ($flags&GLOB_PATH?$path.'/':'') . $file . ($flags&GLOB_MARK?'/':'');
            }
        }
        closedir($dir);
        if (!($flags&GLOB_NOSORT)) sort($glob);
        return $glob;
    } else {
        return false;
    }
}

/**
 * A better "fnmatch" alternative for windows that converts a fnmatch
 * pattern into a preg one. It should work on PHP >= 4.0.0.
 * @author soywiz at php dot net
 * @since 17-Jul-2006 10:12
 */
if (!function_exists('fnmatch')) {
    function fnmatch($pattern, $string) {
        return @preg_match('/^' . strtr(addcslashes($pattern, '\\.+^$(){}=!<>|'), array('*' => '.*', '?' => '.?')) . '$/i', $string);
    }
}

//GEGEN Magic Quotes
if (get_magic_quotes_gpc()) {
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process)) {
        foreach ($val as $k => $v) {
            unset($process[$key][$k]);
            if (is_array($v)) {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            } else {
                $process[$key][stripslashes($k)] = stripslashes($v);
            }
        }
    }
    unset($process);
}

import('paths', 'cfg');

?>
