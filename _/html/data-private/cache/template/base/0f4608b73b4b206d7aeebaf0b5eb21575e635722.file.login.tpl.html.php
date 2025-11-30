<?php /* Smarty version Smarty-3.0.5, created on 2011-03-19 21:55:15
         compiled from "/var/www/web220/html/data-private/template/base/login.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:6731550924d8518334c90e6-90815415%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f4608b73b4b206d7aeebaf0b5eb21575e635722' => 
    array (
      0 => '/var/www/web220/html/data-private/template/base/login.tpl.html',
      1 => 1300568021,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6731550924d8518334c90e6-90815415',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<style type="text/css">
    form.login
    {
        
    }

    .error
    {
        color: red;
    }

    form
    {
        padding: 0.5em;
    }

    dd, dt
    {
        padding: 0.25em 0;
    }

    dt
    {
        width: 10em;
        float: left;
    }

    input.sumbit
    {
        clear: left;
    }
</style>

<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>

<p class="<?php echo $_smarty_tpl->getVariable('status')->value;?>
"><?php echo $_smarty_tpl->getVariable('info')->value;?>
</p>

<form class="login" action="<?php echo $_smarty_tpl->getVariable('url')->value;?>
" method="post">
    <dl>
        <dt><label for="user">Benutzername:</label></dt>
        <dd><input id="user" name="<?php echo $_smarty_tpl->getVariable('usernamekey')->value;?>
" value="<?php echo $_smarty_tpl->getVariable('username')->value;?>
" /></dd>

        <dt><label for="pw">Passwort:</label></dt>
        <dd><input id="pw" name="<?php echo $_smarty_tpl->getVariable('passwordkey')->value;?>
" type="password" /></dd>
    </dl>

    <input class="submit" type="submit" value="Einloggen" />
</form>