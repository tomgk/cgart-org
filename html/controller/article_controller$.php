<?php

import('Controller', 'controll');

/**
 * Description of article
 *
 * @author Thomas
 */
class article_controller extends Controller
{
    /**
     *
     * @param <type> $menupath
     * @param <type> $query
     * @param <type> $post
     * @param <type> $cfg
     */
    public function call($menupath, $query, $post, $cfg)
    {
        $modelManager = Scope::getModelManager();
        $article_id = array_get($cfg, 'article', 0, 'int');
        $model = $modelManager->getObject('article', $article_id);

        $model->data['content'] = article_controller::parseArticle($model->data['content']);

#        $article = $model->status == STATUS_SUCCESS ? $model->data[0] : null;

        return new ControllerResult($model->data, null, $model->status,
                $model->cacheID, $model->expires, 'article');
    }

    public static function unparseArticle($content)
    {
        $p = str_replace('/', '\/', PIC_PATH);
        
        //[1] = vor src="..."
        //[2] = type (tn|pv|)
        //[3] = id
        //[4] = nach src="..."
        $content = preg_replace_callback('/<img (.*?)src="'.$p.'([a-z]*)([0-9]+)\.[a-z]+"(.*?)\/?>/', array('self', 'img'), $content);
        return $content;
    }

    static function img($data)
    {
        $args = $data[1].' : '.$data[4];
        $type = $data[2];
        $id = $data[3];

        $args = self::parse($args);
        $class = array_get($args, 'class');
        $width = array_get($args, 'width', 0, 'int');
        $height = array_get($args, 'height', 0, 'int');

#        echo '<p>',$type.'#'.$id;
#        echo '/',$class,'</p>';
        return '<pic id="'.$id.'"'.
        ($type?' type="'.$type.'"':'').
        ($class?' align="'.$class.'"':'').
        ($width?' width="'.$width.'"':'').
        ($height?' height="'.$height.'"':'').' />';
    }

    public static function parseArticle($content)
    {
        $content = preg_replace_callback('/<pic (.*?)>/', array('self', 'pic'), $content);
        return $content;
    }

    static function pic($data)
    {
        $args = self::parse($data[1]);

        $align = array_get($args, 'align', 'left');
        $id = array_get($args, 'id', 0, 'int');
        $title = array_get($args, 'title');
        $width = array_get($args, 'width', 0, 'int');
        $height = array_get($args, 'height', 0, 'int');
        $alt = $title ? $title : 'Bild '.$id;

        $type = array_get($args, 'type', '');

        $mm = Scope::getModelManager();

        $pic = $mm->getObject('pic', $id);

        $path = PIC_PATH.$type.$id.'.'.$pic->data['type'];

        article_controller::parse('id=5');

        return '<img src="'.$path.'" class="'.$align.'" alt="'.$alt.'" '.($title ? 'title="'.$title.'"':'').
        ($width?' width="'.$width.'"':'').
        ($height?' height="'.$height.'"':'').' />';
    }

    private static function parse($str)
    {
        $i = 0;
        $len = strlen($str);

        $args = array();

        preg_match_all('/\s*([a-zA-Z]+)\s*=("[^"]*"|\w+"?)/', $str, $matches, PREG_SET_ORDER);

        $args = array();

        foreach($matches as $match)
        {
            $key = $match[1];
            $value = $match[2];

            if($value[0] == '"')
                $value = substr ($value, 1);

            if($value[strlen($value)-1] == '"')
                $value = substr ($value, 0, strlen($value)-1);

            $args[$key] = $value;
        }


        return $args;
    }
}
?>