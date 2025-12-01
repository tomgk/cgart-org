<?php

import('Modul', 'module');
import('HTTPStatus');

/**
 * Generierte Daten eines Moduls
 *
 * @author Thomas
 */
class ModulData
{
    public $model;
//    public $menu; //Menü ist Controller-Abhängig!
    public $name;
    public $status;

//    private static $TRANS = array(
//        Modul::STATUS_FORBITTEN => 403,
//        Modul::STATUS_GONE => 410,
//        Modul::STATUS_MODUL_NOT_FOUND => 500,
//        Modul::STATUS_SUCCESS => 200,
//        Modul::STATUS_NOT_FOUND => 404,
//        Modul::STATUS_MENU_ENTRY_NOT_FOUND => 404,
//    );
//
//    /**
//     * @var int der HTTP-Status
//     */
//    public $httpStatus;

    /**
     * Die ID, unter der das Objekt im Cache erreichbar ist oder null wenn
     * cachen nicht erlaubt.
     *
     * @var string eine eindeutige ID
     */
    public $cacheID;
    /**
     * Ablaufdatum in Sekunden.
     * null: nie
     * 0: nicht cachen
     *
     * @var int timestamp
     */
    public $expires;

    /**
     * Der Name der Ansicht (z.B. 'detail' für höhere Genauigkeit oder
     * 'miniatur' für verringerter Genauigkeit). Ist view=null, so ist das
     * die Standart-Ansicht
     *
     * @var <type>
     */
    public $view;

    public $lastEdit;

    public function __construct($model, /*$menu,*/ $status, $cacheID, $expires, $view, $lastEdit = null)
    {
        if($status == null) throw new UnexpectedValueException ("status=null");
        $this->model = $model;
//        $this->menu = $menu;
        $this->status = $status;
        $this->cacheID = $cacheID;
        $this->expires = $expires;
//        $this->httpStatus = $this->toHTTPStatus($status);
        $this->view = $view;
        $this->lastEdit = $lastEdit == null ? $lastEdit : time();
    }
    
//    private function toHTTPStatus($status)
//    {
//        return array_get(self::$TRANS, $status, 500);
//        /*switch($status)
//        {
//            case Modul::STATUS_FORBITTEN: return 403;
//            case Modul::STATUS_MODUL_NOT_FOUND: return 500;
//            case Modul::STATUS_SUCCESS: return 200;
//            case Modul::STATUS_NOT_FOUND: return 404;
//            case Modul::STATUS_GONE: return 410;
//            default: return 500;
//        }*/
//    }

    /**
     * Gibt zurück, ob das Model gecacht werden sollte
     * @return boolean true, wenn das Model gecacht werden sollte, sonst false
     */
    public function shouldCache()
    {
        //Gerade das Gegenteil von isExpired()
        return !$this->isExpired();
    }

    /**
     * Gibt zurück, ob das Model "abgelaufen ist", das heißt neu generiert
     * werden sollte.
     *
     * @return boolean true, wenn abgelaufen, sonst false
     */
    public function isExpired()
    {
        //kein Ablaufdatum => false
        if($this->expires === null)
            return false;

        //immer neu => immer alt
        else if($this->expires === 0)
            return true;

        //sonst: Es ist alt, wenn das Ablaufdatum vor (also kleiner als) der
        //jetzigen Zeit ist.
        return $this->expires < time();
    }

//    public function getStatus()
//    {
//        return HTTPStatus::getFullCode($this->httpStatus);
//    }
}
?>
