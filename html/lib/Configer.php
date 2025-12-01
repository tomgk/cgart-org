<?php

import('array');

class Configer
{
    private static $configs;
    private static $TLD;
    
    public static function init()
    {
        $POS = strrpos($_SERVER['SERVER_NAME'], '.');
        self::$TLD = substr($_SERVER['SERVER_NAME'], $POS+1);
    }
    
    public static function getProperty($name, $default = null)
    {
        $p = strpos($name,'.');

        if($p === false)
            throw new Exception("Illegal Argument: no point");

        $f = substr($name, 0, $p);
        
        if(!isset($configs[$f]))
            self::load($f);
        
        return array_get(self::$configs[$f], substr($name, $p+1), $default);
    }

    public static function load($filename)
    {
        $file = fopen(CONFIG_PATH.$filename.'_'.self::$TLD.'.properties', "r");

        if($file === false)
            throw new Exception ("$filename not found");

        self::$configs[$filename] = array();

        while(($line = fgets($file)) !== false)
        {
            $line = trim($line);

            if($line == '' || $line[0] =='#')
                continue;

            $pos = strpos($line, '=');

            if($pos === false)
                continue;
            
            $name = trim(substr($line, 0, $pos));
            $value = trim(substr($line, $pos+1));

            if(substr(strlen($name) - 2, 2) == '[]')
            {
                $name = substr(0, strlen($name)-2);
                $value = str_split(',');
            }

            self::$configs[$filename][$name] = $value;
        }

        if($filename == 'paths')
            self::$configs['paths']['root'] = PROJECT_PATH;
    }
}

Configer::init();

?>
