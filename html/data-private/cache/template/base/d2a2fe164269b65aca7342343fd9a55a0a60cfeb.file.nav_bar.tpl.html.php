<?php /* Smarty version Smarty-3.0.5, created on 2011-03-19 22:04:16
         compiled from "/var/www/web220/html/data-private/template/base/nav_bar.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:4433079054d851a5070df08-21136999%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd2a2fe164269b65aca7342343fd9a55a0a60cfeb' => 
    array (
      0 => '/var/www/web220/html/data-private/template/base/nav_bar.tpl.html',
      1 => 1300568022,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4433079054d851a5070df08-21136999',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('prev_path')->value){?>
<a style="float:left;width:33%" href="<?php echo $_smarty_tpl->getVariable('prev_path')->value;?>
">
    <?php if (isset($_smarty_tpl->getVariable('prev_text',null,true,false)->value)){?><?php echo $_smarty_tpl->getVariable('prev_text')->value;?>
<?php }else{ ?>&laquo; vorherige Seite<?php }?>
</a>
<?php }?>

<span style="display:block;text-align:center;width:33%;float:left<?php if (!$_smarty_tpl->getVariable('prev_path')->value){?>;padding-left:33%<?php }?>"><?php echo $_smarty_tpl->getVariable('centertext')->value;?>
</span>

<?php if ($_smarty_tpl->getVariable('next_path')->value){?>
<a style="float:right" href="<?php echo $_smarty_tpl->getVariable('next_path')->value;?>
">
    <?php if (isset($_smarty_tpl->getVariable('next_text',null,true,false)->value)){?><?php echo $_smarty_tpl->getVariable('next_text')->value;?>
<?php }else{ ?>Nächste Seite &raquo;<?php }?>
</a><?php }?>

<br style="clear:both" />