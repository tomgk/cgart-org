<?php /* Smarty version Smarty-3.0.5, created on 2011-03-26 20:56:03
         compiled from "/var/www/web220/html/data-private/template/base/article-edit.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:18674225874d8e44d38b1ec5-83068557%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8518c3e97409f0b3c6d8d8a3c94c1ae9ad1062f' => 
    array (
      0 => '/var/www/web220/html/data-private/template/base/article-edit.tpl.html',
      1 => 1301169325,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18674225874d8e44d38b1ec5-83068557',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>

<?php if (isset($_smarty_tpl->getVariable('save_status',null,true,false)->value)){?>
<?php if ($_smarty_tpl->getVariable('save_status')->value){?>Erfolgreich gespeichert <a href="<?php echo $_smarty_tpl->getVariable('show_path')->value;?>
">Ansehen</a><?php }else{ ?>Speichern fehlgeschlagen<?php }?>
<?php }?>

<script src="<?php echo $_smarty_tpl->getVariable('js_path')->value;?>
tiny_mce/tiny_mce.js" type="text/javascript"></script>
<script type="text/javascript">
    //für cross domain
    document.domain = 'carl-goelles.at';
    
    tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",

        fix_list_elements : true,
        relative_urls : false,

        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",

        language:"de",

        //////////////////

        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "mybutton,save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,


        external_image_list_url : "/images.php",

        /*setup:function(editor)
        {
            editor.addButton('mybutton',
            {
                image: '<?php echo $_smarty_tpl->getVariable('icon_path')->value;?>
silk/picture_add.png',
                title: 'My Button',
                onclick: function(i)
                {
                    tinyMCEPopup.alert('Hello World');
                    var x = t
                    var w = window.open('data:text/html,<title>Hello World</title><body></body>', 'imgWin', "width=200,height=200");
//                    alert(w.document.getElementsByTagName('body')[0].insert);
               //     w.document.getElementsByTagName('body')[0].appendChild(document.createTextNode(tinymce.toSource()));
//                    editor.selection.setContent('<img title="A Text" />');
                }
            });
        },*/

        ///////////////

        entity_encoding: "raw",
        content_css : "<?php echo $_smarty_tpl->getVariable('css_path')->value;?>
base/editor.css",
//        extended_valid_elements: "ext:pic[id,type,align]",//,strong/b,em/i"
//        custom_elements: "~ext:pic",
        $$$:0
    });
</script>

<form action="<?php echo $_smarty_tpl->getVariable('edit_path')->value;?>
" method="post" style="display:inline">
    <p>Titel: <input name="title" value="<?php echo $_smarty_tpl->getVariable('title')->value;?>
" /></p>

    <p>Info: <input name="info" value="<?php echo $_smarty_tpl->getVariable('info')->value;?>
" /></p>

    <p>Inhalt:</p>

    <textarea style="width:95%;margin: 0 1em" cols="100" rows="30" name="content"><?php echo $_smarty_tpl->getVariable('content')->value;?>
</textarea>
    <br />
    <br />
    
    <input type="submit" value="Speichern" />
</form>

<form action="<?php echo $_smarty_tpl->getVariable('cancel_path')->value;?>
" method="get" style="display: inline">
    <input value="Abrechen" type="submit" />
</form>