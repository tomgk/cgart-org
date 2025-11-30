<?php /* Smarty version Smarty-3.0.5, created on 2011-03-20 13:07:06
         compiled from "/var/www/web220/html/data-private/template/base/pic-delete.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:988145894d85edea83bb96-51079172%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa12495392c4f858b0b8ce8923c894319d012e3b' => 
    array (
      0 => '/var/www/web220/html/data-private/template/base/pic-delete.tpl.html',
      1 => 1300622721,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '988145894d85edea83bb96-51079172',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>

<p>Wirklich löschen?</p>
<div>
<form style="display:inline" action="<?php echo $_smarty_tpl->getVariable('delete_path')->value;?>
" method="post">
    <input name="<?php echo $_smarty_tpl->getVariable('real_delete')->value;?>
" type="hidden" value="yes" />
    <input type="submit" value="Ja" />
</form>

<form style="display:inline" action="<?php echo $_smarty_tpl->getVariable('back_path')->value;?>
" method="get">
    <input value="Nein" type="submit" />
</form>
</div>
<img src="<?php echo $_smarty_tpl->getVariable('img_path')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('title')->value;?>
" alt="<?php echo $_smarty_tpl->getVariable('title')->value;?>
" />