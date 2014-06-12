<?php

include './include/template2.inc.php';
include './include/auth.inc.php';
	
	//checkAuthorization("subscription_start.php");

		$base_path="./dtml/";
		$base=new Template($base_path."base.html");
		if(isLogged()){
			$username=$_SESSION['user'];
			$base_path_user="./dtml/user/";
			$login=new Template($base_path_user."login.html");
			$login->setContent("USERNAME", $username);
		}
		else $login=new Template($base_path."login.html");
		$menu=new Template($base_path."menu.html");
		$content=new Template($base_path."reg.html");
		$footer=new Template($base_path."footer.html");
	
		$base->setContent("LOGIN", $login->get());
		$base->setContent("MENU", $menu->get());
		$base->setContent("CONTENT", $content->get());
		$base->setContent("FOOTER", $footer->get());
		$base->close();

?>