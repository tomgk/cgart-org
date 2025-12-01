<?php

/**
 * Teilt den String mit dem übergebenen Trenner. Wird der Trenner gefunden,
 * befindet sich der Teil vor dem Trenner in $irst und der Rest in $rest,
 * ansonsten ist $first = null und $rest = $string.
 * 
 * @param string $string der zu teilende String
 * @param string $delim der Trenner
 * @param string $first enthällt nachher Teil vor Trenner oder null
 * @param string $rest enthällt Teil nach Trenner oder den gesamten String
 * @return boolean true, wenn der Trenner enthalten war, sonst false
 */
function string_split_last($string, $delim, &$first, &$rest)
{
    $pos = strpos($string, $delim);

    if($pos === false)
    {
        $first = null;
        $rest = $string;
        return false;
    }else{
        $first = substr($string, 0, $pos);
        $rest = substr($string, $pos+1);
        return true;
    }
}
function string_split_first($string, $delim, &$first, &$rest)
{
    $pos = strpos($string, $delim);

    if($pos === false)
    {
        $first = $string;
        $rest = null;
        return false;
    }else{
        $first = substr($string, 0, $pos);
        $rest = substr($string, $pos+1);
        return true;
    }
}

?>