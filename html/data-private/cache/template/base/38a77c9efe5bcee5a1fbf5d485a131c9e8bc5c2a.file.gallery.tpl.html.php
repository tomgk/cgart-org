<?php /* Smarty version Smarty-3.0.5, created on 2011-02-26 14:00:03
         compiled from "D:\www\GoelliB\domains\cg\template\base\gallery.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:312744d68f95344cd14-20203766%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '38a77c9efe5bcee5a1fbf5d485a131c9e8bc5c2a' => 
    array (
      0 => 'D:\\www\\GoelliB\\domains\\cg\\template\\base\\gallery.tpl.html',
      1 => 1298725189,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '312744d68f95344cd14-20203766',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<style type="text/css">
    .pics .centerbox, .pics .fatcenterbox
    {
        text-align:center;float:left;display:block;float:left;
        width: 33%;
    }

    .pics .fatcenterbox
    {
        padding-left: 33%;
    }
</style>

<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
<div class="pics">
    <?php if (isset($_smarty_tpl->getVariable('description',null,true,false)->value)){?><div class="description"><?php echo $_smarty_tpl->getVariable('description')->value;?>
</div><?php }?>
    <?php if ($_smarty_tpl->getVariable('sites')->value>=2){?>
    <p style="clear:both;float:left;width:600px">
        <?php if (isset($_smarty_tpl->getVariable('prev_path',null,true,false)->value)){?><a style="float:left;width:33%" href="<?php echo $_smarty_tpl->getVariable('prev_path')->value;?>
">&laquo; Vorherige Seite</a><?php }?>
        <span class="<?php if (isset($_smarty_tpl->getVariable('prev_path',null,true,false)->value)){?>centerbox<?php }else{ ?>fatcenterbox<?php }?>">Seite <?php echo $_smarty_tpl->getVariable('site')->value;?>
 von <?php echo $_smarty_tpl->getVariable('sites')->value;?>
</span>
        <?php if (isset($_smarty_tpl->getVariable('next_path',null,true,false)->value)){?><a style="float:right" href="<?php echo $_smarty_tpl->getVariable('next_path')->value;?>
">Nächste Seite &raquo;</a><?php }?>
        <br style="clear:both" />
    </p>
    <?php }?>

    <?php  $_smarty_tpl->tpl_vars['pic'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pics')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pic']->key => $_smarty_tpl->tpl_vars['pic']->value){
?>
    <div class="pic">
        <a href="<?php echo $_smarty_tpl->tpl_vars['pic']->value['href'];?>
">
            <img src="<?php echo $_smarty_tpl->tpl_vars['pic']->value['path'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['pic']->value['title'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['pic']->value['title'];?>
" />
        </a>
    </div>
    <?php }} else { ?>
    <p><em>Es sind keine Werke in dieser Kategorie</em></p>
    <?php } ?>
</div>