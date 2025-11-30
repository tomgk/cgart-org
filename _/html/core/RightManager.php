<?php

/**
 * Ein Interface zum Überprüfen von Rechten.
 * 
 * @author Thomas
 */
interface RightManager
{
    /**
     * Überprüft, ob der jetzige Benutzer in der Kategorie mit der ID
     * $cat_id auf ein Objekt des Typs $type die Operation $mode ausführen
     * darf. Ist es nicht erlaubt, so wird eine AccessDeniedException geworfen.
     */
    public function check($cat_id, $obj_type, $mode);

    /**
     * Gibt zurück, ob der Benutzer eingeloggt ist.
     */
    public function isLoggedIn();

    /**
     * Einloggen mit Benutzername $username und Passwort $passwort
     */
    public function login($username, $password);

    /**
     * Ausloggen.
     */
    public function logout();
}
?>