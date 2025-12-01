<?php

import('ModelManager', 'core');

/**
 * Implementation eines ModelManager, der die Daten mittels mysqli aus einer
 * MySQL-Datenbank speichert und in einem ObjectCache zwischenspeichert.
 *
 * @author Thomas
 */
class MySQLiModelManager implements ModelManager
{
    /**
     * @var mysqli das MySQLi-Objekt
     */
    private $mysqli;

    /**
     * @var ObjectCache der Cache für die Models
     */
    private $modelCache;

    public function __construct($mysqli, $modelCache)
    {
        $this->mysqli = $mysqli;
        $this->modelCache = $modelCache;
    }

    public function getIDList($categoryID, $type, $size, $nr)
    {
        throw new Exception("Warum nur? (unsicher)");
        Scope::getRightManager()->check($categoryID, $type, 'read');
        
        $cacheID = 'list'.$categoryID.'_'.$type.($size ? '-'.$size.'_'.$nr : '');
        
        $model = $this->modelCache->getObject($cacheID);

        if($model == null)
        {
            $model = MySQL::getRows("SELECT ".$type."_id AS id FROM $type WHERE cat_id = $categoryID".($size ? " LIMIT ".$size*$nr.','.$size:''), $this->mysqli);

            foreach($model as &$x)
                $x = $x['id'];
            
            if(empty($model))
            {
                #Kein Ergebnis: Villeicht gibts die Kategorie gar nicht?
                if(!MySQL::exists("SELECT * FROM category WHERE cat_id = $categoryID", $this->mysqli))
                    $model = null;//Gibts nicht!
            }
            
            $this->modelCache->putObject($cacheID, $model);
        }

        return new Model($model, $model !== null ? STATUS_SUCCESS : STATUS_NOT_FOUND, $cacheID);
    }

    public function getList($categoryID, $type, $size = null, $nr = 0, $orderby = null, $dir = null)
    {
/*        #Schlechte Implementierung, aber für inzwischen ...
        $model = $this->getIDList($categoryID, $type, $size, $nr);
        $model->cacheID = 'data'.$model->cacheID;#datalist: Enthällt Daten und nicht nur IDs

        if($model->status == STATUS_SUCCESS)
            return $this->getObjects($type, $model->data);

        else
            return $model;*/

        Scope::getRightManager()->check($categoryID, $type, 'read');

        $cacheID = 'datalist'.$categoryID.'_'.$type.($size ? '-'.$size.'_'.$nr : '').($orderby && $dir ? '-'.$orderby.'_'.$dir:'');

        $model = $this->modelCache->getObject($cacheID);


        if($model == null)
        {
            $model = MySQL::getRows("SELECT * FROM $type WHERE cat_id = $categoryID".($orderby && $dir ? " ORDER BY $orderby $dir" : '').($size ? " LIMIT ".$size*$nr.','.$size:''), $this->mysqli);

            if(empty($model))
            {
                #Kein Ergebnis: Villeicht gibts die Kategorie gar nicht?
                if(!MySQL::exists("SELECT * FROM category WHERE category_id = $categoryID", $this->mysqli))
                    $model = null;//Gibts wirklich nicht!
            }

            $this->modelCache->putObject($cacheID, $model);
        }

        return new Model($model, $model !== null ? STATUS_SUCCESS : STATUS_NOT_FOUND, $cacheID);
    }

    public function getObjects($type, $ids)
    {
        $uncached = array();
        $data = array();

        #Alle gecachten laden
        foreach($ids as $id)
        {
            $cacheID = $type.'-'.$ids;
            $model = $this->modelCache->getObject($cacheID);

            if($model)
                $data[$id] = $model;

            else
                $uncached[] = $id;
        }

        #Wenn noch welche übrig aus DB laden
        if(!empty($uncached))
        {echo '<h1>';var_dump(($uncached));echo '</h1>';
            $objs = MySQL::getRows("SELECT * FROM $type WHERE ".$type.'_id IN ('.implode(',', $uncached).')');

            if($objs === false)
                MySQL::logError($this->mysqli);

            foreach($objs as $obj)
            {
                $id = $obj[$type.'_id'];
                $this->modelCache->putObject($type.'-'.$id, $obj);
                $data[$id] = $obj;
            }
        }

        $rm = Scope::getRightManager();

        foreach($data as &$obj)
        {
            try{echo 'MySQLiModelManager says: I had to look after a(n) '.$type;
                $rm->check($obj['cat_id'], $type, 'read');
            }catch(AccessDeniedException $e){
                #Zugriff verweigert? Stattdesen Exception-Objekt zuweisen
                $obj = $e;
            }
        }

        return new Model($data, STATUS_MULTIPLE, $cacheID);
    }

    public function getObject($type, $id)
    {
        $cacheID = $type.'-'.$id;
        $data = $this->modelCache->getObject($cacheID);
        $status = null;

        if($data == null)
        {
            $data = MySQL::getRow("SELECT * FROM $type WHERE ".$type."_id = $id");
            $status = $data != null ? STATUS_SUCCESS : STATUS_NOT_FOUND;
            
            if($data != null)
                $this->modelCache->putObject($cacheID, $data);
        }else
            $status = STATUS_SUCCESS;
        
        try{
            Scope::getRightManager()->check($data['cat_id'], $type, 'read');
        }catch(AccessDeniedException $e){
            $status = STATUS_FORBITTEN;
            $data = null;#Sicherheitshalber auf null, wird sowieso nicht mehr gebraucht
        }

        return new Model($data, $status, $cacheID);
    }

