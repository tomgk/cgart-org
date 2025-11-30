<?php

import('Controller', 'controll');

/**
 * Description of admin_controller
 *
 * @author Thomas
 */
class admin_controller extends Controller
{
    private function auth($rm, &$post)
    {
        include 'admin/auth.php';
        if(isset($return))
            return $return;
    }

    public function call($menupath, $query, $post, $cfg)
    {
        $rm = Scope::getRightManager();

        $a = $this->auth($rm, $post);
        
        if($a != null)
            return $a;

        $cat_path = "Kategorie";
        $pic_path = "pic";
        $article_path = 'Artikel';
        $gallery_path = 'Gallerien';
        $logout_path = 'logout';
        $space_info = 'Speicherinfo';
        $pic_upload = 'Bilder-Upload';
        $cat_edit = 'cat-edit';
        $pic_delete = 'pic-delete';
        $article_edit = 'Artikel-bearbeiten';
        $article_delete = 'Artikel-delete';

        $menu_array = array(
            array('title'=>'Kategorien', 'alias'=>$cat_path),
#            array('title'=>'Artikel', 'alias'=>$article_path),
#            array('title'=>'Galerien', 'alias'=>$gallery_path),
            array('title'=>'Speicherinfo', 'alias'=>$space_info),
            array('title'=>'Logout', 'alias'=>$logout_path)
        );

        if(($count=count($menupath)) > 0)
        {
            if($menupath[0] == $logout_path)
            {
                $rm->logout();
                return new ControllerResult(array('title'=>'Ausgeloggt', 'content'=>'<p>Ausgeloggt</p>'), array(), STATUS_SUCCESS, null, 0, 'article');
            }else if($menupath[0] == $space_info){
                return $this->space($menu_array);
            }else if($menupath[0] == $cat_path){
                return $this->showDir (array_get($menupath, 1, 0, 'int'), $menu_array, $cat_path, $pic_path, $article_path, $pic_upload, $article_edit, $article_delete);
            }else if($menupath[0] == $pic_path && $count>=2){
                return $this->showPic((int)$menupath[1], $menu_array, $pic_path, $cat_path, $post, $pic_delete);
            }else if($menupath[0] == $pic_upload && array_get($menupath, 1, null, 'int') !== null){
                return $this->uploadPic($pic_upload, $post, $menu_array, (int)$menupath[1], $pic_path);
            }/*else if($menupath[0] == $cat_edit && ($cat_id = array_get($menu_array, 1, null, 'int'))){
                return $this->editCat($cat_id, $cat_edit, $post);
            }*/else if($menupath[0] == $pic_delete && ($pic_id = array_get($menupath, 1, 0, 'int'))){
                return $this->deletePic($pic_delete, $pic_id, $post, $menu_array, $cat_path);
            }else if($menupath[0] == $article_edit && ($article_id = array_get($menupath, 1, 0, 'int'))){
                return $this->editArticle($article_id, $article_edit, $menu_array, $post, $cat_path, $article_path);
            }else if($menupath[0] == $article_path && ($article_id = array_get($menupath, 1, 0, 'int'))){
                return $this->showArticle($article_id, $menu_array, $article_edit);
            }else{
                return new ControllerResult(null, $menu_array, STATUS_NOT_FOUND, null, 0, null);
            }

            /*else if($menupath[0] == $gallery_path){
                $type = 'pic';
            }else if($menupath[0] == $article_path){
                $type = 'article';
            }*/
        }

#        return new ControllerResult(array('title'=>$this->a($rm->isLoggedIn()), 'content'=>''), null, STATUS_SUCCESS, null, 0, 'article');
#        return new ControllerResult(array('title'=>'Adminbereich', 'content'=>'<p>Hier darf nur der Admin hin</p>'), $menu_array, STATUS_SUCCESS, null, 0, 'article');
        return $this->showArticle(array_get($cfg, 'first-site', 5, 'int'), $menu_array, null);
    }

    private function editArticle($article_id, $edit_path, &$menu_array, &$post, $cat_path, $article_path)
    {
        import('article_controller', 'controll');

        $mm = Scope::getModelManager();
        $pg = Scope::getPathGenerator();

        if($post)
        {
            $attrs = array('title', 'content');
            $data = array();

            foreach ($attrs as $attr)
                $data[$attr] = $post[$attr];

            if(isset($data['content']))
                $data['content'] = article_controller::unparseArticle ($data['content']);

//            echo '<script>alert(\''.preg_replace('(\n|\r)', '', article_controller::unparseArticle($post['content'])).'\');</script>';
            $save_status = $mm->edit('article', $article_id, $data);
        }else
            $save_status = null;
        
        $article = $mm->getObject('article', $article_id);
        $model = $article->data;
        $model['edit_path'] = $pg->createPath(array($edit_path, $article_id));
        $model['cancel_path'] = $pg->createPath(array($cat_path, $model['cat_id']));
        $model['save_status'] = $save_status;
        $model['show_path'] = $pg->createPath(array($article_path, $article_id));

        $model['content'] = article_controller::parseArticle($model['content']);
        #echo(($model['content']));
        
        return new ControllerResult($model, $menu_array, $article->status, $article->cacheID, $article->expires, 'article-edit');
    }

    private function showArticle($article_id, &$menu_array, $article_edit)
    {
        import('article_controller', 'controll');
        $pg = Scope::getPathGenerator();
        $a = new article_controller();
        $c = $a->call(null, null, null, array('article'=>$article_id));
        $c->menu = $menu_array;

        if($article_edit)
        $c->model['edit_path'] = $pg->createPath(array($article_edit, $article_id));##$edit_path;
        if($c->viewCacheID)$c->viewCacheID .= 'edit';

        return $c;
    }

    private function deletePic($pic_delete, $pic_id, &$post, &$menu_array, $cat_path)
    {
        include 'admin/deletePic.php';
        return $return;
    }

/*    private function editCat($catID, $cat_edit, &$post)
    {
        if($post != null)

    }*/

    private function uploadPic($pic_upload, &$post, &$menu_array, $cat_id, $pic_path)
    {
        include 'admin/uploadPic.php';
        return $return;
    }

    private function showPic($picID, &$menu_array, $pic_path, $cat_path, &$post, $pic_delete)
    {
        include 'admin/showPic.php';
        return $return;
    }

    private function showDir($catID, &$menu_array, $cat_path, $pic_path, $article_path, $pic_upload_path, $article_edit, $article_delete)
    {
        include 'admin/showDir.php';
        return $return;
    }

    private function space($menu_array)
    {
        include 'admin/space.php';
        return $return;
    }
}

?>