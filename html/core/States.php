<?php

/**
 * Status für Erfolgreich
 */
define('STATUS_SUCCESS', 200);

/**
 * Status für Unauthorisiert (unangemeltet), Anmeldung notwendig
 */
define('STATUS_UNAUTHORIZED', 401);

/**
 * Status für "Objekt nicht gefunden"
 */
define('STATUS_NOT_FOUND', 404);

/**
 * Status für "Zugriff verweigert"
 */
define('STATUS_FORBITTEN', 403);

//Nicht mehr nötig, da es keine Module mehr gibt
///**
// * Status für "Modul wurde nicht gefunden" (Server-Fehler)
// */
//define('STATUS_MODUL_NOT_FOUND', 544);

/**
 * Status für "Objekt wurde gelöscht und ist nicht mehr verfügbar"
 */
define('STATUS_GONE', 410);

define('STATUS_MENU_ENTRY_NOT_FOUND', 4042);

/**
 * Status für "Controller nicht gefunden"
 */
define('STATUS_CONTROLLER_NOT_FOUND', 545);

/**
 * Status für "Nicht verändert"
 */
define('STATUS_NOT_MODIFIED', 304);

/**
 * Status für "Mehrere Staten"
 */
define('STATUS_MULTIPLE', 207);

/**
 * Status für Moved Temporarly
 */
define('STATUS_TEMP_MOVE', 307);

?>
