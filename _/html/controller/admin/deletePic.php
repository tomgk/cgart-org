<?php
$real_delete = "delete";
$mm = Scope::getModelManager();
$pg = Scope::getPathGenerator();

$pic = $mm->getObject('pic', $pic_id);

$model = $pic->data;
$back_path = $pg->createPath(array($cat_path, $model['cat_id']));

if(array_get($post, $real_delete, 'no') == 'yes')
{
    if($mm->del('pic', $pic_id, $model['cat_id']))
    {
        #Bilder auch löschen
#        foreach(glob(PIC_DIR.'*'.$pic_id.'.'.$model['type']) as $filename)
#            unlink($filename);

        $types = array('tn','pv','');

        foreach($types as $t)
            unlink(PIC_DIR.$t.$pic_id.'.'.$model['type']);

        $return = new ControllerResult (null, null, STATUS_TEMP_MOVE, NULL, 0, null, $back_path);
    }

    else
        $return = new ControllerResult(array('title'=>'Löschen fehlgeschlagen', 'content'=>'Das Löschen hat nicht funkioniert'),
                $menu_array, STATUS_SUCCESS, NULL, 0, 'article');
}else{
    $model['img_path'] = PIC_PATH.'tn'.$model['pic_id'].'.'.$model['type'];
    $model['back_path'] = $back_path;
    $model['delete_path'] = $pg->createPath(array($pic_delete, $pic_id));
    $model['real_delete'] = $real_delete;

    $return = new ControllerResult($model, $menu_array, $pic->status, null, 0, 'pic-delete');
}
?>