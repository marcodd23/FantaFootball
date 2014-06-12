<?php
include '../include/template.inc.php';
include '../include/auth.inc.php';

checkAuthorization("admin/players.php");

$base=new Template("../dtml/admin/base.html");
$menu=new Template("../dtml/admin/menu_admin.html");
$menu->setContent("RATE", "active");

$content= new Template("../dtml/admin/rateviews.html");

$result=mysql_query("SELECT * FROM serie_a");
$serie_a=mysql_fetch_assoc($result);
$giornata=$serie_a['giornata'];
for($i=1;$i<=$giornata;$i++){
	$content->setContent("DAY_NUMBER", $i);
	if($giornata==$i){
		$content->setContent("SELECTED", "selected");
	}
	else{
		$content->setContent("SELECTED", "");
	}
}
$base->setContent("MENU", $menu->get());
$base->setContent("CONTENT", $content->get());
$base->close();


?>