<?php foreach ($page as $p){
$fullurl = preg_replace("(^https?://)", "", base_url() );
// $cms_path = str_replace($_SERVER['SERVER_ADDR'], "", $fullurl)."user/cms/".$p['pageUrl'];
$cms_path = "user/cms/".$p['pageUrl'];

$cms_path = ltrim($cms_path,'/');
echo "<li class='dd-item' data-href='".$cms_path."' data-title='".$p['navTitle']."'><a class='right' onclick='var li = this.parentNode; var ul = li.parentNode; ul.removeChild(li);'><i class='icon-remove'></i></a><div class='dd-handle'>".$p['navTitle']."</div></li>";	
}?>