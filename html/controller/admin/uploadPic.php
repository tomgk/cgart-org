<?php

$pg = Scope::getPathGenerator();
$upload_path = $pg->createPath(array($pic_upload, $cat_id));
$data = array('title'=>'Bilder-Upload', 'upload_path'=>$upload_path);

if($post)
{
    if($_FILES['pic']['error'] != UPLOAD_ERR_OK)
    {
        $data['error'] = $_FILES['pic']['error'];
    }else{
        $mm = Scope::getModelManager();

        $filename = $_FILES['pic']['name'];
        $pos = strrpos($filename, '.');
        $type = $pos !== false ? substr($filename, $pos+1) : '';
        $type = strtolower($type);
        $name = $pos !== false ? substr($filename, 0, $pos) : null;

        if(!in_array($type, array('jpg', 'jpeg', 'gif', 'png')))
            $data['error'] = 'Nur Bilder im Format JPEP, GIF und PNG sind erlaubt.';

        else{
            $id = $mm->add($cat_id, 'pic', array('title'=>$name, 'cat_id'=>$cat_id, 'type'=>$type));

            if($id)
                if(move_uploaded_file ($_FILES['pic']['tmp_name'], PIC_DIR.$id.'.'.$type))
                    $return = new ControllerResult (null, null, STATUS_TEMP_MOVE, null, 0, null, $pg->createPath(array($pic_path, $id)));
                else{
                    $data['info'] = 'Kopieren Fehlgeschlagen';
                    $mm->del($type, $id);
                }

            else
                $data['error'] = 'Eintrag in DB fehlgeschlagen';
        }
    }
}

if(!isset($return))
    $return = new ControllerResult($data, $menu_array, STATUS_SUCCESS, null, 0, 'pic_upload');

?>