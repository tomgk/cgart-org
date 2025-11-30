<?php /* Smarty version Smarty-3.0.5, created on 2011-03-24 23:01:02
         compiled from "/var/www/web220/html/data-private/template/base/article.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:975494024d8bbf1e030695-45836494%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '920960f94fe7c17302ed7905a823461f1ae07eea' => 
    array (
      0 => '/var/www/web220/html/data-private/template/base/article.tpl.html',
      1 => 1301004020,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '975494024d8bbf1e030695-45836494',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (isset($_smarty_tpl->getVariable('edit_path',null,true,false)->value)){?><p class="op-menu"><a href="<?php echo $_smarty_tpl->getVariable('edit_path')->value;?>
">Artikel bearbeiten</a></p><?php }?>

<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
<div class="normal"><?php echo $_smarty_tpl->getVariable('content')->value;?>
</div>