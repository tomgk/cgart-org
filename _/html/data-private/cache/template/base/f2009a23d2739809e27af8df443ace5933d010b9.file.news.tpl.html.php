<?php /* Smarty version Smarty-3.0.5, created on 2011-03-19 22:04:16
         compiled from "/var/www/web220/html/data-private/template/base/news.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:4781153584d851a506a6a37-03691028%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f2009a23d2739809e27af8df443ace5933d010b9' => 
    array (
      0 => '/var/www/web220/html/data-private/template/base/news.tpl.html',
      1 => 1300568022,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4781153584d851a506a6a37-03691028',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
<div class="newsbox">
    <?php if (3>2){?>
    <div class="navbox">
        <?php $_template = new Smarty_Internal_Template('nav_bar.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('prev_path',($_smarty_tpl->getVariable('prev_path')->value));$_template->assign('next_path',($_smarty_tpl->getVariable('next_path')->value));$_template->assign('centertext',"Seite ".($_smarty_tpl->getVariable('site')->value)." von ".($_smarty_tpl->getVariable('sites')->value)); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
        <br clear="both" />
    </div>
    <?php }?>

    <?php  $_smarty_tpl->tpl_vars['n'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['n']->key => $_smarty_tpl->tpl_vars['n']->value){
?>
    <div class="news">
        <h2><?php echo $_smarty_tpl->tpl_vars['n']->value['title'];?>
</h2>
        <div class="content"><?php echo $_smarty_tpl->tpl_vars['n']->value['content'];?>
</div>
    </div>

    <?php }} else { ?>
    <p><em>keine Neuigkeiten vorhanden</em></p>
    <?php } ?>
</div>