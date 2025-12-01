<?php

import('array');

/**
 * Description of HTTPStatus
 *
 * @author Thomas
 */
class HTTPStatus
{
    /**
     * Don't use outsite (implemention-dependet, maybe removed in future)
     */
    private static $STATES = array(
        403 => 'Forbitten',
        404 => 'Not Found',
        200 => 'OK',
        500 => 'Internal Server Error',
        400 => 'Bad Request',
        201 => 'Created',
        410 => 'Gone'
    );

    public static function getFullCode($httpStatusCode)
    {
        $x = array_get(self::$STATES, $httpStatusCode, null);
        return $x ? $httpStatusCode.' '.$x : $httpStatusCode;
    }
}
?>