    public function edit($type, $id, $data)
    {
        if(!$data) throw new InvalidArgumentException ('No data');
        
        $cat_id = MySQL::getField($type, 'cat_id', $type.'_id='.$id, $this->mysqli);

//       Erst nach update cache erneuern!
//        if($cat_id)
//            $this->onDirOp($cat_id, $type, $id);
//
//        else
//            MySQL::logError($this->mysqli);

        Scope::getRightManager()->check($cat_id, $type, 'edit');
        
        $sql = 'UPDATE '.$type.' SET';

        $i = 0;
        $count = count($data);

        foreach($data as $key=>$value)
        {
            $value = $this->mysqli->real_escape_string($value);
            $sql.=" $key = '$value'".(++$i == $count ? '' : ',');
        }

        $sql.= ' WHERE '.$type.'_id = '.$id;

        #Benachrichtigen, dass Ojekt verändert wurde
        if($this->mysqli->query($sql))
        {
            $this->onDirOp($cat_id, $type, $id);
            return true;
        }else{
            MySQL::logError($this->mysqli, $sql);
            return false;
        }
    }

    public function count($categoryID, $type)
    {
        $count = $this->modelCache->getObject('count-'.$categoryID.'-'.$type);

        if($count == null)
        {
            $d = MySQL::getRow("SELECT COUNT(*) AS c FROM $type WHERE cat_id = $categoryID");

            if($d === false)
                $count = null;

            else
                $count = $d['c'];
        }
        
        return $count;
    }

    private function onDirOp($cat_id, $type, $id, $data = null)
    {
        #Löschen der Pages
        //nicht -*: Somit werden auch seitenlose gelöscht
        $this->modelCache->delete('datalist'.$cat_id.'_'.$type.'*');

        #Erneuern bzw. Löschen des veränderten Objekts
        $this->modelCache->putObject($type.'-'.$id, $data);
        
        #Löschen der Zählung
        $this->modelCache->putObject('count-'.$cat_id.'-'.$type, null);
    }
    
    public function add($categoryID, $type, $data)
    {
        if(empty($data))
            throw new InvalidArgumentException("No data given");
        
        $names = array_keys($data);
        
        $values = array_values($data);
        array_map(array($this->mysqli, 'real_escape_string'), $values);
        
        $sql = 'INSERT INTO '.$type.
                ' ('.implode(',', $names).') '.
                'VALUES(\''.implode("','", $values).'\')';


        #neues Objekt (wird) wurde sogar gecacht!
        #jetzt nicht mehr, es könnten in der DB weitere Spalten sein,
        #die vllt. auch mit Standartwert sind, und die würden nicht gecacht weden
        if(MySQL::getRow($sql))
            $this->onDirOp($categoryID, $type, $id = $this->mysqli->insert_id);

        else
            $id = null;
            
        return $id;
    }

    public function del($type, $id, $cat_id = null)
    {
        if($cat_id === null)
        {
            $cat_id = MySQL::getField($type, 'cat_id', $type.'_id = '.$id, $this->mysqli);

            if($cat_id === null)#0 darf ja sein
                return false;
        }

        $sql = "DELETE FROM $type WHERE $type"."_id = $id";
        $deleted = MySQL::getRow($sql, $this->mysqli);

        if($deleted)
            $this->onDirOp ($cat_id, $type, $id);

        return $deleted;
    }

    public function getMenu($alias)
    {
        $cacheID = 'menu-'.$alias;
        $menu = $this->modelCache->getObject($cacheID);

        if($menu == null)
        {
            $menu = MySQL::getRows("SELECT * FROM menuitems WHERE loc = '$alias'", $this->mysqli);
            $this->modelCache->putObject($cacheID, $menu);
        }

        return new Model($menu, STATUS_SUCCESS, $cacheID);
    }

    public function getParam($names)
    {
        $rs = array();
        $notCached = array();

        foreach($names as $name)
        {
            $val = $this->modelCache->getObject('param-'.$name);

            if($val === null)
                $notCached[] = $name;

            else
                $rs[$name] = $val;
        }

        if(!empty($notCached))
        {
            $vals = MySQL::getRows("SELECT name,value FROM params WHERE name IN('".implode("','", $notCached)."')", $this->mysqli);

            foreach($vals as $n_v)
                $rs[$n_v['name']] = $n_v['value'];
        }

        return $rs;
    }

    public function getObjectIn($categoryID, $type, $nr)
    {
        $m = $this->getList($categoryID, $type, 1, $nr);

        if(!empty($m->data))# Auch bei non-SUCCESS
            $m->data = $m->data[0];

        return $m;
    }

    public function getConfig($scopeName)
    {
        $cacheID = 'config_'.$scopeName;
        $cfg = $this->modelCache->getObject($cacheID);
        
        if($cfg === null)
        {
            $cfg = MySQL::getRows("SELECT name, value FROM params WHERE scope = '$scopeName'");

            $nCfg = array();

            foreach($cfg as &$entry)
                $nCfg[$entry['name']] = $entry['value'];

            $cfg = $nCfg;

            $this->modelCache->putObject($cacheID, $cfg);
        }

        return $cfg;
    }
}
?>