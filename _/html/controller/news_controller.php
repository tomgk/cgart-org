<?php

import('Controller', 'controll');

/**
 * Description of news_controler
 *
 * @author Thomas
 */
class news_controller extends Controller
{
    public function call($menupath, $query, $post, $cfg)
    {
        $modelManager = Scope::getModelManager();
        $pathGenerator = Scope::getPathGenerator();
        $cat_id = array_get($cfg, 'category', 0, 'int');
        $per_page = array_get($cfg, 'per-page', 10, 'int');
        $site = array_get($query, 'site', 0, 'int');
        $category = $modelManager->getObject('category', $cat_id);
        $count = $modelManager->count($cat_id, 'article');

        if($category->status != STATUS_SUCCESS)
            return new ControllerResult (null, null, $category->status, null, 0, null);
        
        $newslist = $modelManager->getList($cat_id, 'article', $per_page, $site, 'article_id', 'DESC');

        ## Bug: Vorher wurde Artikel nicht geparst ##
        import('article_controller', 'controll');

        foreach($newslist->data as &$news)
            $news['content'] = article_controller::parseArticle($news['content']);

        ## Bug Lösung Ende ##

        $model = $category->data;
        $model['news'] = $newslist->data;

        $sitecnt = (int)(($count + $per_page - 1) / $per_page);
        
        $cat_title = $category->data['title'];

        $model['prev_title'] = $cat_title.' - Seite '.$site;
        $model['prev_path'] = $site>0 ? $pathGenerator->createPath(array(), array('site' => $site-1)) : '';
        $model['next_title'] = $cat_title.' - Seite '.($site+2);
        $model['next_path'] = $site+1<$sitecnt ? $pathGenerator->createPath(array(), array('site' => $site+1)) : '';
        $model['first_path'] = $site!=0 ? $pathGenerator->createPath(array(), array('site' => 0)) : '';
        $model['first_title'] = $cat_title.' - Seite 1';
        $model['last_path'] = $site+1<$sitecnt ? $pathGenerator->createPath(array(), array('site' => $sitecnt-1)) : '';
        $model['last_title'] = $cat_title.' - Seite '.$sitecnt;

        $model['sites'] = $sitecnt;
        $model['site'] = $site+1;
#        return new ControllerResult(array('title'=>'Somewhere', 'content'=>'<p>You.</p>'), NULL, STATUS_SUCCESS, null, 0, 'article');
        return new ControllerResult($model, null, ($site>=0 && $site < $sitecnt) ? STATUS_SUCCESS : STATUS_NOT_FOUND, null, 0, 'news');
    }
}

?>