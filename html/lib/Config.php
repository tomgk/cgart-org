<?php
/**
 * Description of Config
 *
 * @author Thomas
 */
class Config
{
    private static $cfg;

    public static function get($name, $default = null)
    {
        $pos = strpos($name, '.');

        if($pos === false)
            return $default;

        $file = substr($name, 0, $pos);
        $name = substr($name, $pos+1);

        if(!isset(self::$cfg[$file]))
            self::load($file);

        return array_get(self::$cfg, $name);
    }

    public static function load($file)
    {
        $v = new __PHP_Incomplete_Class();
    }
}
?>
