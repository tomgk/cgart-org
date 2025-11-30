<?php

function convertSizeToReadable($space)
{
    $names = array('B', 'kB', 'MB', 'GB', 'TB');

    $i = 0;

    //Bis zu 10?B
    while($space >= 1024 && $i+1 < count($names))
    {
        $space/=1024;
        ++$i;
    }

    return number_format($space, $space > 100 ? 0 : $space > 10 ? 1 : 2).' '.$names[$i];
}

//function getSpaceReadable($filename, &$filecount = null)
//{
//    $space = getSpace($filename, $filecount);
//    return toReadable($space);
//}

function getSpace($filename, &$filecount = null)
{
    if(is_file($filename))
    {
        ++$filecount;
        return filesize ($filename);
    }

    $space = 0;
    $dir = opendir($filename);

    while($file = readdir($dir))
    {
        if($file != '.' && $file != '..')
            $space += getSpace ($filename.DS.$file, $filecount);
    }

    return $space;
}

?>