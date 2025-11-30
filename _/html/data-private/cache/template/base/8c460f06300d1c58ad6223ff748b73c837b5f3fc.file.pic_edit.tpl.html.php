<?php /* Smarty version Smarty-3.0.5, created on 2011-03-20 13:06:37
         compiled from "/var/www/web220/html/data-private/template/base/pic_edit.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:6401408984d85edcd11d669-30613824%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c460f06300d1c58ad6223ff748b73c837b5f3fc' => 
    array (
      0 => '/var/www/web220/html/data-private/template/base/pic_edit.tpl.html',
      1 => 1300622728,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6401408984d85edcd11d669-30613824',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
<p><a href="<?php echo $_smarty_tpl->getVariable('cancel_path')->value;?>
#pic<?php echo $_smarty_tpl->getVariable('pic_id')->value;?>
">Zurück zur Kategorie</a></p>
<div style="width:600px; padding: 0.5em;text-align:center;border:1px dashed #a9a;margin:1em">
    <?php if (isset($_smarty_tpl->getVariable('path',null,true,false)->value)){?><img src="<?php echo $_smarty_tpl->getVariable('path')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('title')->value;?>
" alt="<?php echo $_smarty_tpl->getVariable('title')->value;?>
" style="clear:both"><?php }else{ ?>kein Bild gewählt<?php }?>

    <form style="border-top:1px dashed #a9a;margin-top: 1em;text-align:left" action="<?php echo $_smarty_tpl->getVariable('save_path')->value;?>
" method="post">
        <?php if ($_smarty_tpl->getVariable('save_state')->value!==null){?>
        <?php if ($_smarty_tpl->getVariable('save_state')->value){?><p style="color:green">Erfolgreich gespeichert</p>
        <?php }else{ ?>
        <p style="color:red">Fehler beim Speichern (Änderungen wurden wahrscheinlich nicht angenommen)</p><?php }?>
        <?php }?>

        <a href="<?php echo $_smarty_tpl->getVariable('pic_delete_path')->value;?>
" class="right"><span class="pic-delete-item">Bild löschen</span></a>
        
        <p>Titel: <input name="title" value="<?php echo $_smarty_tpl->getVariable('title')->value;?>
" /></p>
        <p>Größe: <input name="height" value="<?php echo $_smarty_tpl->getVariable('height')->value;?>
" style="width:3em" /> x <input name="width" value="<?php echo $_smarty_tpl->getVariable('width')->value;?>
" style="width:3em" /></p>
        <p>Jahr: <input name="c_year" value="<?php echo $_smarty_tpl->getVariable('c_year')->value;?>
" style="width:3em" /></p>
        <p><input type="submit" value="Speichern"/> <a href="<?php echo $_smarty_tpl->getVariable('cancel_path')->value;?>
">Abbrechen</a></p>
    </form>
</div>