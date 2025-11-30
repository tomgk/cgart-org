<?php

/**
 * Verwaltet gecacachte Objekte. Wie die Objekte gespeichert werden, hängen von
 * der Implementierung ab.
 * 
 * <p>
 * Objekte können vom Cache gelöscht werden (keine Sicherheit, dass Objekt im
 * Cache bleibt)
 * </p>
 *
 * @author Thomas
 */
interface ObjectCache
{
    /**
     * Gibt das Objekt mit der ID zurück. NULL bedeutet, das das Objekt nicht im
     * Cache ist.
     *
     * @param string $id die ID des Objektes
     */
    public function getObject($id);

    /**
     * Setzt ein Objekt im Cache. Wenn NULL als Wert übergeben wird, so wird das
     * Objekt aus dem Cache gelöscht.
     *
     * @param string $id die ID des Objekts
     * @param mixed $value das Objekt (beliebiger Typ)
     */
    public function putObject($id, $value);

    /**
     * Löscht alle Objekte, dessen ID mit dem $glob matcht.
     *
     * @param string $id_glob die Glob
     */
    public function delete($id_glob);
}
?>
