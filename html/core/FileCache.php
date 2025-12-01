<?php

import('ObjectCache', 'core');

/**
 * Eine Implementierung des ObjectCache, wobei die Objekte serialisert im
 * übergebenen Verzeichnis als Dateien gespeichert werden.
 *
 * @author Thomas
 */
class FileCache implements ObjectCache
{
    /**
     * @var string das Verzeichnis, in dem die Objekte abgelegt werden
     */
    private $dir;
    private $suffix;

    public function __construct($dir, $suffix='.ser.txt')
    {
        if(!$dir) throw new InvalidArgumentException ('dir not set');
        $this->dir = $dir;
        $this->suffix = $suffix;
    }

    public function getObject($cacheID)
    {
        $c = @file_get_contents($this->dir.$cacheID.$this->suffix);
        if($c === false) return null;
        return unserialize($c);
    }

    public function putObject($cacheID, $value)
    {
        if(!preg_match('/^[0-9a-zA-Z\._-]+$/', $cacheID))
            throw new Exception('invalid id');

        if($value === null)
            @unlink($this->dir.$cacheID.$this->suffix);#Egal, wenn Datei nicht existiert
        
        else{#var_dump($this->dir.$cacheID.$this->suffix);
            file_put_contents($this->dir.$cacheID.$this->suffix, serialize($value));

        }
    }

    public function delete($id_glob)
    {
        $arr = glob($this->dir.$id_glob.$this->suffix);

#        if($arr === false)die('FileCache::delete(...) failed with '.$id_glob.'<br/>'.$this->dir.$id_glob.$this->suffix);

        array_map('unlink', (array)$arr);
    }
}
?>