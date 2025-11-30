<?php

import('Controller', 'controll');

/**
 * Description of article
 *
 * @author Thomas
 */
class gallery_controller extends Controller
{
    public function getPicTitle($gid, $nr)
    {
        $model = Scope::getModelManager()->getObjectIn($gid, 'pic', $nr);

        if($model->status == STATUS_SUCCESS)
            return $model->data['title'];

        return null;
    }

    /**
     *
     * @param <type> $menupath
     * @param <type> $query
     * @param <type> $post
     * @param <type> $cfg
     * @param Scope $scope
     */
    public function call($menupath, $query, $post, $cfg)
    {
        $modelManager = Scope::getModelManager();
        $gid = array_get($cfg, 'gallery', 0, 'int');
        $site = array_get($query, 'site', 0, 'int');
        $article_id = array_get($cfg, 'info-article', 0, 'int');
        $per_page = array_get($cfg, 'per-page', 6, 'int');

        #Verarbeitung
        $subcategorys = $modelManager->getList($gid, 'category')->data;

        $deep = count($menupath);

        if($deep == 0){
            $view = 'article';

            if($article_id)
            {
                import('article_controller', 'controll');
                $pic_model = article_controller::getParsedArticle($article_id);#$modelManager->getObject ('article', $article_id);#loadModelByID('article-'.$article_id);
            }

            else
                return new ControllerResult(
                        array('title'=>'Galerie','content'=>'<p>Einfach eine Auswahl treffen</p>'),
                        null, STATUS_SUCCESS, null, 0, 'article');
        }else if($deep < 3){
            $view = 'gallery';
            $pathGenerator = Scope::getPathGenerator();
            $i = 0;
            $info_article_id = 0;
            $gid = 0;

            foreach($subcategorys as &$cat)
            {
                if($cat['alias'] == $menupath[0])
                {
                    $gid = $cat['category_id'];
                    $cat_title = $cat['title'];
                    $info_article_id = $cat['info_article_id'];
                    $cat['selected'] = true;

//                    if($i)
//                        $prev_cat_title = $subcategorys[$i-1]['title'];
//
//
//                    if($i+1<count($subcategorys))
//                        $next_cat_title = $subcategorys[$i+1]['title'];

                    break;
                }

                ++$i;
            }

            if($gid == null)
            {
                $pos = strpos($menupath[0], '-');

                $id = $pos !== false ? substr($menupath[0], 0, $pos) : $menupath[0];

                $id = (int)$id;

                if($id)
                {
                    $gid = $id;
                    $ccat = $modelManager->getObject('category', $gid);

                    if($ccat->status != STATUS_SUCCESS)
                        $gid = null;

                    else{
                        $cat_title = $ccat->data['title'];
                        $info_article_id = $ccat->data['info_article_id'];
                    }
                }
            }

            if($gid == null)
                return new ControllerResult(null, NULL, STATUS_NOT_FOUND, null, 0, null);

//            if(!empty($subcategorys))
//            {
//                $first_cat_title = $subcategorys[0]['title'];
//                $last_cat_title = $subcategorys[count($subcategorys)-1]['title'];
//            }
            
            if($deep == 1)
                $pic_model = $this->showGallery($info_article_id, $gid, $per_page, $site, $menupath[0], $cat_title);

            else if($deep == 2){
                $count = $modelManager->count($gid, 'pic');
                $view = 'pic';

                //nur der Zahlen-Teil
                $pic_nr = (int)$menupath[1];

                $pic_model = $modelManager->getList($gid, 'pic', 1, $pic_nr);#Object('pic', $pic_id);
                $pic = $pic_model->data = $pic_model->data[0];

                $pic_model->data['path'] = PIC_PATH.'pv'.$pic['pic_id'].'.'.$pic_model->data['type'];
                
                if($pic_nr)
                {
                    $pic_model->data['prev_path'] = $pathGenerator->createPath(array($menupath[0], ($pic_nr-1).'-'.urlencode($prev_title = $this->getPicTitle($gid, $pic_nr-1))));
                    $pic_model->data['prev_title'] = htmlspecialchars($prev_title);
                }

                if($pic_nr + 1 < $count)
                {
                    $pic_model->data['next_path'] = $pathGenerator->createPath(array($menupath[0], ($pic_nr+1).'-'.urlencode($next_title = $this->getPicTitle($gid, $pic_nr+1))));
                    $pic_model->data['next_title'] = htmlspecialchars($next_title);
                }

                if($count > 1)
                {
                    $pic_model->data['first_title'] = htmlspecialchars($first_title = $this->getPicTitle($gid, 0));
                    $pic_model->data['last_title']  = htmlspecialchars($last_title = $this->getPicTitle($gid, $count-1));
                    $pic_model->data['first_path']  = $pathGenerator->createPath(array($menupath[0], '0-'.urlencode($first_title)));
                    $pic_model->data['last_path']   = $pathGenerator->createPath(array($menupath[0], ($count-1).'-'.urlencode($last_title)));
                }

                $pic_model->data['technique'] = $menupath[0];
                $pic_model->data['count'] = $count;
                $pic_model->data['nr'] = $pic_nr + 1;//0 bis count-1 => 1 bis count

                $site = (int)(($pic_nr + $per_page) / $per_page) - 1;
                $pic_model->data['up_path'] = $pathGenerator->createPath(array($menupath[0]), array('site'=>$site));
                $pic_model->data['up_title'] = $cat_title;

#                $model->data['up_path'] = '';

    //            $model = new Model(array('title'=>'Pic', 'content'=>'That is the pic #'.$pic_id), STATUS_SUCCESS, 'pic'.$pic_id);
            }
        }else
            return new ControllerResult(null, NULL, STATUS_NOT_FOUND, null, 0, null);

//        $menu = MySQL::getRow("SELECT ")

        $menu = array();

        #Umkopieren: Nur title und alias
        foreach($subcategorys as $c)
            $menu[] = array('title'=>$c['title'], 'alias'=>$c['alias'], 'selected'=>@$c['selected']);

        return new ControllerResult($pic_model->data, $menu, $pic_model->status,
                $pic_model->cacheID, $pic_model->expires, $view);
    }

