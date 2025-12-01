<?php

include "base.php";

/*import('FileCache', 'core');
import('MySQL');

$fc = new FileCache('.');
echo MySQL::escape('<img src="a.txt" />');

var_dump(file_exists('/var/www/web220/html/data-private/cache/model/'));
#var_dump(safe_glob('/var/www/web220/html/data-private/cache/model/datalist8_article*.ser.txt'));

$fc->putObject('sample', array('content'=>'<p>Hello World.<img src="http://static.carl-goelles.at/pic/tn3.jpg" /></p>'));
var_dump($fc->getObject('sample'));

//echo (disk_total_space('.')/1024/1024/1024/1024).' TBytes used';
//echo exec('repquota -a');*/

import('array');
$content = array_get($_POST, 'content');

?>
<form action="" method="post">
    <textarea name="content"><?php echo $content; ?></textarea>
    <input type="submit" />
</form>
<?php

?>
