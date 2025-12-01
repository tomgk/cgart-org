<?php

/**
 * Zum Loggen von Daten
 *
 * @author Thomas
 */
class Log
{
    private static $logFile;
    private static $rTime;
    const FATAL = 'FATAL';
    const ERROR = 'ERROR';
    const WARNING = 'WARNING';

    public static function write($msg, $type)
    {
        if(!self::$logFile)
        {
            if(!is_dir(LOG_DIR))
                mkdir(LOG_DIR);
            
            self::$logFile = fopen(LOG_DIR.date('Y-m-d').'.log', 'a+');
            self::$rTime = date("Y-m-d G:i:s", $_SERVER['REQUEST_TIME']);
        }
        
        $ref = (isset($_SERVER['HTTP_REFERER']) ? 'comming from "'.$_SERVER['HTTP_REFERER'].'" ' : '');
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        $ip = $_SERVER['REMOTE_ADDR'];

        fwrite(self::$logFile, $ip.' ['.self::$rTime.'] "'.$method.' '.$uri.'" '.
                $ref.
                $type.': '.$msg."\n");
    }
}
?>