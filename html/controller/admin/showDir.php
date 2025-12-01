<?php

$mm = Scope::getModelManager();

$dir = $mm->getObject('category', $catID);

if($dir->status != STATUS_SUCCESS)
    $return = new ControllerResult (null, $menu_array, $dir->status, null, 0, null);

else{
    $categorys = $mm->getList($catID, 'category');
    $pics = $mm->getList($catID, 'pic');
    $articles = $mm->getList($catID, 'article');

    #        var_dump($dir);echo '<p>';var_dump($categorys);echo '<p>';var_dump( $pics);echo '<p>';var_dump($articles);

    $dir = $dir->data;
    $categorys = $categorys->data;
    $pics = $pics->data;
    $articles = $articles->data;

    $pg = Scope::getPathGenerator();

    foreach($categorys as $key => &$cat)
    {
        if($cat['category_id'])
            $cat['url'] = $pg->createPath(array($cat_path, $cat['category_id']));

        else #Kategorie 0 (aus Katagorie 0) ausblenden
            unset($categorys[$key]);
    }

    foreach($pics as &$pic)
    {
        $pic['url'] = PIC_PATH.'tn'.$pic['pic_id'].'.'.$pic['type'];
        $pic['edit_url'] = $pg->createPath(array($pic_path, $pic['pic_id']));
    }

    foreach($articles as &$article)
    {
        $article['edit_path'] = $pg->createPath(array($article_edit, $article['article_id']));
        $article['show_path'] = $pg->createPath(array($article_path, $article['article_id']));
        $article['delete_path'] = $pg->createPath(array($article_delete, $article['article_id']));
    }

    $parent_cat_url = $catID ? $pg->createPath(array($cat_path, $dir['cat_id'])) : null;

    $return = new ControllerResult(
            array(
                'parent_cat_url' => $parent_cat_url,

                'title'=>$dir['title'],

                'cat_title'=>'Kategorien',
                'categorys'=>$categorys,

                'pic_title'=>'Bilder',
                'pics'=>$pics,
                'pic_upload_path'=>$pg->createPath(array($pic_upload_path, $catID)),

                'article_title'=>'Artikel',
                'articles'=>$articles
                ), $menu_array, STATUS_SUCCESS, null, 0, 'category_list');
}
?>