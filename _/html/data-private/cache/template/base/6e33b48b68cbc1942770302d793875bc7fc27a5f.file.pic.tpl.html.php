<?php /* Smarty version Smarty-3.0.5, created on 2011-03-19 22:06:15
         compiled from "/var/www/web220/html/data-private/template/base/pic.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:20644865054d851ac75ff5c7-65228448%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6e33b48b68cbc1942770302d793875bc7fc27a5f' => 
    array (
      0 => '/var/www/web220/html/data-private/template/base/pic.tpl.html',
      1 => 1300568022,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20644865054d851ac75ff5c7-65228448',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div style="width:600px; padding: 0.5em;text-align:center;border:1px dashed #a9a;margin:1em">
    <div style="text-align:center;padding:0.25em 0 0.5em">
        <p style="padding:0 0 0.5em 0"><a href="<?php echo $_smarty_tpl->getVariable('up_path')->value;?>
">Zurück zur Kategorie</a></p>
        <?php if (isset($_smarty_tpl->getVariable('prev_path',null,true,false)->value)){?><a href="<?php echo $_smarty_tpl->getVariable('prev_path')->value;?>
" style="float:left">&lt;&lt; Vorherige</a><?php }?>
        <h1 style="color:#232;font-weight: bold;font-size:1em;display:inline;border:none"><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
        <?php if (isset($_smarty_tpl->getVariable('next_path',null,true,false)->value)){?><a href="<?php echo $_smarty_tpl->getVariable('next_path')->value;?>
" style="float:right">Nächster &gt;&gt;</a><?php }?>
    </div>
    
    <img src="<?php echo $_smarty_tpl->getVariable('path')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('title')->value;?>
" alt="<?php echo $_smarty_tpl->getVariable('title')->value;?>
" style="clear:both">
    <div style="border-top:1px dashed #a9a;margin-top: 1em"><p style="float:left"><?php echo $_smarty_tpl->getVariable('title')->value;?>
</p><p style="float:right">Bild <?php echo $_smarty_tpl->getVariable('nr')->value;?>
 von <?php echo $_smarty_tpl->getVariable('count')->value;?>
</p></div>
    <p style="clear:both"><?php echo $_smarty_tpl->getVariable('technique')->value;?>
</p>
    <p><?php echo $_smarty_tpl->getVariable('height')->value;?>
 x <?php echo $_smarty_tpl->getVariable('width')->value;?>
</p>
    <p><?php echo $_smarty_tpl->getVariable('c_year')->value;?>
</p>
</div>