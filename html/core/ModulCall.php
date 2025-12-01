<?php

import('string');
import('smarty.Smarty');
import('MySQL');
#import('Modul', 'modul');
import('FileCache', 'core');
#import('SimpleModelManager', 'core');
import('ArgParser', 'core');
import('Controller', 'controll');
import('Scope', 'core');
import('MySQLiModelManager', 'core');
import('SimpleRM', 'core');
import('States', 'core');
import('PathGenerator');

class PathGenWrapper implements PathGenerator
{
    private $pre;
    /**
     * @var PathGenerator
     */
    private $gen;

    /**
     * @param array $pre das Prepend
     */
    public function __construct($pre, $gen)
    {
        $this->pre = $pre;
        $this->gen = $gen;
    }

    public function createPath($pieces, $query = null, $fragment = null)
    {
        if(!is_array($pieces)) throw new UnexpectedValueException ('pieces');
        
        return $this->gen->createPath(array_merge($this->pre, $pieces), $query, $fragment);
    }
}

/**
 * Description of ModulCall
 *
 * @author Thomas
 */
class ModulCall
{
    /**
     * @var Smarty smarty
     */
    private $smarty;

    /**
     * @var ObjectCache das Cache für die Models
     */
    private $modelCache;
    
    /**
     * @var ModelManager der dazugehöriger ModelManager
     */
    private $modelManager;

    private $scope;

    public function __construct($tplName)
    {
        $this->smarty = new Smarty();
        $this->smarty->caching = true;
        $this->smarty->cache_dir = CACHE_SITES_PATH.$tplName.DS;
        $this->smarty->compile_dir = TEMPLATE_COMPILE_PATH.$tplName.DS;
        $this->smarty->template_dir = $tplName != 'base' ? array(
            TEMPLATE_PATH.$tplName.DS,
            TEMPLATE_PATH.'base'.DS
        ) : array(TEMPLATE_PATH.'base'.DS);

        $this->smarty->assign('icon_path', ICON_PATH);
        $this->smarty->assign('js_path', JS_PATH);
        $this->smarty->assign('css_path', CSS_PATH);
        
        $this->modelCache = new FileCache(MODEL_CACHE);

        #import('NullCache', 'core');
        #$this->modelCache = new NullCache();

        $this->modelManager = new MySQLiModelManager(MySQL::$MYSQL, $this->modelCache);#SimpleModelManager($this->modelCache);#, RELATION_DIR);
        $this->scope = new Scope(null);
        $this->scope->put(ModelManager::SERVICE_NAME, $this->modelManager);
        Scope::enter($this->scope);
        Scope::setRightManager(new SimpleRM(false));
    }

    /**
     * Menü der folgener Struktur:
     *
     * Menu =
     * {
     *  subMenu: Menu[],
     *  title/name: String,
     *  iconname:String,//Referenz auf Icon in IconSet
     *  name:String,//Name für Pfad-Auflösung und Link-Generierung
     * }
     *
     * @var <type>
     */
//    private $menu;

    /**
     * Ruft eine Seite auf
     * 
     * @param array $path der Pfad vom Menü
     * @param PathGenerator $pathBuilder der Pfad-Generator
     */
    public function call($path, $pathBuilder)
    {
#        $this->scope->put(PathGenerator::SERVICE_NAME, $pathBuilder);
//        $this->genMenu();
        
        #Lade das Model über ein Menü
        $data = $this->callControllerByBath($path, $pathBuilder, $prePath);

        if($data->menu)
        {
            foreach($data->menu as &$item)
            {
                $item['href'] = $pathBuilder->createPath(array($prePath, $item['alias']));
            }
        }
        
        header("HTTP/1.0 ".$data->httpStatus);
        
        if($data->status == STATUS_SUCCESS)
        {
            try{
                $this->show($data->viewName, $data->model, null);//$data->cacheID);
            }catch(SmartyException $e){
                echo '<h1>Interner Fehler</h1><p>Es ist ein serverseitiger Fehler aufgetreten.</p>';
                import('Log', 'core');
                Log::write($e, Log::FATAL);
            }
        }

        else if($data->status == STATUS_NOT_MODIFIED)
        {
            header('HTTP/1.0 '.$data->getStatus());
        }

        else if($data->status == STATUS_TEMP_MOVE)
        {
            header('Location: '.$data->statusInfo);
            die;
        }
        
        else
        {
            $data->model['title'] = $data->getStatus();
            header('HTTP/1.0 '.$data->getStatus());
            echo '<h1>'.$data->getStatus().'</h1>';
            #echo '<h1>Das ist der Fehler #'.$data->status.' (non-HTTP-Errorcode) </h1>';

            import('Log', 'core');
            Log::write('Status '.$data->status, Log::ERROR);

            if($data->statusInfo != null)
                echo "<p>$data->statusInfo</p>";

            else switch ($data->httpStatus)
            {
                case 404: echo '<p>Die gewünschte Seite wurde nicht gefunden.</p>'; break;
                default:
                    echo '<p>Es ist ein serverseitiger Fehler aufgetretten (Code '.$data->status.')</p>';
                    break;
            }
        }

        #$title = &$data->model['title'];#Referenz
        $wtitle = array_get($this->modelManager->getParam(array('title')), 'title', '?');
        
        $data->model['start_title'] = $data->model['wtitle'] = $wtitle;
        $data->model['start_path'] = $data->model['wurl'] = $pathBuilder->createPath(array());
        
        $title = $data->model['title'];

        if($data->model['title'])
            $title = $title.' - '.$wtitle;

        else
            $title = $wtitle;

        $data->model['title'] = $title;

        return $data;
    }

//    public function genMenu()
//    {
//        $this->menu = $this->modelCache->getObject('menu');
//
//        if($this->menu == null)
//        {
//            $this->menu = MySQL::getRows("SELECT title, alias FROM menuitem");
//            $this->modelCache->putObject('menu', $this->menu);
//        }
//    }

