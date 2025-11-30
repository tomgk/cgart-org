<?php /* Smarty version Smarty-3.0.5, created on 2011-03-18 23:52:24
         compiled from "D:\www\GoelliB\domains\cg\template\base\pic_upload.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:156184d83e228eefac4-00222742%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '76970b0e17b3886473d2d481ccad71943fd7d986' => 
    array (
      0 => 'D:\\www\\GoelliB\\domains\\cg\\template\\base\\pic_upload.tpl.html',
      1 => 1300488737,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '156184d83e228eefac4-00222742',
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