<?php

function array_get(&$array, $index, $default = null, $type = 'string')
{
    if(!isset($array[$index]))
        return $default;

    if($type == 'string')
        return $array[$index];

    else if($type == 'int')
        return preg_match ('/^[0-9]+$/', $array[$index]) ? (int)$array[$index] : $default;

    else
        throw new Exception($type.' not supported');

//    return isset($array[$index]) ? $array[$index] : $default;
}

function array_make(&$array, $index, $default, $type)
{
    $array[$index] = array_get($array, $index, $default, $type);
}

?>
