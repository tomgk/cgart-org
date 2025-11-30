<?php /* Smarty version Smarty-3.0.5, created on 2011-03-19 22:56:14
         compiled from "/var/www/web220/html/data-private/template/base/pic_upload.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:480443954d85267eb99cc1-87744806%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '38fd43867f5fdb188947c9d226651ff4032c0ffb' => 
    array (
      0 => '/var/www/web220/html/data-private/template/base/pic_upload.tpl.html',
      1 => 1300568022,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '480443954d85267eb99cc1-87744806',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>

<!--<p>Bild hinzufügen</p>

<ol class="normal">
    <li>Bild raufladen</li>
    <li>Biddaten ändern</li>
</ol>-->

<form action="<?php echo $_smarty_tpl->getVariable('upload_path')->value;?>
" method="post" enctype="multipart/form-data">
    <input type="file" name="pic" value="" />
    <input type="submit" name="something" value="Bild raufladen" />
</form>