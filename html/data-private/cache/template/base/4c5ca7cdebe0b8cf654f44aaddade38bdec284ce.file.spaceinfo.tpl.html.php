<?php /* Smarty version Smarty-3.0.5, created on 2011-03-24 23:12:06
         compiled from "/var/www/web220/html/data-private/template/base/spaceinfo.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:19286735044d8bc1b648af66-32964762%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4c5ca7cdebe0b8cf654f44aaddade38bdec284ce' => 
    array (
      0 => '/var/www/web220/html/data-private/template/base/spaceinfo.tpl.html',
      1 => 1301003828,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19286735044d8bc1b648af66-32964762',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>

<div class="totalSpace">
<h2>Totale Speicherauslastung</h2>
<p><?php echo $_smarty_tpl->getVariable('usedSpace')->value;?>
 von <?php echo $_smarty_tpl->getVariable('availableSpace')->value;?>
 belegt</p>
<div class="bar"><div class="text"><?php echo $_smarty_tpl->getVariable('percent')->value;?>
 %</div><div class="value<?php if ($_smarty_tpl->getVariable('percent')->value>90){?> critical<?php }?>" style="width:<?php echo $_smarty_tpl->getVariable('percent')->value;?>
%"></div></div>
</div>

<h2>Größe der Verzeichnisse</h2>

<table class="spaceinfo">
    <tr><th>Verzeichnis</th><th>Speicher</th><th>Dateien</th></tr>
    <?php  $_smarty_tpl->tpl_vars['dir'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('dirs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['dir']->key => $_smarty_tpl->tpl_vars['dir']->value){
?>
    <tr><td class="name"><?php echo $_smarty_tpl->tpl_vars['dir']->value['name'];?>
</td><td class="space"><?php echo $_smarty_tpl->tpl_vars['dir']->value['space'];?>
</td><td class="filecount"><?php echo $_smarty_tpl->tpl_vars['dir']->value['filecount'];?>
</td></tr>
    <?php }} ?>
</table>