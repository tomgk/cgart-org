<?php

/**
 * Parst die Parameter eines Moduls (in String-Form) und macht daraus ein
 * assoziatives Array
 *
 * @author Thomas
 */
class ArgParser
{
    public function parseArgs($args)
    {
        $p = array();

        $args = str_replace("\r", "\n", $args);//Bug #k.A.: \r in Wert

        foreach(explode("\n", $args) as $line)
        {
            $pos = strpos($line, '=');

            if($pos == -1)
                continue;

            $p[substr($line, 0, $pos)] = substr($line, $pos+1);
        }

        return $p;
    }

    /**
     * Wandelt ein Argumenten-Array in ein Argumenten-String um. Die Schlüssel
     * dürfen kein = enthalten, und Schlüssel und Wert sollten vorne und hinten
     * keine Leerzeichen haben.
     * 
     * @param array $args das Array mit den Parametern
     * @return string die Parameter als String
     */
    public function toArgs($args)
    {
        $str = "";

        foreach($args as $key => $value)
        {
            if($str)
                $str.="\n";

            $str.=$key.'='.$value;
        }

        return $str;
    }
}
?>
