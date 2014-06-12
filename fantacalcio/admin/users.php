<?php
include '../include/template.inc.php';
include '../include/auth.inc.php';

checkAuthorization("admin/users.php");

$base=new Template("../dtml/admin/base.html");
$menu=new Template("../dtml/admin/menu_admin.html");
$menu->setContent("USER", "active");

$content= new Template("../dtml/admin/userviews.html");

$base->setContent("MENU", $menu->get());
$base->setContent("CONTENT", $content->get());
$base->close();


?>