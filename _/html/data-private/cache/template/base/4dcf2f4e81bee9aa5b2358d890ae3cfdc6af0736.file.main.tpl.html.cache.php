<?php /* Smarty version Smarty-3.0.5, created on 2011-02-21 16:02:25
         compiled from "template/base/main.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:175574d627e818bb458-64392191%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4dcf2f4e81bee9aa5b2358d890ae3cfdc6af0736' => 
    array (
      0 => 'template/base/main.tpl.html',
      1 => 1297515592,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '175574d627e818bb458-64392191',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
    <head>
        <title>Carl Gölles</title>
        
        <style type="text/css">
            *
            {
                padding: 0;
                margin: 0;
                font-family: Verdana;
            }

            img
            {
                sborder: 0.25em solid transparent;
            }

            #container
            {
                border:1px solid black;
                margin: 1em 5em;
                swidth: 50em;
                background-color: white;
            }

            body
            {
                background-color: #eee;
            }

            p
            {
                padding: 0.5em;
                line-height: 1.4375em;
            }

            h1
            {
                font-weight: normal;
                font-size: 1.75em;
                padding: 0.5em 0.25em;
            }

            #header
            {
                width: 100%;
                soverflow:hidden;
            }

            #logo
            {
/*                 0.5em;*/
                font-size: 2em;

                float:left;
                display:block;
                color: #efe;

                background-image: url('/data/pic/9.jpg');
                width: 100%;
            }

            #logo a
            {
                margin: 0.5em;
                display: block;
            }

            #mainmenu
            {
                float: left;
                width: 100%;
                spadding: 0.25em;
                border:1px solid black;
                border-width: 1px 0;
            }

            #mainmenu ul
            {
                float: left;
                padding: 0.25em;
                list-style: none;
            }

            #mainmenu li
            {
                float: left;
                padding: 0.25em;
            }

            #body
            {
                clear: both;
            }

            #footer
            {
                position: relative;
                clear: both;
                border-top:1px solid black;
                text-align: right;
                width: 100%;
                font-size: 0.875em;
            }

            #footermenu
            {
                list-style: none;
                padding: 0.25em;
                float: right;
                display:block;
            }

            #footermenu li
            {
                float: right;
                padding: 0.25em;
            }

            #copyinfo
            {
                float: right;
                padding: 0.5em;
            }
        </style>
    </head>

    <body>
        <div id="container">
            <div id="header">
                <div id="logo"><a>Carl Gölles</a></div>

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
                <div id="content"><?php echo $_smarty_tpl->getVariable('content')->value;?>
</div>
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
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['m']->value['href'];?>
"><?php echo $_smarty_tpl->tpl_vars['m']->value['title'];?>
</a></li>
                        <?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['footermenu']['last']){?> · <?php }?>
                    <?php }} ?>
                </ul>
                
                <span id="copyinfo">&copy; 2010 Carl Gölles</span>

                <br clear="both" />
            </div>
        </div>
    </body>
</html>