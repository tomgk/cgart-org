<?php

import('ControllerResult', 'controll');

/**
 * Description of Controller
 *
 * @author Thomas
 */
abstract class Controller
{
    /**
     * Initalisert den Controller
     *
     * @param string $menupath der Pfad des gewählten Menüs (das vom Controller erstellt wurde)
     * @param array $query die Daten, die mit dem Query-Teil der URL übergeben wurden
     * @param array $post die Daten die gepostet wurden ($_POST)
     * @param array $cfg die Konfigurationsdaten für den Controller (wurden in Datenbank definiert)
     *
     * @return ControllerResult das Ergebnis des Controllers
     */
    public abstract function call($menupath, $query, $post, $cfg);
    
/*    {
        $this->menupath = $menupath ? explode('/', $menupath) : array();
        $this->query = $query;
        $this->post = $post;
        $this->cfg = $cfg;
        $this->validateCfg();
    }*/
}
?>