    /**
     * 
     * @param String $path der (Teil-)Pfad vom Menü
     * @return ControllerResult das Ergebniss des Controllers
     */
    private function callControllerByBath($path, $pathGen, &$prePath)
    {
        $isNotHome = !empty($path);#string_split_first($path, '/', $first, $rest);
        $first = array_shift($path);
        $rest = $path;

        $first = MySQL::escape($first);
        $prePath = $first;

        $menu = MySQL::getRows("SELECT title, alias, component, params FROM menuitem ORDER BY id");#.($isNotHome ? '' : 'WHERE alias="'.$first.'"'));

        $controllName = null;
        $args = null;

        foreach($menu as &$m)
        {
            //Gewähltes oder 1. und kein gewähltes
            if($m['alias'] == $first || ($controllName == null && ($path == '/' || !$path)))
            {
                $prePath = $m['alias'];#Falls Startseite, dann wird $first initalisiert
                $controllName = $m['component'];
                $args = ArgParser::parseArgs($m['params']);
            }

            unset($m['params'], $m['component']);
        }

        $this->scope->put(PathGenWrapper::SERVICE_NAME, new PathGenWrapper(array($prePath), $pathGen));

        if($controllName == null)
            return new ControllerResult(null, null, STATUS_MENU_ENTRY_NOT_FOUND, null, 0, null);
        ////ModulData (null, null, Modul::STATUS_MENU_ENTRY_NOT_FOUND);
        
        $scope = new Scope(null);
        $scope->put(ModelManager::SERVICE_NAME, $this->modelManager);

//        $models = new ModelManager($modelCache);

        return $this->createAndCallControll($controllName, $args, $rest, $_GET, $_POST, $scope);
        /*$modul = $this->createModul($modulName, $args, $rest, $_GET, $_POST);

        if($modul)
        {
            $data = $this->loadModulData($modul);
            $data->name = $modulName;
        }

        else
            $data = new ModulData($modulName, null, Modul::STATUS_MODUL_NOT_FOUND, null);

        return $data;*/
/*        if($modul->getStatus() == Modul::STATUS_SUCCESS)
            $this->show($modul, $model);

        return $modul->getStatus();*/
    }


//    /**
//     * Ladet ein Model
//     *
//     * @param string $controllName der Name des Modules, das das Model erstellt
//     * @param array  $args die Parameter an das Modul
//     * @param string $menupath der Pfad des Moduls
//     * @param array  $query die Query an das Modul (Normalerweise $_GET)
//     * @param array  $post die geposteten Daten des Moduls (Normalerweise $_POST)
//     *
//     * @return ModulData die geladenen Daten
//     */
//    public function loadCModel($controllName, $args, $menupath, $query, $post, $scope)
//    {
//        $result = $this->createAndCallControll($controllName, $args, $menupath, $query, $post, $scope);
//                //($modulName, $args, $rest, $_GET, $_POST);
//
///*        if($result)
//        {
//            $data = $this->loadModulData($result);
//            $data->name = $controllName;
//        }
//
//        else
//            $data = new ControllerResult ($controllName, null, Modul::STATUS_CONTROLLER_NOT_FOUND, null, 0, null);*/
//
//        return $result;
//    }

    /**
     * Erstellt und initalisiert ein Modul mit den übergebenen Daten.
     *
     * @param string $name der Name des Moduls
     * @param array  $args die Parameter aus dem Menü
     * @param string $menupath der Pfad im moduldefinierten Menü
     * @param array  $query die Query der URL
     * @param array  $post die Daten, die an das Modul gepostet wurden
     *               oder null, wenn keine gesendet wurden
     * @return Modul das Modul oder null, wenn das Modul nicht gefunden wurde
     */
    private function createAndCallControll($name, $args, $menupath, $query, $post, $scope)
    {
        $controller = $this->createControll($name);

        if($controller == null)
            return new ControllerResult (array(), null, STATUS_CONTROLLER_NOT_FOUND, null, 0, null);

        return $controller->call($menupath, $query, $post, $args, $scope);
#        return $modul;
    }

    /**
     * Erstellt einen Controller. Gibt null zurück, wenn der Controller nicht
     * gefunden wurde.
     * 
     * @param string $name Name des Controllers
     * @return Controller der Controller
     */
    private function createControll($name)
    {
        $clazz = $name.'_controller';
        if(!tryImport($clazz, 'controll'))
            return null;

        return new $clazz();
    }
    
    private function show($template, $model, $cacheID)
    {
        if($cacheID == null)
        {
            $x = $this->smarty->caching;
            $this->smarty->caching = false;
        }

        $this->assignAll($model);
        $this->smarty->display($template.'.tpl.html', $cacheID);
        $this->disassignAll($model);
        
        if($cacheID == null)
            $this->smarty->caching = $x;
    }

    private function assignAll($arr)
    {
        foreach($arr as $key => &$value)
            $this->smarty->assign($key, $value);
    }

    private function disassignAll($arr)
    {
        foreach($arr as $key => &$value)
            $this->smarty->clearAssign ($key);
    }

    /**
     * Ruft nur den Inhalt der Seite auf
     * @param string $path der Pfad vom Menü
     */
    public function callContent($path)
    {
        
    }
}
?>