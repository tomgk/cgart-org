<?php /* Smarty version Smarty-3.0.5, created on 2011-03-24 23:14:42
         compiled from "/var/www/web220/html/data-private/template/base/category_list.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:6635099754d8bc252c18aa9-96165538%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a7a81f9ff2b26a4b718d4b0d281eb1d25fe4ef91' => 
    array (
      0 => '/var/www/web220/html/data-private/template/base/category_list.tpl.html',
      1 => 1301004881,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6635099754d8bc252c18aa9-96165538',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>

<div class="op-menu">
<?php if ($_smarty_tpl->getVariable('parent_cat_url')->value){?>
<ul>
    <li><a href="<?php echo $_smarty_tpl->getVariable('parent_cat_url')->value;?>
" class="move-cat-up"> Ins Übergeordnete Verzeichnis</a></li>
</ul>
<?php }?>
<ul>
    <li><a href="<?php echo $_smarty_tpl->getVariable('pic_upload_path')->value;?>
" class="add-picture">Bild hinzufügen</a></li>
    <li><a href="<?php echo $_smarty_tpl->getVariable('article_add_path')->value;?>
" class="article-add">Artikel hinzufügen</a></li>
    <li><a href="<?php echo $_smarty_tpl->getVariable('categroy_add_path')->value;?>
" class="cat-add">Kategorie erstellen</a></li>
</ul>
</div>

<?php if (!empty($_smarty_tpl->getVariable('categorys')->value)){?>
    <h2 class="clear"><?php echo $_smarty_tpl->getVariable('cat_title')->value;?>
</h2>

    <table class="object-list">
    <?php  $_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('categorys')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cat']->key => $_smarty_tpl->tpl_vars['cat']->value){
?>
        <tr>
            <td class="name"><a class="cat-item" href="<?php echo $_smarty_tpl->tpl_vars['cat']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['cat']->value['title'];?>
</a></td>
            <td><a href="<?php echo $_smarty_tpl->tpl_vars['cat']->value['set_article'];?>
" title="Artikel festlegen"><img alt="Artikel festlegen" src="<?php echo $_smarty_tpl->getVariable('icon_path')->value;?>
silk/report.png" /></a></td>
            <td><a href="<?php echo $_smarty_tpl->tpl_vars['cat']->value['edit'];?>
" title="Kategorie bearbeiten"><img alt="Kategorie bearbeiten" src="<?php echo $_smarty_tpl->getVariable('icon_path')->value;?>
silk/pencil.png" /></a></td>
        </tr>
    <?php }} ?>
    </table>
<?php }?>

<?php if (!empty($_smarty_tpl->getVariable('pics')->value)){?>
    <h2 class="clear"><?php echo $_smarty_tpl->getVariable('pic_title')->value;?>
</h2>

    <ul class="pic-list">
        <?php  $_smarty_tpl->tpl_vars['pic'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pics')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pic']->key => $_smarty_tpl->tpl_vars['pic']->value){
?>
        <li id="pic<?php echo $_smarty_tpl->tpl_vars['pic']->value['pic_id'];?>
">
            <a href="<?php echo $_smarty_tpl->tpl_vars['pic']->value['edit_url'];?>
">
                <img src="<?php echo $_smarty_tpl->tpl_vars['pic']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['pic']->value['title'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['pic']->value['title'];?>
"/>
            </a>
            <?php echo $_smarty_tpl->tpl_vars['pic']->value['title'];?>

        </li>
        <?php }} ?>
    </ul>
<?php }?>

<?php if (!empty($_smarty_tpl->getVariable('articles')->value)){?>
    <h2 class="clear"><?php echo $_smarty_tpl->getVariable('article_title')->value;?>
</h2>

    <table class="object-list">
        <?php  $_smarty_tpl->tpl_vars['article'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('articles')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['article']->key => $_smarty_tpl->tpl_vars['article']->value){
?>
        <tr>
            <td><a class="article-item" href="<?php echo $_smarty_tpl->tpl_vars['article']->value['show_path'];?>
"><?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
</a></td>
            <td><a href="<?php echo $_smarty_tpl->tpl_vars['article']->value['edit_path'];?>
" title="Artikel bearbeiten"><img alt="Artikel bearbeiten" src="<?php echo $_smarty_tpl->getVariable('icon_path')->value;?>
silk/pencil.png" /></a></td>
            <td><a href="<?php echo $_smarty_tpl->tpl_vars['article']->value['delete_path'];?>
" title="Artikel löschen"><img alt="Artikel löschen" src="<?php echo $_smarty_tpl->getVariable('icon_path')->value;?>
silk/report_delete.png" /></a></td>
            <td><?php echo $_smarty_tpl->tpl_vars['article']->value['info'];?>
</td>
        </tr>
        <?php }} ?>
    </table>
<?php }?>