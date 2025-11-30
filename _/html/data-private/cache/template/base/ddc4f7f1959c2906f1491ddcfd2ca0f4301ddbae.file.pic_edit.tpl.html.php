<?php /* Smarty version Smarty-3.0.5, created on 2011-03-19 10:25:33
         compiled from "D:\www\GoelliB\domains\cg\template\base\pic_edit.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:124514d84768d690581-62322758%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ddc4f7f1959c2906f1491ddcfd2ca0f4301ddbae' => 
    array (
      0 => 'D:\\www\\GoelliB\\domains\\cg\\template\\base\\pic_edit.tpl.html',
      1 => 1300526730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '124514d84768d690581-62322758',
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