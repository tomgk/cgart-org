<?php /* Smarty version Smarty-3.0.5, created on 2011-02-26 18:15:51
         compiled from "D:\www\GoelliB\domains\cg\template\base\nav_bar.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:129164d6935477f47f1-15117707%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a391a5a7353db8def82ee5371992d0bf0c8a7a04' => 
    array (
      0 => 'D:\\www\\GoelliB\\domains\\cg\\template\\base\\nav_bar.tpl.html',
      1 => 1298740550,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '129164d6935477f47f1-15117707',
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