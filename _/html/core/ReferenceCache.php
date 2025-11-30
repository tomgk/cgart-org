<?php

import('ObjectCache', 'core');

/**
 * Eien Implementation von ObjectCache, der die Objekte in einer Variablen
 * speichert. Die Variable könnte z.B. ein Index von $_SESSION sein.
 *
 * @author Thomas
 */
class ReferenceCache implements ObjectCache
{
    private $dest;

    public function __construct(&$ref)
    {
        $this->dest =& $ref;
    }

    public function putObject($id, $value)
    {
        if($value === null)
            unset($this->dest[$id]);

        else
            $this->dest[$id] = $value;
    }

    public function getObject($id)
    {
        return array_get($this->dest, $id, null);
    }
}
?>