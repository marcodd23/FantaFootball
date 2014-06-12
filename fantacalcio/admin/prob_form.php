<?php
include '../include/template.inc.php';
include '../include/auth.inc.php';

checkAuthorization("admin/players.php");

$base=new Template("../dtml/admin/base.html");
$menu=new Template("../dtml/admin/menu_admin.html");
$menu->setContent("PROB", "active");

$content= new Template("../dtml/admin/prob_formviews.html");

$result=mysql_query("SELECT * FROM squadre ORDER BY nome");
while ($squadra=mysql_fetch_assoc($result)){
	if(!mysql_num_rows(mysql_query("SELECT * FROM probabili_formazioni WHERE squadra={$squadra['id']}")))
		$content->setContent("TITLE", "Add");
	else $content->setContent("TITLE", "View");
	$content->setContent("ID", $squadra['id']);
	$content->setContent("SQUADRA", $squadra['nome']);
}

$base->setContent("MENU", $menu->get());
$base->setContent("CONTENT", $content->get());
$base->close();


?>