<?php

$uri = $_SERVER['REQUEST_URI'];#$_SERVER['REQUEST_URI'];

#var_dump($_SERVER['REQUEST_URI']);

function nf()
{
    header("HTTP/1.1 404 Not Found");
    header("Content-Type:text/html;charset=UTF-8");
    ?>
<h1>Datei nicht gefunden</h1>
<p>Die gewünschte Datei konnte nicht gefunden werden</p>
    <?php
    die;
}

if(preg_match('#/.+?/(tn|pv)([0-9]+).(jpg|jpeg|gif|png)$#', $uri, $matches))
{
    //Tumbnail generieren
    if(function_exists('imagecreatetruecolor'))
    {
        ini_set("memory_limit","100M");

//        $pos = strrpos($_SERVER['REQUEST_URI'], '/');
        $type = $matches[1];//tn oder pv (Thumbnail:200x200 oder Preview:600x600)
        $name = $matches[2];//substr($_SERVER['REQUEST_URI'], $pos+2);
        $file_ext = $matches[3];
        $file = $name.'.'.$file_ext;

#        if(!file_exists($file))
#            die('Datei wurde nicht gefunden');

        if(file_exists($file))
        {
            $new_img = imagecreatefromjpeg($file);
            list($width, $height) = getimagesize($file);

            #Je nach Typ 200x200 (tn) oder 600x600 (pv) nehmen
            $ThumbWidth = $type == 'pv' ? 600 : 200;
            $ThumbHeight = $type == 'pv' ? 400 : 200;

    //        //calculate the image ratio
    //        $imgratio=$width/$height;

    //        if ($imgratio>1)
    //        {
    //            $newwidth = $ThumbWidth;
    //            $newheight = $ThumbWidth/$imgratio;
    //        }else{
    //            $newheight = $ThumbWidth;
    //            $newwidth = $ThumbWidth*$imgratio;
    //        }

            $rw = $ThumbWidth / $width;
            $rh = $ThumbHeight / $height;

            if($rw < $rh)//Breite kleiner
            {
                $newwidth = $width * $rw;
                $newheight = $height * $rw;
            }else{//höhe kleiner oder gleich
                $newwidth = $width * $rh;
                $newheight = $height * $rh;
            }

    #        die($ThumbWidth.' zu '.$ThumbHeight.'='.$newwidth.' zu '.$newheight);

            $resized_img = imagecreatetruecolor($newwidth,$newheight);

            //the resizing is going on here!
            imagecopyresized($resized_img, $new_img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

            //finally, save the image
            ImageJpeg ($resized_img, "$type$name.$file_ext");

            //and destroy both
            ImageDestroy ($resized_img);
            ImageDestroy ($new_img);

    //        echo 'READ FILE';
    //        readfile($type.$file);
            header('Location: '.$type.$file);
        }else
            nf();
    }else{
        nf();
        echo 'FAIL/!G';
    }
}else
    nf();
?>
