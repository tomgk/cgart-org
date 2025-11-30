<?php
try{
    $rm->check(0, '*', 'all');
}catch(AccessDeniedException $e)
{
    #Anscheinden zwar eingeloggt, darf es aber trotzdem nicht
    if($rm->isLoggedIn())
        $return = new ControllerResult(NULL, null, STATUS_FORBITTEN, null, 0, null);

    $pwKey = 'pw';
    $userKey = 'username';

    $loggedIn = false;
    $info = 'Login notwendig';
    $status = 'info';
    $username = '';

    #Login-Daten übermittelt
    if($post != null)
    {
        $username = array_get($post, $userKey);
        $password = array_get($post, $pwKey);

        if(!($loggedIn = $rm->login($username, $password)))
        {
            $status = 'error';
            $info = 'Ungültige Benutzername oder Passwort';
        }
    }

    if(!$loggedIn)
    {
        $pg = Scope::getPathGenerator();
        $loginPath = $pg->createPath(array());

        $return = new ControllerResult(
                array(
                    'username'=>$username,
                    'status'=>$status,
                    'info'=>$info,
                    'usernamekey'=>$userKey,
                    'passwordkey'=>$pwKey,
                    'title'=>'Adminbereich',
                    'url'=>$loginPath),
                null, STATUS_SUCCESS, null, 0, 'login');
    }
}
?>
