<?php
include '../include/template.inc.php';
include '../include/auth.inc.php';

checkAuthorization("admin/services.php");

$base=new Template("../dtml/admin/base.html");
$menu=new Template("../dtml/admin/menu_admin.html");
$menu->setContent("SERVICE", "active");

$content= new Template("../dtml/admin/serviceviews.html");

$base->setContent("MENU", $menu->get());
$base->setContent("CONTENT", $content->get());
$base->close();


?>