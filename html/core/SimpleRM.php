<?php

import('RightManager', 'core');
import('AccessDeniedException', 'core');

/**
 * Einfacher Rechte-Manager: Jeder darf lesen, Eingeloggte sind Admins.
 *
 * @author Thomas
 */
class SimpleRM implements RightManager
{
    private $isLoggedIn;

    public function __construct()
    {
        session_start();
        $this->isLoggedIn = &$_SESSION['isLoggedIn'];
#        var_dump($this->isLoggedIn);
    }

    public function check($cat_id, $type, $mode)
    {
        #Weder Lesen (jeder) noch eingeloggt (add/edit/remove)
        if($mode != 'read' && !$this->isLoggedIn)
            throw new AccessDeniedException ("Login required");
    }

    public function isLoggedIn()
    {
        return $this->isLoggedIn;
    }

    public function login($username, $password)
    {
        import('users', 'cfg');
        $users = cfg_getUsers();
        
        session_regenerate_id();
        return $_SESSION['isLoggedIn'] = $this->isLoggedIn = $password != null && array_get($users, $username, null) == $password;
    }

    public function logout()
    {
        $_SESSION['isLoggedIn'] = $this->isLoggedIn = false;
        session_regenerate_id();
    }
}
?>