<?php

import('OBjectCache', 'core');

/**
 * Eine Implementierung eines ObjectCache, wobei diese Implementierung alles
 * sofort löscht (also garnicht erst speichert)
 *
 * @author Thomas
 */
class NullCache implements ObjectCache
{
    public function getObject($id)
    {
        return null;#nichts wird gespeichert => nicht gefunden
    }

    public function putObject($id, $value)
    {
        //nicht speichern
    }

    public function delete($id_glob)
    {
        //nix drin, nix löschen (hat er schon vorher erledigt)
    }
}
?>