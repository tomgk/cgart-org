<?php

/**
 * Description of EventManager
 *
 * @author Thomas
 */
class EventManager
{
    private static $listeners;

    public static function addListener($type, $listener)
    {
        self::$listeners[$type][] = $listener;
    }

    public static function raiseEvent($type, $data)
    {
        $fname = "on".$type;

        foreach($listener as &$l)
            $l->$fname($data);
    }
}
?>