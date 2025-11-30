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
                $model = $modelManager->getObject ('article', $article_id);#loadModelByID('article-'.$article_id);

            else
                return new ControllerResult(
                        array('title'=>'Galerie','content'=>'<p>Einfach eine Auswahl treffen</p>'),
                        null, STATUS_SUCCESS, null, 0, 'article');
        }else if($deep < 3){
            $view = 'gallery';
            $pathGenerator = Scope::getPathGenerator();
            $i = 0;

            foreach($subcategorys as &$cat)
            {
                if($cat['alias'] == $menupath[0])
                {
                    $gid = $cat['category_id'];
                    $cat_title = $cat['title'];
                    $info_article_id = $cat['info_article_id'];
                    $cat['selected'] = true;

                    if($i)
                        $prev_cat_title = $subcategorys[$i-1]['title'];

                    
                    if($i+1<count($subcategorys))
                        $next_cat_title = $subcategorys[$i+1]['title'];

                    break;
                }

                ++$i;
            }

            if(!empty($subcategorys))
            {
                $first_cat_title = $subcategorys[0]['title'];
                $last_cat_title = $subcategorys[count($subcategorys)-1]['title'];
            }
            
            $count = $modelManager->count($gid, 'pic');
            
            if($deep == 1)
            {
                $desc = $modelManager->getObject('article', $info_article_id);

                $model = $modelManager->getList($gid, 'pic', $per_page, $site);
                
                $nr = $site * $per_page;#Nr.: Das wievielte Bild in der Kategorie

                if($model->status == STATUS_SUCCESS)
                {
                    foreach($model->data as &$pic)
                    {
                        $pic['path'] = PIC_PATH.'tn'.$pic['pic_id'].'.'.$pic['type'];
                        $pic['href'] = $pathGenerator->createPath(array($menupath[0], $nr.'-'.urlencode($pic['title'])));
                        ++$nr;
                    }
                    
                    $siteCnt = (int)(($count+$per_page-1)/$per_page);

                    $model->data = array('title'=>$cat_title, 'pics'=>$model->data, 'site'=>$site+1, 'sites'=>$siteCnt);

                    
                    #Gegebenfalls Info-Artikel einblenden
                    if($desc->status == STATUS_SUCCESS)
                        $model->data['description'] = $desc->data['content'];

                    if($site)
                    {
                        $model->data['prev_path'] = $pathGenerator->createPath(array($menupath[0]), array('site'=>$site-1));
                        $model->data['prev_title'] = $cat_title.' - Seite '.$site;#htmlspecialchars($prev_cat_title);
                    }

                    if($site + 1< $siteCnt)
                    {
                        $model->data['next_path'] = $pathGenerator->createPath(array($menupath[0]), array('site'=>$site+1));
                        $model->data['next_title'] = $cat_title.' - Seite '.($site+2);#htmlspecialchars($next_cat_title);
                    }

                    if($siteCnt > 1)
                    {
                        if($site != 0)
                        {
                            $model->data['first_path'] = $pathGenerator->createPath(array($menupath[0]), array('site'=>0));
                            $model->data['first_title'] = $cat_title.' - Seite 1';#htmlspecialchars($first_cat_title);
                        }

                        if($site + 1 != $siteCnt)
                        {
                            $model->data['last_path'] = $pathGenerator->createPath(array($menupath[0]), array('site'=>$siteCnt-1));
                            $model->data['last_title'] = $cat_title.' - Seite '.$siteCnt;#htmlspecialchars($last_cat_title);
                        }
                    }
                }
            }else if($deep == 2){
                $view = 'pic';

                //nur der Zahlen-Teil
                $pic_nr = (int)$menupath[1];

                $model = $modelManager->getList($gid, 'pic', 1, $pic_nr);#Object('pic', $pic_id);
                $pic = $model->data = $model->data[0];

                $model->data['path'] = PIC_PATH.'pv'.$pic['pic_id'].'.'.$model->data['type'];
                
                if($pic_nr)
                {
                    $model->data['prev_path'] = $pathGenerator->createPath(array($menupath[0], ($pic_nr-1).'-'.urlencode($prev_title = $this->getPicTitle($gid, $pic_nr-1))));
                    $model->data['prev_title'] = htmlspecialchars($prev_title);
                }

                if($pic_nr + 1 < $count)
                {
                    $model->data['next_path'] = $pathGenerator->createPath(array($menupath[0], ($pic_nr+1).'-'.urlencode($next_title = $this->getPicTitle($gid, $pic_nr+1))));
                    $model->data['next_title'] = htmlspecialchars($next_title);
                }

                if($count > 1)
                {
                    $model->data['first_title'] = htmlspecialchars($first_title = $this->getPicTitle($gid, 0));
                    $model->data['last_title']  = htmlspecialchars($last_title = $this->getPicTitle($gid, $count-1));
                    $model->data['first_path']  = $pathGenerator->createPath(array($menupath[0], '0-'.urlencode($first_title)));
                    $model->data['last_path']   = $pathGenerator->createPath(array($menupath[0], ($count-1).'-'.urlencode($last_title)));
                }

                $model->data['technique'] = $menupath[0];
                $model->data['count'] = $count;
                $model->data['nr'] = $pic_nr + 1;//0 bis count-1 => 1 bis count

                $site = (int)(($pic_nr + $per_page) / $per_page) - 1;
                $model->data['up_path'] = $pathGenerator->createPath(array($menupath[0]), array('site'=>$site));
                $model->data['up_title'] = $cat_title;

#                $model->data['up_path'] = '';

    //            $model = new Model(array('title'=>'Pic', 'content'=>'That is the pic #'.$pic_id), STATUS_SUCCESS, 'pic'.$pic_id);
            }
        }

//        $menu = MySQL::getRow("SELECT ")

        $menu = array();

        #Umkopieren: Nur title und alias
        foreach($subcategorys as $c)
            $menu[] = array('title'=>$c['title'], 'alias'=>$c['alias'], 'selected'=>@$c['selected']);

        return new ControllerResult($model->data, $menu, $model->status,
                $model->cacheID, $model->expires, $view);
    }
}
?>
