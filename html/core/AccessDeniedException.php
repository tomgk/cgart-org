<?php

/**
 * Wird geworfen, wenn der Zugriff verweigert wurde.
 *
 * @author Thomas
 */
class AccessDeniedException extends RuntimeException
{
    public function __construct($message = null, $code = null)
    {
        parent::__construct($message, $code);
    }
}
?>
