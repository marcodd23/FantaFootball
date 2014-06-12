<?php

include '../include/template2.inc.php';
include '../include/auth.inc.php';

checkAuthorization("admin/administration.php");

$base=new Template("../dtml/admin/base.html");
$menu=new Template("../dtml/admin/menu_admin.html");
$content=new Template("../dtml/admin/administration.html");
$base->setContent("MENU", $menu->get());
$base->setContent("CONTENT", $content->get());
$base->close();


?>