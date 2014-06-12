<?php

include './include/template2.inc.php';
include './include/auth.inc.php';
	
	checkAuthorization("subscription_start.php");
//isAuthorized("subscription_start.php");
	//if(isAuthorized("subscription_start.php")){
		
		$base_path="./dtml/";
		$base=new Template($base_path."base.html");
		$login=new Template($base_path."login.html");
		$menu=new Template($base_path."menu.html");
		$content=new Template($base_path."subscription_form.html");
		$footer=new Template($base_path."footer.html");
	
		$base->setContent("LOGIN", $login->get());
		$base->setContent("MENU", $menu->get());
		$base->setContent("CONTENT", $content->get());
		$base->setContent("FOOTER", $footer->get());
		$base->close();
	//}
	//else{
		//header("Location:error.php?code=403");
	//}


?>