<?php

import('space');

function getSpaceLine($filename, $name/*, $sum*/)
{
    $space = getSpace($filename, $filecount);
    $rspace = convertSizeToReadable($space);
    #$percent = (int)($space * 10000 / $sum)/100;
//    return "<tr><td>$name</td><td>$rspace</td><td>$percent %</td><td style=\"text-align:right\">$filecount</td></tr>";
    return array('name'=>$name, 'space'=>$rspace, /*'space_percent' => $percent,*/ 'filecount'=>$filecount);
}

$content = '';

$usedSpace = getSpace(PROJECT_PATH);
$availableSpace = 4000 * 1024 * 1024;# 4000 MB
$percent = $usedSpace*100/$availableSpace;

$dirnames = array(
    'Log-Dateien'=>LOG_DIR,
    'Cache'=>CACHE_DIR,
    'Bilder'=>PIC_DIR
    );

$sum = getSpace(DATA_DIR);

foreach($dirnames as $dirname => $path)
    $dirs[] = getSpaceLine ($path, $dirname, $sum);

/*                $dirs[] = getSpaceLine(LOG_DIR, 'Log-Dateien', $sum);
$dirs[] = getSpaceLine(CACHE_DIR, 'Cache', $sum);
$dirs[] = getSpaceLine(PIC_DIR, 'Bilder', $sum);*/

$return = new ControllerResult(array('title'=>'Speicherinfo', 'dirs'=>$dirs, 'usedSpace'=>convertSizeToReadable($usedSpace), 'availableSpace'=>convertSizeToReadable($availableSpace), 'percent'=>(int)$percent), $menu_array, STATUS_SUCCESS, NULL, 0, 'spaceinfo');
?>