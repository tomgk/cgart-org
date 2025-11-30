<?php /* Smarty version Smarty-3.0.5, created on 2011-03-19 20:01:08
         compiled from "template/base/main.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:158984d84fd743343a1-29476186%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4dcf2f4e81bee9aa5b2358d890ae3cfdc6af0736' => 
    array (
      0 => 'template/base/main.tpl.html',
      1 => 1300560206,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '158984d84fd743343a1-29476186',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title><?php echo $_smarty_tpl->getVariable('title')->value;?>
</title>

        <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('css_path')->value;?>
/base/main.css" />

        <style type="text/css">
            #logo
            {
                background-image: url('/data/pic/<?php echo $_smarty_tpl->getVariable('skin')->value['header_bg_img'];?>
.jpg');
            }
        </style>

        <?php if (isset($_smarty_tpl->getVariable('start_path',null,true,false)->value)){?><link rel="start" href="<?php echo $_smarty_tpl->getVariable('start_path')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('start_title')->value;?>
" /><?php }?>
        <?php if (isset($_smarty_tpl->getVariable('up_path',null,true,false)->value)){?><link rel="up" href="<?php echo $_smarty_tpl->getVariable('up_path')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('up_title')->value;?>
" /><?php }?>
        <?php if (isset($_smarty_tpl->getVariable('first_path',null,true,false)->value)){?><link rel="first" href="<?php echo $_smarty_tpl->getVariable('first_path')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('first_title')->value;?>
" /><?php }?>
        <?php if (isset($_smarty_tpl->getVariable('prev_path',null,true,false)->value)){?><link rel="prev" href="<?php echo $_smarty_tpl->getVariable('prev_path')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('prev_title')->value;?>
" /><?php }?>
        <?php if (isset($_smarty_tpl->getVariable('next_path',null,true,false)->value)){?><link rel="next" href="<?php echo $_smarty_tpl->getVariable('next_path')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('next_title')->value;?>
" /><?php }?>
        <?php if (isset($_smarty_tpl->getVariable('last_path',null,true,false)->value)){?><link rel="last" href="<?php echo $_smarty_tpl->getVariable('last_path')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('last_title')->value;?>
" /><?php }?>
    </head>

    <body>
        <div id="container">
            <div id="header">
                <div id="logo"><a href="<?php echo $_smarty_tpl->getVariable('wurl')->value;?>
"><?php echo $_smarty_tpl->getVariable('wtitle')->value;?>
</a></div>

                <div id="mainmenu"><ul>
                    <?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menu')->value['main']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['m']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['m']->iteration=0;
if ($_smarty_tpl->tpl_vars['m']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value){
 $_smarty_tpl->tpl_vars['m']->iteration++;
 $_smarty_tpl->tpl_vars['m']->last = $_smarty_tpl->tpl_vars['m']->iteration === $_smarty_tpl->tpl_vars['m']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['mainmenu']['last'] = $_smarty_tpl->tpl_vars['m']->last;
?>
                    <li>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['m']->value['href'];?>
"><?php echo $_smarty_tpl->tpl_vars['m']->value['title'];?>
</a>
                        <?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['mainmenu']['last']){?> · <?php }?>
                    <?php }} ?>
                    </li>
                </ul></div>

                <br clear="both" />
            </div>

            <div id="body">
                <?php if (isset($_smarty_tpl->getVariable('menu',null,true,false)->value['submenu'])){?>
                <div id="sidebar">
                    <ul>
                        <?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menu')->value['submenu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value){
?>
                        <li>
                            <?php if (isset($_smarty_tpl->tpl_vars['m']->value['selected'])){?>
                            <span class="selected"><?php echo $_smarty_tpl->tpl_vars['m']->value['title'];?>
</span>
                                <?php }else{ ?><a href="<?php echo $_smarty_tpl->tpl_vars['m']->value['href'];?>
"><?php echo $_smarty_tpl->tpl_vars['m']->value['title'];?>
</a></li>
                            <?php }?>
                        <?php }} ?>
                    </ul>
                </div>

                <div id="content" class="withsidebar"><?php echo $_smarty_tpl->getVariable('content')->value;?>
</div>
                <?php }else{ ?>
                <div id="content"><?php echo $_smarty_tpl->getVariable('content')->value;?>
</div>
                <?php }?>

                <!--[if IE]>
                <br clear="both" />
                <![endif]-->
            </div>

            <div id="footer">
                <ul id="footermenu">
                    <?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menu')->value['footer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['m']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['m']->iteration=0;
if ($_smarty_tpl->tpl_vars['m']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value){
 $_smarty_tpl->tpl_vars['m']->iteration++;
 $_smarty_tpl->tpl_vars['m']->last = $_smarty_tpl->tpl_vars['m']->iteration === $_smarty_tpl->tpl_vars['m']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['footermenu']['last'] = $_smarty_tpl->tpl_vars['m']->last;
?>
                    <li><?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['footermenu']['last']){?> · <?php }?>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['m']->value['href'];?>
"><?php echo $_smarty_tpl->tpl_vars['m']->value['title'];?>
</a>
                        </li>
                    <?php }} ?>
                </ul>
                
                <p id="copyinfo">&copy; 2010 Carl Gölles</p>

                <br clear="both" />
            </div>
        </div>
    </body>
</html>