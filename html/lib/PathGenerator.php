<?php

/**
 *
 * @author Thomas
 */
interface PathGenerator
{
    const SERVICE_NAME = 'PathGenerator';
    
    public function createPath($pieces, $query=null, $fragment=null);
}
?>