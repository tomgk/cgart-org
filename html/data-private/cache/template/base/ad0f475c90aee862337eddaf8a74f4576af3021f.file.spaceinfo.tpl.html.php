<?php /* Smarty version Smarty-3.0.5, created on 2011-03-18 16:36:39
         compiled from "D:\www\GoelliB\domains\cg\template\base\spaceinfo.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:195644d837c078eba50-82834050%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ad0f475c90aee862337eddaf8a74f4576af3021f' => 
    array (
      0 => 'D:\\www\\GoelliB\\domains\\cg\\template\\base\\spaceinfo.tpl.html',
      1 => 1300462598,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '195644d837c078eba50-82834050',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<style type="text/css">
    .bar
    {
        border: 1px solid black;
        width: 20em;
        margin: 0.5em 0;
        height:1.2em;
        line-height: 1.2em;
        text-align: center;
        width: 100%;
        position: relative;

        -moz-border-radius: 0.3em;
        -webkit-border-radius: 0.3em;
        border-radius: 0.3em;
    }

    .bar .value
    {
        background-color:gray;
        float: left;
        height:1.2em;
        background-color: #9c6;
        
        -moz-border-radius: 0.3em;
        -webkit-border-radius: 0.3em;
        border-radius: 0.3em;
    }

    .bar .critical
    {
        background-color: #e32;
    }

    .bar .text
    {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }

    .spaceinfo
    {
        border-collapse: collapse;
        margin: 0.5em 0;
        width: 27em;/* damit gleich breit wie totalSpace (totalSpace.width+totalSpace.padding*2+totalSpace.margin*2 */
    }

    .spaceinfo td, .spaceinfo th
    {
        border: 1px solid black;
        padding: 0.5em;
    }

    .spaceinfo .filecount, .spaceinfo .space-percent, .spaceinfo .space
    {
        text-align:right;
    }

    .totalSpace
    {
        border: 1px solid #666;
        background: #eee;
        padding: 1em;
        width: 25em;
        margin: 1em 0;
    }

    .totalSpace p
    {
        padding-left: 0;
        padding-right: 0;
    }

    h2
    {
        font-size: 1.2em;
        font-weight: normal;
    }
</style>

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
    <tr><th>Verzeichnis</th><th>Speicher</th><th>Relativ</th><th>Dateien</th></tr>
    <?php  $_smarty_tpl->tpl_vars['dir'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('dirs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['dir']->key => $_smarty_tpl->tpl_vars['dir']->value){
?>
    <tr><td class="name"><?php echo $_smarty_tpl->tpl_vars['dir']->value['name'];?>
</td><td class="space"><?php echo $_smarty_tpl->tpl_vars['dir']->value['space'];?>
</td><td class="space-percent"><?php echo $_smarty_tpl->tpl_vars['dir']->value['space_percent'];?>
 %</td><td class="filecount"><?php echo $_smarty_tpl->tpl_vars['dir']->value['filecount'];?>
</td></tr>
    <?php }} ?>
</table>