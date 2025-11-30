<?php
$mm = Scope::getModelManager();

if($post != null)
{
    $keys = array('title', 'c_year', 'width', 'height');

    $data = array();

    foreach ($keys as $key)
        if(isset($post[$key]))
            $data[$key] = $post[$key];

    $save_state = $mm->edit('pic', $picID, $data);#Erfolgreich(true) gespeichert oder Fehler (false)
}else
    $save_state = null;#Nicht-Gespeichert-Status

$pg = Scope::getPathGenerator();
$pic = $mm->getObject('pic', $picID);

if($pic->status != STATUS_SUCCESS)
    $return = new ControllerResult (null, $menu_array, $pic->status, null, 0, null);

else
{
    $pic = $pic->data;
    $pic['path'] = PIC_PATH.'pv'.$pic['pic_id'].'.'.$pic['type'];
    $pic['save_path'] = $pg->createPath(array($pic_path, $picID));
    $pic['cancel_path'] = $pg->createPath(array($cat_path, $pic['cat_id']));
    $pic['save_state'] = $save_state;
    $pic['pic_upload'] = false;
    $pic['pic_delete_path'] = $pg->createPath(array($pic_delete, $picID));

    $return = new ControllerResult($pic, $menu_array, STATUS_SUCCESS, null, 0, 'pic_edit');
}
?>