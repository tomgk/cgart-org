<?php

/**
 *
 * @author Thomas
 */
interface URLBuilder
{
    /**
     * Erstellt eine (lokale) URL.
     */
    public function createURL($path, $query = array(), $fragment = null);

    /**
     * Erstellt eine URL aus einer externen URL.
     */
    public function createExternalURL($wholeExternalURL);
}
?>