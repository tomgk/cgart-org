<?php

/**
 *
 * @author Thomas
 */
interface ModelManager
{
    /** Name des Services */
    const SERVICE_NAME = 'ModelManager';
    
    /**
     * Gibt eine Auslistnug von $type-Objekten der Kategorie mit der ID
     * $categoryID, wobei Seiten mit der Größe $size erstellt werden. Es
     * wird die Seite # $nr abgefragt. Zurückgegeben werden allerdings nur
     * die IDs der Objekte
     * 
     * @return array ein Array mit den IDs
     */
    public function getIDList($categoryID, $type, $size, $nr);

    public function getList($categoryID, $type, $size = null, $nr = 0, $orderby = null, $dir = null);

    public function count($categoryID, $type);

    /**
     * Gibt das $nr-te Objekt vom Typ $type in der Kategorie mit der ID
     * $categoryID zurück.
     */
    public function getObjectIn($categoryID, $type, $nr);

//    /**
//     * Gibt alle Objekt vom Typ $type mit der ID aus dem Array $ids zurück.
//     * Array-Aufbau: Erstes Array: id->daten. Daten-Array: attribut->value
//     *
//     * @param string $type der Typ des Objekts
//     * @param array $ids ein Array mit IDs oder eine ID
//     * @return array ein assoziatives Array mit den Daten
//     */
//    public function getObjects($type, $ids);

    public function getObject($type, $id);

    /**
     * Gibt das Menü mit dem Alias $alias zurück.
     *
     * @return array das Menü
     */
    public function getMenu($alias);

    /**
     * Fügt ein Objekt des Typs $type in die Kategorie mit der ID $categoryID
     * hinzu. Die Daten des Objekts stehen in $data
     */
    public function add($categoryID, $type, $data);

    /**
     * Löscht das Objekt vom Typ $type und der ID $id. Wenn bekannt, sollte $cat_id übergeben werden
     */
    public function del($type, $id, $cat_id = null);

    /**
     * Verändert das Objekt vom Typ $type und der ID $id. Die veränderten Daten
     * stehen in $data.
     */
    public function edit($type, $id, $data);

    /**
     * Gibt ein assoziatives Array mit den Werten zurück. Wird ein Wert nicht
     * gefunden, kommt er nicht ins Array
     */
    public function getParam($names);

    public function getConfig($scopeName);
}

class Model
{
    /**
     * Status bei der Abfrage.
     * @var int Status-Nr
     */
    public $status;

    /**
     * @var array die Model-Daten, falls vorhanden
     */
    public $data;

    /**
     * @var string eine Idendifikation für den Cache
     */
    public $cacheID;

    /**
     * @var int das Ablaufdatum oder null, wenn es niemals abläuft
     */
    public $expires;

    public function __construct($data, $status, $cacheID, $expires = null)
    {
        $this->data = $data;
        $this->status = $status;
        $this->cacheID = $cacheID;
        $this->expires = $expires;
    }
}
?>