    private function showGallery($info_article_id, $gid, $per_page, $site, $prepending, $cat_title)
    {
        $modelManager = Scope::getModelManager();
        $pathGenerator = Scope::getPathGenerator();

        import('article_controller', 'controll');
        $desc = article_controller::getParsedArticle($info_article_id);#$modelManager->getObject('article', $info_article_id);
        $count = $modelManager->count($gid, 'pic');

        $subgal = $modelManager->getList($gid, 'category');
        $pic_model = $modelManager->getList($gid, 'pic', $per_page, $site);

        $nr = $site * $per_page;#Nr.: Das wievielte Bild in der Kategorie

        if($pic_model->status == STATUS_SUCCESS)
        {
            foreach($pic_model->data as &$pic)
            {
                $pic['path'] = PIC_PATH.'tn'.$pic['pic_id'].'.'.$pic['type'];
                $pic['href'] = $pathGenerator->createPath(array($prepending, $nr.'-'.urlencode($pic['title'])));
                ++$nr;
            }

            $siteCnt = (int)(($count+$per_page-1)/$per_page);

            $pic_model->data = array('title'=>$cat_title, 'pics'=>$pic_model->data, 'site'=>$site+1, 'sites'=>$siteCnt);

            if($subgal->status == STATUS_SUCCESS)
            {
                foreach($subgal->data as &$gal)
                {
                    $gal['href'] = $gal['category_id'].'-'.$gal['alias'];
                    $gal['title'] = htmlspecialchars('Galerie "'.$gal['title'].'"');

                    if($gal['cover_pic_id'])
                    {
                        $pic = $modelManager->getObject('pic', $gal['cover_pic_id']);

                        if($pic->status == STATUS_SUCCESS)
                            $gal['pic_path'] = PIC_PATH.'pv'.$gal['cover_pic_id'].'.'.$pic->data['type'];
                    }
                }

                $pic_model->data['gallerys'] = $subgal->data;
            }

            #Gegebenfalls Info-Artikel einblenden
            if($desc->status == STATUS_SUCCESS)
                $pic_model->data['description'] = $desc->data['content'];

            if($site)
            {
                $pic_model->data['prev_path'] = $pathGenerator->createPath(array($prepending), array('site'=>$site-1));
                $pic_model->data['prev_title'] = $cat_title.' - Seite '.$site;#htmlspecialchars($prev_cat_title);
            }

            if($site + 1< $siteCnt)
            {
                $pic_model->data['next_path'] = $pathGenerator->createPath(array($prepending), array('site'=>$site+1));
                $pic_model->data['next_title'] = $cat_title.' - Seite '.($site+2);#htmlspecialchars($next_cat_title);
            }

            if($siteCnt > 1)
            {
                if($site != 0)
                {
                    $pic_model->data['first_path'] = $pathGenerator->createPath(array($prepending), array('site'=>0));
                    $pic_model->data['first_title'] = $cat_title.' - Seite 1';#htmlspecialchars($first_cat_title);
                }

                if($site + 1 != $siteCnt)
                {
                    $pic_model->data['last_path'] = $pathGenerator->createPath(array($prepending), array('site'=>$siteCnt-1));
                    $pic_model->data['last_title'] = $cat_title.' - Seite '.$siteCnt;#htmlspecialchars($last_cat_title);
                }
            }
        }

        return $pic_model;
    }
}
?>
